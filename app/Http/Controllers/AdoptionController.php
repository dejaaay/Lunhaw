<?php

namespace App\Http\Controllers;

use App\Models\Tree;
use App\Models\Adoption;
use Illuminate\Http\Request;

class AdoptionController extends Controller
{
    // Store adoption
    public function adopt(Request $request, Tree $tree)
    {
        $user = $request->user() ?? session('user');
        if (!$user) {
            return redirect('/login')->with('error', 'Please login to adopt a tree');
        }

        $validated = $request->validate([
            'confirm' => 'required|in:1',
        ]);

        // Check if already adopted
        $existing = Adoption::where('user_id', $user['id'] ?? $user->id)
            ->where('tree_id', $tree->id)
            ->where('status', 'active')
            ->first();

        if ($existing) {
            return redirect()->route('trees.show', $tree)->with('error', 'You already adopted this tree');
        }

        // Check if tree is already adopted
        if ($tree->activeAdoption()->exists()) {
            return redirect()->route('trees.show', $tree)->with('error', 'This tree is already adopted');
        }

        $adoption = Adoption::create([
            'user_id' => $user['id'] ?? $user->id,
            'tree_id' => $tree->id,
            'status' => 'active',
            'adopted_at' => now(),
        ]);

        $tree->update(['is_available' => false]);

        return redirect()->route('trees.show', $tree)->with('success', 'Tree adopted successfully!');
    }

    // User's adoptions
    public function myAdoptions(Request $request)
    {
        $user = $request->user() ?? session('user');
        if (!$user) {
            return redirect('/login');
        }

        $adoptions = Adoption::where('user_id', $user['id'] ?? $user->id)
            ->where('status', 'active')
            ->with('tree', 'tree.photos')
            ->orderByDesc('adopted_at')
            ->paginate(10);

        return view('adoptions.my-adoptions', compact('adoptions'));
    }

    // Transfer adoption
    public function transfer(Request $request, Adoption $adoption)
    {
        $user = $request->user() ?? session('user');
        if (!$user || ($adoption->user_id !== ($user['id'] ?? $user->id))) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'transferred_to_user_id' => 'required|exists:users,id',
        ]);

        $adoption->update([
            'status' => 'transferred',
            'transferred_at' => now(),
            'transferred_to_user_id' => $validated['transferred_to_user_id'],
        ]);

        // Create new adoption for recipient
        Adoption::create([
            'user_id' => $validated['transferred_to_user_id'],
            'tree_id' => $adoption->tree_id,
            'status' => 'active',
            'adopted_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Adoption transferred successfully');
    }

    // Cancel adoption
    public function cancel(Adoption $adoption)
    {
        $user = session('user');
        if (!$user || $adoption->user_id !== $user['id']) {
            return redirect('/login');
        }

        $adoption->update(['status' => 'inactive']);
        $adoption->tree->update(['is_available' => true]);

        return redirect()->route('adoptions.my')->with('success', 'Adoption cancelled');
    }
}
