@extends('layouts.app')

@section('title', 'Partner Dashboard - Project Lunhaw')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Welcome, {{ $user['name'] ?? $user['email'] }}</h1>
    <div class="mb-8 flex gap-4">
        <a href="{{ route('partner.trees.create') }}" class="bg-green-700 text-white px-4 py-2 rounded-md hover:bg-green-800">Add New Tree</a>
        <a href="{{ route('partner.profile.edit') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Edit Profile</a>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-semibold mb-4">Your Trees</h2>
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Species</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Planted At</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($trees as $tree)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $tree->species }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $tree->location }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $tree->planted_at ? date('Y-m-d', strtotime($tree->planted_at)) : '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-6 py-4 text-center text-gray-500">No trees found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
