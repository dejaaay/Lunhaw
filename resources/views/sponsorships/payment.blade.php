@extends('layouts.app')

@section('title', 'Payment - Project Lunhaw')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-lg shadow p-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-4">Complete Payment</h1>

        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-8">
            <h2 class="text-lg font-bold text-gray-900 mb-2">Payment Summary</h2>
            <div class="space-y-2 text-sm">
                <p><strong>Tree:</strong> {{ $sponsorship->tree->common_name ?? $sponsorship->tree->species }}</p>
                <p><strong>Amount:</strong> ₱{{ number_format($sponsorship->amount, 2) }}</p>
                <p><strong>Payment Method:</strong> {{ ucfirst(str_replace('_', ' ', $sponsorship->payment_method)) }}</p>
            </div>
        </div>

        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 mb-8">
            <p class="text-sm text-yellow-900">
                <strong>Note:</strong> This is a payment simulation. In a production environment, you would be redirected to the actual payment gateway (GCash, Maya, or bank transfer).
            </p>
        </div>

        <form action="{{ route('sponsorships.process', $sponsorship) }}" method="POST" class="space-y-6" data-confirm="Are you sure you want to complete this payment?">
            @csrf
            <input type="hidden" name="confirm" value="1">

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Cardholder Name</label>
                <input type="text" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent" placeholder="Your Name">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Card Number</label>
                    <input type="text" required placeholder="1234 5678 9012 3456" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">CVV</label>
                    <input type="text" required placeholder="123" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Expiry</label>
                    <input type="text" required placeholder="MM/YY" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">ZIP Code</label>
                    <input type="text" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                </div>
            </div>

            <div class="flex gap-2">
                <button type="submit" class="flex-1 bg-green-600 text-white px-6 py-3 rounded-lg font-bold hover:bg-green-700">Complete Payment</button>
                <a href="{{ route('trees.show', $sponsorship->tree) }}" class="flex-1 text-center text-gray-600 border border-gray-300 px-6 py-3 rounded-lg hover:bg-gray-50">Cancel</a>
            </div>
        </form>

        <p class="text-xs text-gray-500 text-center mt-4">All transactions are securely processed.</p>
    </div>
</div>
@endsection
