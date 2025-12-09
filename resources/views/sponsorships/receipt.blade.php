@extends('layouts.app')

@section('title', 'Receipt - Project Lunhaw')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-lg shadow p-8 text-center">
        <div class="text-6xl mb-4">✓</div>
        <h1 class="text-3xl font-bold text-green-600 mb-2">Payment Successful!</h1>
        <p class="text-gray-600 mb-8">Thank you for sponsoring this tree</p>

        <div class="bg-gray-50 rounded-lg p-8 mb-8 text-left">
            <h2 class="text-lg font-bold text-gray-900 mb-4">Receipt Details</h2>
            
            <div class="space-y-3 border-b border-gray-200 pb-4">
                <div class="flex justify-between">
                    <span class="text-gray-600">Transaction Reference:</span>
                    <span class="font-bold">{{ $sponsorship->transaction_reference }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Date & Time:</span>
                    <span>{{ $sponsorship->paid_at->format('M d, Y h:i A') }}</span>
                </div>
            </div>

            <div class="space-y-3 border-b border-gray-200 py-4">
                <div class="flex justify-between">
                    <span class="text-gray-600">Tree:</span>
                    <span class="font-semibold">{{ $sponsorship->tree->common_name ?? $sponsorship->tree->species }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Location:</span>
                    <span>{{ $sponsorship->tree->location }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Payment Method:</span>
                    <span>{{ ucfirst(str_replace('_', ' ', $sponsorship->payment_method)) }}</span>
                </div>
            </div>

            <div class="flex justify-between text-lg font-bold py-4">
                <span>Total Amount:</span>
                <span class="text-green-600">₱{{ number_format($sponsorship->amount, 2) }}</span>
            </div>
        </div>

        <div class="bg-green-50 border border-green-200 rounded-lg p-6 mb-8">
            <p class="text-green-900">
                <strong>Impact:</strong> Your sponsorship adds 5kg CO₂ offset to this tree's total! 🌱
            </p>
        </div>

        <div class="flex gap-4">
            <a href="{{ route('trees.show', $sponsorship->tree) }}" class="flex-1 bg-blue-600 text-white px-6 py-3 rounded-lg font-bold hover:bg-blue-700">View Tree</a>
            <a href="/dashboard" class="flex-1 bg-green-600 text-white px-6 py-3 rounded-lg font-bold hover:bg-green-700">Go to Dashboard</a>
        </div>
    </div>
</div>
@endsection
