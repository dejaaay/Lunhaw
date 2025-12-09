<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function partner()
    {
        $user = session('user');
        if (!$user || ($user['role'] ?? null) !== 'ngo') {
            return redirect('/login');
        }
        $userModel = User::find($user['id']);
        $trees = $userModel->trees()->orderByDesc('planted_at')->get();
        return view('dashboard.partner', [
            'user' => $user,
            'trees' => $trees,
        ]);
    }
    public function user()
    {
        $user = session('user');
        if (!$user) {
            return redirect('/login');
        }

        // Get the actual user model with relationships
        $userModel = User::find($user['id']);

        $planted = DB::table('trees')
            ->where('user_id', $user['id'] ?? null)
            ->select('id','species','location','planted_at')
            ->orderByDesc('planted_at')
            ->get();

        $sponsorships = DB::table('sponsorships')
            ->where('sponsorships.user_id', $user['id'] ?? null)
            ->join('trees','sponsorships.tree_id','=','trees.id')
            ->select('sponsorships.id','sponsorships.amount','sponsorships.status','trees.species','trees.location','trees.id as tree_id','trees.common_name')
            ->orderByDesc('sponsorships.created_at')
            ->get();

        return view('dashboard.user', [
            'user' => $user,
            'planted' => $planted,
            'sponsorships' => $sponsorships,
        ]);
    }

    public function admin()
    {
        $admin = session('admin');
        if (!$admin) {
            return redirect('/admin/login');
        }

        $usersCount = DB::table('users')->count();
        $treesCount = DB::table('trees')->count();
        $sponsorshipsCount = DB::table('sponsorships')->count();

        return view('dashboard.admin', [
            'admin' => $admin,
            'usersCount' => $usersCount,
            'treesCount' => $treesCount,
            'sponsorshipsCount' => $sponsorshipsCount,
        ]);
    }
}
