<?php

namespace App\Http\Controllers;

use App\Models\Tree;
use App\Models\Sponsorship;
use Illuminate\Http\Request;

class SponsorshipController extends Controller
{
    // Show sponsorship form
    public function create(Tree $tree)
    {
        return view('sponsorships.create', compact('tree'));
    }

    // Store sponsorship
    public function store(Request $request, Tree $tree)
    {
        $user = $request->user() ?? session('user');
        if (!$user) {
            return redirect('/login')->with('error', 'Please login to sponsor a tree');
        }

        $validated = $request->validate([
            'amount' => 'required|numeric|min:10|max:100000',
            'payment_method' => 'required|in:gcash,maya,bank_transfer,cash',
        ]);

        $sponsorship = Sponsorship::create([
            'user_id' => $user['id'] ?? $user->id,
            'tree_id' => $tree->id,
            'amount' => $validated['amount'],
            'payment_method' => $validated['payment_method'],
            'status' => 'pending',
        ]);

        return redirect()->route('sponsorships.payment', $sponsorship)
            ->with('success', 'Sponsorship created. Proceed to payment.');
    }

    // Payment processing (simulated)
    public function payment(Sponsorship $sponsorship)
    {
        $user = session('user');
        if (!$user || $sponsorship->user_id !== $user['id']) {
            return redirect('/login');
        }

        return view('sponsorships.payment', compact('sponsorship'));
    }

    // Process payment
    public function processPayment(Request $request, Sponsorship $sponsorship)
    {
        $user = session('user');
        if (!$user || $sponsorship->user_id !== $user['id']) {
            return redirect('/login');
        }

        // Simulate payment processing
        $sponsorship->update([
            'status' => 'completed',
            'paid_at' => now(),
            'transaction_reference' => 'TXN-' . uniqid(),
        ]);

        // Update tree CO2 offset (add bonus for sponsorship)
        $sponsorship->tree->increment('co2_offset', 5);

        return redirect()->route('sponsorships.receipt', $sponsorship)
            ->with('success', 'Payment successful!');
    }

    // Receipt
    public function receipt(Sponsorship $sponsorship)
    {
        $user = session('user');
        if (!$user || $sponsorship->user_id !== $user['id']) {
            return redirect('/login');
        }

        return view('sponsorships.receipt', compact('sponsorship'));
    }

    // User's sponsorships
    public function mySponsorships(Request $request)
    {
        $user = $request->user() ?? session('user');
        if (!$user) {
            return redirect('/login');
        }

        $sponsorships = Sponsorship::where('user_id', $user['id'] ?? $user->id)
            ->with('tree')
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('sponsorships.my-sponsorships', compact('sponsorships'));
    }

    // Admin: View all sponsorships
    public function adminIndex()
    {
        $admin = session('admin');
        if (!$admin) {
            return redirect('/admin/login');
        }

        $sponsorships = Sponsorship::with('user', 'tree')
            ->orderByDesc('created_at')
            ->paginate(20);

        $totalRevenue = Sponsorship::where('status', 'completed')->sum('amount');
        $completedCount = Sponsorship::where('status', 'completed')->count();

        return view('admin.sponsorships.index', compact('sponsorships', 'totalRevenue', 'completedCount'));
    }
}
