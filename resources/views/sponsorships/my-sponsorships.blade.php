@extends('layouts.app')

@section('title', 'My Sponsorships - Project Lunhaw')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-4xl font-bold text-gray-900 mb-8">My Sponsorships</h1>

    @if($sponsorships->count() > 0)
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Tree</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Location</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Amount</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Status</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Date</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sponsorships as $sponsorship)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm">
                                <strong>{{ $sponsorship->tree->common_name ?? $sponsorship->tree->species }}</strong>
                            </td>
                            <td class="px-6 py-4 text-sm">{{ $sponsorship->tree->location }}</td>
                            <td class="px-6 py-4 text-sm font-bold text-green-600">₱{{ number_format($sponsorship->amount, 2) }}</td>
                            <td class="px-6 py-4 text-sm">
                                <span class="px-3 py-1 rounded text-sm {{ $sponsorship->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ ucfirst($sponsorship->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm">{{ $sponsorship->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4 text-sm">
                                <a href="{{ route('trees.show', $sponsorship->tree) }}" class="text-blue-600 hover:underline">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-8">
            {{ $sponsorships->links() }}
        </div>
    @else
        <div class="bg-white rounded-lg shadow p-12 text-center">
            <p class="text-xl text-gray-600 mb-4">You haven't sponsored any trees yet</p>
            <a href="/trees" class="inline-block bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700">Browse and Sponsor Trees</a>
        </div>
    @endif
</div>
@endsection
