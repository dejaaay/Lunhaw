@extends('layouts.app')

@section('title', 'Admin Dashboard - Project Lunhaw')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-4xl font-bold text-gray-900">Admin Dashboard</h1>
        <a href="/logout" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">Logout</a>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="text-gray-600 text-sm font-medium">Total Users</div>
            <div class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_users'] }}</div>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <div class="text-gray-600 text-sm font-medium">Total Trees</div>
            <div class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_trees'] }}</div>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <div class="text-gray-600 text-sm font-medium">Total Sponsorships</div>
            <div class="text-3xl font-bold text-green-600 mt-2">₱{{ number_format($stats['total_revenue'], 2) }}</div>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <div class="text-gray-600 text-sm font-medium">CO₂ Offset</div>
            <div class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_co2_offset'] }} kg</div>
        </div>
    </div>

    <!-- Admin Menu -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-bold text-gray-900 mb-4">User Management</h2>
            <div class="space-y-2">
                <a href="{{ route('admin.users') }}" class="block text-blue-600 hover:underline">View All Users</a>
                <a href="{{ route('admin.users.create') }}" class="block text-blue-600 hover:underline">Create New User</a>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-bold text-gray-900 mb-4">Organizations / Partners</h2>
            <div class="space-y-2">
                <a href="{{ route('admin.organizations') }}" class="block text-blue-600 hover:underline">View Organizations</a>
                <a href="{{ route('admin.organizations.create') }}" class="block text-blue-600 hover:underline">Add Organization</a>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-bold text-gray-900 mb-4">Tree Management</h2>
            <div class="space-y-2">
                <a href="/trees" class="block text-blue-600 hover:underline">View All Trees</a>
                <a href="{{ route('trees.create') }}" class="block text-blue-600 hover:underline">Add New Tree</a>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-bold text-gray-900 mb-4">Sponsorships</h2>
            <div class="space-y-2">
                <a href="{{ route('admin.sponsorships') }}" class="block text-blue-600 hover:underline">View Sponsorships</a>
                <p class="text-sm text-gray-600">Total Revenue: ₱{{ number_format($stats['total_revenue'], 2) }}</p>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-bold text-gray-900 mb-4">Reports</h2>
            <div class="space-y-2">
                <a href="{{ route('admin.reports') }}" class="block text-blue-600 hover:underline">View Reports</a>
                <a href="{{ route('admin.activity-logs') }}" class="block text-blue-600 hover:underline">Activity Logs</a>
            </div>
        </div>
    </div>

    <!-- Recent Activities -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-bold text-gray-900 mb-4">Recent Activity</h2>
        <div class="space-y-3">
            @forelse($recentActivities as $log)
                <div class="flex justify-between items-center p-3 bg-gray-50 rounded">
                    <div>
                        <p class="font-medium text-gray-900">{{ $log->user->name ?? 'System' }}</p>
                        <p class="text-sm text-gray-600">{{ $log->description ?? ucfirst($log->action) }}</p>
                    </div>
                    <p class="text-sm text-gray-500">{{ $log->created_at->diffForHumans() }}</p>
                </div>
            @empty
                <p class="text-gray-600">No recent activities</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
