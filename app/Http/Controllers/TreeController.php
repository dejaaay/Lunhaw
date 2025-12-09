<?php

namespace App\Http\Controllers;

use App\Models\Tree;
use App\Models\TreePhoto;
use App\Models\Adoption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TreeController extends Controller
{

    // Partner: Create tree form
    public function partnerCreate()
    {
        $user = session('user');
        if (!$user || ($user['role'] ?? null) !== 'ngo') {
            return redirect('/login');
        }
        return view('partner.trees.create');
    }

    // Partner: Store tree
    public function partnerStore(Request $request)
    {
        $user = session('user');
        if (!$user || ($user['role'] ?? null) !== 'ngo') {
            return redirect('/login');
        }
        $validated = $request->validate([
            'species' => 'required|string|max:100',
            'location' => 'required|string|max:150',
            'planted_at' => 'nullable|date',
        ]);
        $validated['user_id'] = $user['id'];
        $tree = Tree::create($validated);
        return redirect('/dashboard')->with('success', 'Tree added successfully');
    }
    // Browse trees
    public function index(Request $request)
    {
        $query = Tree::where('is_available', true);

        if ($request->filled('species')) {
            $query->where('species', 'like', '%' . $request->species . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        $trees = $query->paginate(12);

        // Get unique species for dropdown
        $speciesList = Tree::where('is_available', true)
            ->select('species')
            ->distinct()
            ->orderBy('species')
            ->pluck('species');

        return view('trees.index', compact('trees', 'speciesList'));
    }

    // Show tree details
    public function show(Tree $tree)
    {
        $photos = $tree->photos()->get();
        $adoption = $tree->activeAdoption()->first();
        $sponsorships = $tree->sponsorships()->completed()->get();

        return view('trees.show', compact('tree', 'photos', 'adoption', 'sponsorships'));
    }

    // Admin: Create tree form
    public function create()
    {
        // Access controlled by EnsureAdmin middleware on admin routes
        return view('trees.create');
    }

    // Admin: Store tree
    public function store(Request $request)
    {
        // Access controlled by EnsureAdmin middleware on admin routes

        $validated = $request->validate([
            'species' => 'required|string|max:100',
            'common_name' => 'nullable|string|max:100',
            'scientific_name' => 'nullable|string|max:150',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:150',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'planted_at' => 'nullable|date',
            'status' => 'in:planted,growing,mature',
            'co2_offset' => 'nullable|integer|min:0',
        ]);

        $validated['user_id'] = auth()->id();
        $tree = Tree::create($validated);

        return redirect()->route('trees.show', $tree)->with('success', 'Tree added successfully');
    }

    // Admin: Edit tree form
    public function edit(Tree $tree)
    {
        // Access controlled by EnsureAdmin middleware on admin routes
        return view('trees.edit', compact('tree'));
    }

    // Admin: Update tree
    public function update(Request $request, Tree $tree)
    {
        // Access controlled by EnsureAdmin middleware on admin routes

        $validated = $request->validate([
            'species' => 'required|string|max:100',
            'common_name' => 'nullable|string|max:100',
            'scientific_name' => 'nullable|string|max:150',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:150',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'planted_at' => 'nullable|date',
            'status' => 'in:planted,growing,mature',
            'co2_offset' => 'nullable|integer|min:0',
            'is_available' => 'boolean',
            'notes' => 'nullable|string',
        ]);

        $tree->update($validated);

        return redirect()->route('trees.show', $tree)->with('success', 'Tree updated successfully');
    }

    // Admin: Delete tree
    public function destroy(Tree $tree)
    {
        // Access controlled by EnsureAdmin middleware on admin routes
        $tree->delete();
        return redirect()->route('trees.index')->with('success', 'Tree deleted successfully');
    }

    // Upload photo for tree
    public function uploadPhoto(Request $request, Tree $tree)
    {
        // Access controlled by EnsureAdmin middleware on admin routes

        $validated = $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            'caption' => 'nullable|string|max:500',
            'growth_notes' => 'nullable|string',
            'growth_status' => 'nullable|in:planted,sprouting,growing,flowering,mature',
            'taken_at' => 'nullable|date',
        ]);

        $path = $request->file('photo')->store('trees', 'public');

        $photo = TreePhoto::create([
            'tree_id' => $tree->id,
            'photo_path' => $path,
            'caption' => $validated['caption'] ?? null,
            'growth_notes' => $validated['growth_notes'] ?? null,
            'growth_status' => $validated['growth_status'] ?? null,
            'uploaded_by_user_id' => auth()->id(),
            'taken_at' => $validated['taken_at'] ?? now(),
        ]);

        $tree->update(['current_photo_path' => $path]);

        return redirect()->route('trees.show', $tree)->with('success', 'Photo uploaded successfully');
    }

    // Map view
    public function map()
    {
        $trees = Tree::where('is_available', true)
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get();

        return view('trees.map', compact('trees'));
    }

    // API: Get trees for map
    public function getMapData()
    {
        return Tree::where('is_available', true)
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->with('activeAdoption.user', 'latestPhoto')
            ->get([
                'id', 'species', 'common_name', 'location',
                'latitude', 'longitude', 'status', 'co2_offset',
                'current_photo_path', 'planted_at'
            ]);
    }
}
