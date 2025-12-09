<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TreePhoto;
use App\Models\Tree;

class TreePhotoController extends Controller
{
    public function edit(Tree $tree, TreePhoto $photo)
    {
        $user = session('user');
        if (!$user || $tree->user_id !== $user['id']) {
            return redirect('/login');
        }
        return view('trees.edit_photo', compact('tree', 'photo'));
    }

    public function update(Request $request, Tree $tree, TreePhoto $photo)
    {
        $user = session('user');
        if (!$user || $tree->user_id !== $user['id']) {
            return redirect('/login');
        }
        $validated = $request->validate([
            'caption' => 'nullable|string|max:255',
            'growth_notes' => 'nullable|string|max:255',
            'growth_status' => 'nullable|string|max:50',
            'photo' => 'nullable|image|max:4096',
        ]);
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('tree_photos', 'public');
            $photo->photo_path = $path;
        }
        $photo->caption = $validated['caption'] ?? $photo->caption;
        $photo->growth_notes = $validated['growth_notes'] ?? $photo->growth_notes;
        $photo->growth_status = $validated['growth_status'] ?? $photo->growth_status;
        $photo->save();
        return redirect()->route('trees.show', $tree)->with('success', 'Photo updated successfully');
    }
}
