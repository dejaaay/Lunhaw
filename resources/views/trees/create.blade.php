@extends('layouts.app')

@section('title', 'Add Tree - Project Lunhaw')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-lg shadow p-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Add a New Tree</h1>

        <form action="{{ route('trees.store') }}" method="POST" class="space-y-6" data-confirm="Are you sure you want to add this tree?">
            @csrf
            <input type="hidden" name="confirm" value="1">

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Species *</label>
                <input type="text" name="species" required value="{{ old('species') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500" placeholder="e.g., Mango">
                @error('species') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Common Name</label>
                <input type="text" name="common_name" value="{{ old('common_name') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500" placeholder="e.g., Mango Tree">
                @error('common_name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Scientific Name</label>
                <input type="text" name="scientific_name" value="{{ old('scientific_name') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500" placeholder="e.g., Mangifera indica">
                @error('scientific_name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea name="description" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500" placeholder="Describe the tree...">{{ old('description') }}</textarea>
                @error('description') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Latitude</label>
                    <input type="number" name="latitude" step="0.00000001" min="-90" max="90" value="{{ old('latitude') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg" placeholder="14.5995">
                    <p class="text-xs text-gray-500 mt-1">Value must be between -90 and 90</p>
                    @error('latitude') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Longitude</label>
                    <input type="number" name="longitude" step="0.00000001" value="{{ old('longitude') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg" placeholder="120.9842">
                    @error('longitude') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                <input type="text" name="location" value="{{ old('location') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500" placeholder="e.g., Quezon City">
                @error('location') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Planted Date</label>
                    <input type="date" name="planted_at" value="{{ old('planted_at') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    <p class="text-xs text-gray-500 mt-1">Format: dd/mm/yyyy (browser date picker may use yyyy-mm-dd)</p>
                    @error('planted_at') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                        <option value="planted" {{ old('status','planted') === 'planted' ? 'selected' : '' }}>Planted</option>
                        <option value="growing" {{ old('status') === 'growing' ? 'selected' : '' }}>Growing</option>
                        <option value="mature" {{ old('status') === 'mature' ? 'selected' : '' }}>Mature</option>
                    </select>
                    @error('status') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">CO₂ Offset (kg)</label>
                <input type="number" name="co2_offset" min="0" value="{{ old('co2_offset', 0) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                @error('co2_offset') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex gap-4">
                <button type="submit" class="flex-1 bg-green-600 text-white px-6 py-3 rounded-lg font-bold hover:bg-green-700">Add Tree</button>
                <a href="/trees" class="flex-1 text-center text-gray-600 border border-gray-300 px-6 py-3 rounded-lg hover:bg-gray-50">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
