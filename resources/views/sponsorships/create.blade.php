@extends('layouts.app')

@section('title', 'Sponsor ' . ($tree->common_name ?? $tree->species) . ' - Project Lunhaw')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-lg shadow p-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-4">Sponsor a Tree</h1>
        <p class="text-gray-600 mb-8">Help ensure this tree thrives and continues to offset CO₂</p>

        <div class="bg-green-50 border border-green-200 rounded-lg p-6 mb-8">
            <h2 class="text-lg font-bold text-gray-900 mb-2">{{ $tree->common_name ?? $tree->species }}</h2>
            <p class="text-gray-700">{{ $tree->location }}</p>
            <p class="text-sm text-gray-600 mt-2">Current CO₂ Offset: <strong>{{ $tree->co2_offset }} kg</strong></p>
        </div>

        <form action="{{ route('sponsorships.store', $tree) }}" method="POST" class="space-y-6" data-confirm="Confirm sponsorship of this tree?">
            @csrf

            <input type="hidden" name="confirm" value="1">

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Sponsorship Amount (₱)</label>
                <div class="relative">
                    <span class="absolute left-3 top-3 text-gray-500">₱</span>
                    <input type="number" name="amount" step="0.01" min="10" max="100000" required class="w-full pl-8 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent" placeholder="500.00">
                </div>
                <p class="text-sm text-gray-500 mt-1">Minimum: ₱10 | Maximum: ₱100,000</p>
                @error('amount')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Payment Method</label>
                <div class="space-y-3">
                    <label class="flex items-center">
                        <input type="radio" name="payment_method" value="gcash" required class="mr-2"> GCash
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="payment_method" value="maya" required class="mr-2"> Maya
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="payment_method" value="bank_transfer" required class="mr-2"> Bank Transfer
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="payment_method" value="cash" required class="mr-2"> Cash on Pickup
                    </label>
                </div>
                @error('payment_method')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <p class="text-sm text-blue-900">
                    <strong>Note:</strong> By sponsoring this tree, you're contributing to environmental conservation. A 5kg CO₂ offset bonus will be added to this tree's total impact.
                </p>
            </div>

            <button type="submit" class="w-full bg-green-600 text-white px-6 py-3 rounded-lg font-bold hover:bg-green-700">Continue to Payment</button>
            <a href="{{ route('trees.show', $tree) }}" class="block w-full text-center text-gray-600 hover:text-gray-900">Cancel</a>
        </form>
    </div>
</div>
@endsection
