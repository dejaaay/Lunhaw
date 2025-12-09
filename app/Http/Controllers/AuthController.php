<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ]);

        $user = DB::table('users')->where('email', $data['email'])->first();
        if ($user && Hash::check($data['password'], $user->password)) {
            // Check if user is admin
            if ($user->role === 'admin') {
                session(['admin' => ['id' => $user->id, 'email' => $user->email, 'name' => $user->name, 'role' => $user->role]]);
                return redirect('/admin')->with('status', 'Logged in as admin');
            } else {
                session(['user' => ['id' => $user->id, 'email' => $user->email, 'name' => $user->name, 'role' => $user->role]]);
                return redirect('/dashboard')->with('status', 'Logged in successfully');
            }
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    public function showAdminLogin()
    {
        return view('auth.admin_login');
    }

    public function adminLogin(Request $request)
    {
        $data = $request->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ]);

        $user = DB::table('users')->where('email', $data['email'])->first();
        if ($user && $user->role === 'admin' && Hash::check($data['password'], $user->password)) {
            session(['admin' => ['id' => $user->id, 'email' => $user->email, 'name' => $user->name, 'role' => $user->role]]);
            return redirect('/admin')->with('status', 'Logged in as admin');
        }

        return back()->withErrors(['email' => 'Invalid admin credentials'])->withInput();
    }

    public function logout()
    {
        session()->forget(['user','admin']);
        return redirect('/')->with('status', 'Logged out');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:100'],
            'email' => ['required','email','max:191'],
            'password' => ['required','min:6','confirmed'],
        ]);

        $exists = DB::table('users')->where('email', $data['email'])->exists();
        if ($exists) {
            return back()->withErrors(['email' => 'Email already registered'])->withInput();
        }

        $id = DB::table('users')->insertGetId([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        session(['user' => ['id' => $id, 'email' => $data['email'], 'name' => $data['name'], 'role' => 'user']]);
        return redirect('/dashboard')->with('status', 'Registered and logged in');
    }
}
