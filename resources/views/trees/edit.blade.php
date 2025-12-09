@extends('layouts.app')

@section('title', 'Edit Tree - Project Lunhaw')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-lg shadow p-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Edit Tree</h1>

        <form action="{{ route('trees.update', $tree) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Species *</label>
                <input type="text" name="species" required value="{{ $tree->species }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
                @error('species') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Common Name</label>
                <input type="text" name="common_name" value="{{ $tree->common_name }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Scientific Name</label>
                <input type="text" name="scientific_name" value="{{ $tree->scientific_name }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea name="description" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg">{{ $tree->description }}</textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Latitude</label>
                    <input type="number" name="latitude" step="0.00000001" value="{{ $tree->latitude }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Longitude</label>
                    <input type="number" name="longitude" step="0.00000001" value="{{ $tree->longitude }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                <input type="text" name="location" value="{{ $tree->location }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Planted Date</label>
                    <input type="date" name="planted_at" value="{{ $tree->planted_at?->format('Y-m-d') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                        <option value="planted" {{ $tree->status === 'planted' ? 'selected' : '' }}>Planted</option>
                        <option value="growing" {{ $tree->status === 'growing' ? 'selected' : '' }}>Growing</option>
                        <option value="mature" {{ $tree->status === 'mature' ? 'selected' : '' }}>Mature</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">CO₂ Offset (kg)</label>
                <input type="number" name="co2_offset" min="0" value="{{ $tree->co2_offset }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
            </div>

            <div>
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="is_available" {{ $tree->is_available ? 'checked' : '' }} class="rounded">
                    <span class="text-sm font-medium text-gray-700">Available for Adoption</span>
                </label>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Notes</label>
                <textarea name="notes" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg">{{ $tree->notes }}</textarea>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="flex-1 bg-green-600 text-white px-6 py-3 rounded-lg font-bold hover:bg-green-700">Update Tree</button>
                <a href="{{ route('trees.show', $tree) }}" class="flex-1 text-center text-gray-600 border border-gray-300 px-6 py-3 rounded-lg hover:bg-gray-50">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
