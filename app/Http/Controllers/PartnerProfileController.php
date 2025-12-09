<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PartnerProfileController extends Controller
{
    public function edit(Request $request)
    {
        $user = session('user');
        if (!$user || ($user['role'] ?? null) !== 'ngo') {
            return redirect('/login');
        }
        $userModel = User::find($user['id']);
        return view('dashboard.partner_profile_edit', ['user' => $userModel]);
    }

    public function update(Request $request)
    {
        $user = session('user');
        if (!$user || ($user['role'] ?? null) !== 'ngo') {
            return redirect('/login');
        }
        $userModel = User::find($user['id']);
        $validated = $request->validate([
            'profile_photo' => 'required|image|max:4096',
        ]);
        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $path = $file->store('profile_photos', 'public');
            $userModel->profile_photo_path = $path;
            $userModel->save();
        }
        return redirect()->route('partner.dashboard')->with('success', 'Profile photo updated successfully');
    }
}
