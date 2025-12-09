@extends('layouts.app')

@section('title', 'My Adoptions - Project Lunhaw')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-4xl font-bold text-gray-900 mb-8">My Tree Adoptions</h1>

    @if($adoptions->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($adoptions as $adoption)
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden">
                    @if($adoption->tree->current_photo_path)
                        <img src="{{ asset('storage/' . $adoption->tree->current_photo_path) }}" alt="{{ $adoption->tree->species }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                            <span class="text-4xl">🌳</span>
                        </div>
                    @endif
                    <div class="p-4">
                        <h3 class="text-lg font-bold text-gray-900">{{ $adoption->tree->common_name ?? $adoption->tree->species }}</h3>
                        <p class="text-sm text-gray-600">{{ $adoption->tree->location }}</p>
                        <div class="mt-2 space-y-1 text-sm">
                            <p><strong>Status:</strong> {{ ucfirst($adoption->tree->status) }}</p>
                            <p><strong>CO₂ Offset:</strong> {{ $adoption->tree->co2_offset }} kg</p>
                            <p><strong>Adopted:</strong> {{ $adoption->adopted_at->format('M d, Y') }}</p>
                        </div>
                        <div class="mt-4 flex gap-2">
                            <a href="{{ route('trees.show', $adoption->tree) }}" class="flex-1 bg-blue-600 text-white px-3 py-2 rounded text-center text-sm hover:bg-blue-700">View</a>
                            <form action="{{ route('adoptions.cancel', $adoption) }}" method="POST" class="flex-1">
                                @csrf
                                <button type="submit" class="w-full bg-red-600 text-white px-3 py-2 rounded text-sm hover:bg-red-700" onclick="return confirm('Are you sure?')">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $adoptions->links() }}
        </div>
    @else
        <div class="bg-white rounded-lg shadow p-12 text-center">
            <p class="text-xl text-gray-600 mb-4">You haven't adopted any trees yet</p>
            <a href="/trees" class="inline-block bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700">Browse Available Trees</a>
        </div>
    @endif
</div>
@endsection
