<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tree;
use App\Models\Adoption;
use App\Models\Sponsorship;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Organization Management
    public function organizations()
    {
        $admin = session('admin');
        if (!$admin) {
            return redirect('/admin/login');
        }
        $organizations = User::where('role', 'ngo')->paginate(20);
        return view('admin.organizations.index', compact('organizations'));
    }

    public function createOrganization()
    {
        $admin = session('admin');
        if (!$admin) {
            return redirect('/admin/login');
        }
        return view('admin.organizations.create');
    }

    public function storeOrganization(Request $request)
    {
        $admin = session('admin');
        if (!$admin) {
            return redirect('/admin/login');
        }
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users|max:191',
            'password' => 'required|string|min:6',
            'bio' => 'nullable|string',
        ]);
        $validated['role'] = 'ngo';
        $validated['password'] = Hash::make($validated['password']);
        $org = User::create($validated);
        ActivityLog::log('create_organization', 'user', $org->id, "Created organization: {$org->name}");
        return redirect()->route('admin.organizations')->with('success', 'Organization created successfully');
    }
    // User Management
    public function users()
    {
        $admin = session('admin');
        if (!$admin) {
            return redirect('/admin/login');
        }

        $users = User::paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function createUser()
    {
        $admin = session('admin');
        if (!$admin) {
            return redirect('/admin/login');
        }

        return view('admin.users.create');
    }

    public function storeUser(Request $request)
    {
        $admin = session('admin');
        if (!$admin) {
            return redirect('/admin/login');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users|max:191',
            'password' => 'required|string|min:6',
            'role' => 'required|in:user,admin,ngo,lgu',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $user = User::create($validated);

        ActivityLog::log('create_user', 'user', $user->id, "Created user: {$user->name}");

        return redirect()->route('admin.users')->with('success', 'User created successfully');
    }

    public function editUser(User $user)
    {
        $admin = session('admin');
        if (!$admin) {
            return redirect('/admin/login');
        }

        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $admin = session('admin');
        if (!$admin) {
            return redirect('/admin/login');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:191|unique:users,email,' . $user->id,
            'role' => 'required|in:user,admin,ngo,lgu',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $user->update($validated);

        ActivityLog::log('update_user', 'user', $user->id, "Updated user: {$user->name}");

        return redirect()->route('admin.users')->with('success', 'User updated successfully');
    }

    public function deleteUser(User $user)
    {
        $admin = session('admin');
        if (!$admin) {
            return redirect('/admin/login');
        }

        $user->update(['is_active' => false]);

        ActivityLog::log('disable_user', 'user', $user->id, "Disabled user: {$user->name}");

        return redirect()->route('admin.users')->with('success', 'User disabled successfully');
    }

    // Dashboard Statistics
    public function dashboard()
    {
        $admin = session('admin');
        if (!$admin) {
            return redirect('/admin/login');
        }

        $stats = [
            'total_users' => User::count(),
            'total_trees' => Tree::count(),
            'total_adoptions' => Adoption::count(),
            'total_sponsorships' => Sponsorship::count(),
            'total_revenue' => Sponsorship::where('status', 'completed')->sum('amount'),
            'total_co2_offset' => Tree::sum('co2_offset'),
            'active_users' => User::where('is_active', true)->count(),
            'available_trees' => Tree::where('is_available', true)->count(),
        ];

        $recentActivities = ActivityLog::with('user')->latest()->limit(10)->get();
        $topSponsorships = Sponsorship::where('status', 'completed')
            ->with('user', 'tree')
            ->orderByDesc('amount')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentActivities', 'topSponsorships'));
    }

    // Reports
    public function reports()
    {
        $admin = session('admin');
        if (!$admin) {
            return redirect('/admin/login');
        }

        $userGrowth = User::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->limit(30)
            ->get();

        $adoptionTrends = Adoption::selectRaw('DATE(adopted_at) as date, COUNT(*) as count')
            ->where('adopted_at', '!=', null)
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->limit(30)
            ->get();

        $sponsorshipTrends = Sponsorship::selectRaw('DATE(created_at) as date, SUM(amount) as total, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->limit(30)
            ->get();

        return view('admin.reports', compact('userGrowth', 'adoptionTrends', 'sponsorshipTrends'));
    }

    // Activity Logs
    public function activityLogs()
    {
        $admin = session('admin');
        if (!$admin) {
            return redirect('/admin/login');
        }

        $logs = ActivityLog::with('user')
            ->orderByDesc('created_at')
            ->paginate(50);

        return view('admin.activity-logs', compact('logs'));
    }
}
