<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Adoption;
use App\Models\Tree;
use Illuminate\Http\Request;

class AdoptionApiController extends Controller
{
    public function store(Request $request, Tree $tree)
    {
        $user = $request->user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $existing = Adoption::where('user_id', $user->id)
            ->where('tree_id', $tree->id)
            ->where('status', 'active')
            ->first();

        if ($existing) {
            return response()->json(['message' => 'Already adopted'], 400);
        }

        if ($tree->activeAdoption()->exists()) {
            return response()->json(['message' => 'Tree already adopted'], 400);
        }

        $adoption = Adoption::create([
            'user_id' => $user->id,
            'tree_id' => $tree->id,
            'status' => 'active',
            'adopted_at' => now(),
        ]);

        $tree->update(['is_available' => false]);

        return response()->json([
            'message' => 'Tree adopted successfully',
            'adoption' => $adoption->load('tree'),
        ], 201);
    }

    public function myAdoptions(Request $request)
    {
        $adoptions = $request->user()
            ->adoptions()
            ->where('status', 'active')
            ->with('tree', 'tree.photos')
            ->orderByDesc('adopted_at')
            ->get();

        return response()->json($adoptions);
    }

    public function getImpactSummary(Request $request)
    {
        $user = $request->user();

        $totalAdopted = $user->getAdoptedTreesCount();
        $totalCo2 = $user->getTotalCo2Offset();
        $totalSponsored = $user->getTotalSponsored();

        return response()->json([
            'total_adopted_trees' => $totalAdopted,
            'total_co2_offset_kg' => $totalCo2,
            'total_sponsored_amount' => $totalSponsored,
        ]);
    }
}
