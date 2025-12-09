<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function user()
    {
        $user = session('user');
        if (!$user) {
            return redirect('/login');
        }

        $planted = DB::table('trees')
            ->where('user_id', $user['id'] ?? null)
            ->select('id','species','location','planted_at')
            ->orderByDesc('planted_at')
            ->get();

        $sponsorships = DB::table('sponsorships')
            ->where('sponsorships.user_id', $user['id'] ?? null)
            ->join('trees','sponsorships.tree_id','=','trees.id')
            ->select('sponsorships.id','sponsorships.amount','trees.species','trees.location')
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
