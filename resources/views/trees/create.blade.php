@extends('layouts.app')

@section('title', 'Add Tree - Project Lunhaw')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-lg shadow p-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Add a New Tree</h1>

        <form action="{{ route('trees.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Species *</label>
                <input type="text" name="species" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500" placeholder="e.g., Mango">
                @error('species') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Common Name</label>
                <input type="text" name="common_name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500" placeholder="e.g., Mango Tree">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Scientific Name</label>
                <input type="text" name="scientific_name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500" placeholder="e.g., Mangifera indica">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea name="description" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500" placeholder="Describe the tree..."></textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Latitude</label>
                    <input type="number" name="latitude" step="0.00000001" class="w-full px-4 py-2 border border-gray-300 rounded-lg" placeholder="14.5995">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Longitude</label>
                    <input type="number" name="longitude" step="0.00000001" class="w-full px-4 py-2 border border-gray-300 rounded-lg" placeholder="120.9842">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                <input type="text" name="location" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500" placeholder="e.g., Quezon City">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Planted Date</label>
                    <input type="date" name="planted_at" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                        <option value="planted">Planted</option>
                        <option value="growing">Growing</option>
                        <option value="mature">Mature</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">CO₂ Offset (kg)</label>
                <input type="number" name="co2_offset" min="0" value="0" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
            </div>

            <div class="flex gap-4">
                <button type="submit" class="flex-1 bg-green-600 text-white px-6 py-3 rounded-lg font-bold hover:bg-green-700">Add Tree</button>
                <a href="/trees" class="flex-1 text-center text-gray-600 border border-gray-300 px-6 py-3 rounded-lg hover:bg-gray-50">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
