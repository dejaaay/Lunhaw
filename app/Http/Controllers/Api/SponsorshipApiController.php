<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sponsorship;
use App\Models\Tree;
use Illuminate\Http\Request;

class SponsorshipApiController extends Controller
{
    public function store(Request $request, Tree $tree)
    {
        $user = $request->user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $validated = $request->validate([
            'amount' => 'required|numeric|min:10|max:100000',
            'payment_method' => 'required|in:gcash,maya,bank_transfer,cash',
        ]);

        $sponsorship = Sponsorship::create([
            'user_id' => $user->id,
            'tree_id' => $tree->id,
            'amount' => $validated['amount'],
            'payment_method' => $validated['payment_method'],
            'status' => 'pending',
        ]);

        return response()->json([
            'message' => 'Sponsorship created',
            'sponsorship' => $sponsorship,
        ], 201);
    }

    public function processPayment(Request $request, Sponsorship $sponsorship)
    {
        if ($sponsorship->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $sponsorship->update([
            'status' => 'completed',
            'paid_at' => now(),
            'transaction_reference' => 'TXN-' . uniqid(),
        ]);

        $sponsorship->tree->increment('co2_offset', 5);

        return response()->json([
            'message' => 'Payment processed successfully',
            'sponsorship' => $sponsorship,
        ]);
    }

    public function mySponsorships(Request $request)
    {
        $sponsorships = $request->user()
            ->sponsorships()
            ->with('tree')
            ->orderByDesc('created_at')
            ->get();

        return response()->json($sponsorships);
    }
}
