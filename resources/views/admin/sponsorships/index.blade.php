@extends('layouts.app')

@section('title', 'Admin Sponsorships - Project Lunhaw')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-4xl font-bold text-gray-900 mb-8">Sponsorship Management</h1>

    <!-- Summary -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="text-gray-600 text-sm font-medium">Total Sponsorships</div>
            <div class="text-3xl font-bold text-gray-900 mt-2">{{ $sponsorships->total() }}</div>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <div class="text-gray-600 text-sm font-medium">Completed</div>
            <div class="text-3xl font-bold text-green-600 mt-2">{{ $completedCount }}</div>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <div class="text-gray-600 text-sm font-medium">Total Revenue</div>
            <div class="text-3xl font-bold text-blue-600 mt-2">₱{{ number_format($totalRevenue, 2) }}</div>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">ID</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Sponsor</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Tree</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Amount</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Method</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Status</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sponsorships as $sponsorship)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm font-mono">{{ $sponsorship->id }}</td>
                        <td class="px-6 py-4 text-sm">{{ $sponsorship->user->name }}</td>
                        <td class="px-6 py-4 text-sm">{{ $sponsorship->tree->common_name ?? $sponsorship->tree->species }}</td>
                        <td class="px-6 py-4 text-sm font-bold">₱{{ number_format($sponsorship->amount, 2) }}</td>
                        <td class="px-6 py-4 text-sm">{{ ucfirst(str_replace('_', ' ', $sponsorship->payment_method)) }}</td>
                        <td class="px-6 py-4 text-sm">
                            <span class="px-3 py-1 rounded text-sm {{ $sponsorship->status === 'completed' ? 'bg-green-100 text-green-800' : ($sponsorship->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                {{ ucfirst($sponsorship->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm">{{ $sponsorship->created_at->format('M d, Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-600">No sponsorships found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $sponsorships->links() }}
    </div>
</div>
@endsection
