<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adoption;
use Illuminate\Support\Facades\Auth;

class InsightsController extends Controller
{
    public function index(Request $request)
    {
        $user = session('user');
        if (!$user) {
            return redirect('/login');
        }

        // Get all adoptions for this user (active and past)
        $adoptions = Adoption::with(['tree.latestPhoto'])
            ->where('user_id', $user['id'])
            ->orderByDesc('adopted_at')
            ->get();

        return view('insights', [
            'user' => $user,
            'adoptions' => $adoptions,
        ]);
    }
}
