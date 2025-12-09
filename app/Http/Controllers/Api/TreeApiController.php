<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tree;
use Illuminate\Http\Request;

class TreeApiController extends Controller
{
    public function index(Request $request)
    {
        $query = Tree::where('is_available', true);

        if ($request->filled('species')) {
            $query->where('species', 'like', '%' . $request->species . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $trees = $query->with('activeAdoption.user', 'photos')->paginate(20);

        return response()->json($trees);
    }

    public function show(Tree $tree)
    {
        $tree->load('activeAdoption.user', 'photos', 'sponsorships');

        return response()->json($tree);
    }

    public function mapData()
    {
        $trees = Tree::where('is_available', true)
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->with('activeAdoption.user', 'photos')
            ->get([
                'id', 'species', 'common_name', 'location',
                'latitude', 'longitude', 'status', 'co2_offset',
                'planted_at'
            ]);

        return response()->json($trees);
    }
}
