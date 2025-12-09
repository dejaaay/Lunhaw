@extends('layouts.app')

@section('title', 'Browse Trees - Project Lunhaw')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-4xl font-bold text-gray-900 mb-8">Browse Available Trees</h1>

    <div class="lg:flex lg:gap-8">
        <!-- Sidebar (admin actions) -->
        <aside class="hidden lg:block w-64">
            <div class="bg-white rounded-lg shadow p-4 mb-6">
                <h2 class="text-lg font-semibold mb-3">Actions</h2>
                @if(session('admin') || (is_array(session('user')) && (session('user.role') ?? '') === 'admin'))
                    <a href="{{ route('trees.create') }}" class="block w-full text-left bg-green-600 text-white px-3 py-2 rounded-md hover:bg-green-700">Add Tree</a>
                @else
                    <p class="text-sm text-gray-600">Admin actions appear here.</p>
                @endif
            </div>
            <div class="bg-white rounded-lg shadow p-4">
                <h3 class="text-sm font-medium text-gray-700 mb-2">Quick Filters</h3>
                <ul class="text-sm space-y-2">
                    <li><a href="{{ route('trees.index') }}?status=planted" class="text-neutral-700 hover:text-neutral-900">Planted</a></li>
                    <li><a href="{{ route('trees.index') }}?status=growing" class="text-neutral-700 hover:text-neutral-900">Growing</a></li>
                    <li><a href="{{ route('trees.index') }}?status=mature" class="text-neutral-700 hover:text-neutral-900">Mature</a></li>
                </ul>
            </div>
        </aside>

        <!-- Main content -->
        <main class="flex-1">
            <!-- Search and Filter -->
            <div class="bg-white rounded-lg shadow p-6 mb-8">
                <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Species</label>
                        <select name="species" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                            <option value="">All Species</option>
                            @foreach($speciesList as $species)
                                <option value="{{ $species }}" {{ request('species') == $species ? 'selected' : '' }}>{{ $species }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                            <option value="">All Statuses</option>
                            <option value="planted" {{ request('status') === 'planted' ? 'selected' : '' }}>Planted</option>
                            <option value="growing" {{ request('status') === 'growing' ? 'selected' : '' }}>Growing</option>
                            <option value="mature" {{ request('status') === 'mature' ? 'selected' : '' }}>Mature</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                        <input type="text" name="location" value="{{ request('location') }}" placeholder="e.g., Quezon City" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="w-full bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">Search</button>
                    </div>
                </form>
            </div>

            <!-- Trees Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($trees as $tree)
                    <div class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden">
                        @if($tree->current_photo_path)
                            <img src="{{ asset('storage/' . $tree->current_photo_path) }}" alt="{{ $tree->species }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                <span class="text-4xl">🌳</span>
                            </div>
                        @endif
                        <div class="p-4">
                            <h3 class="text-lg font-bold text-gray-900">{{ $tree->common_name ?? $tree->species }}</h3>
                            <p class="text-sm text-gray-600">{{ $tree->scientific_name }}</p>
                            <div class="mt-2 space-y-1 text-sm">
                                <p><strong>Location:</strong> {{ $tree->location ?? 'Not specified' }}</p>
                                <p><strong>Status:</strong> <span class="px-2 py-1 rounded bg-blue-100 text-blue-800">{{ ucfirst($tree->status) }}</span></p>
                                <p><strong>CO₂ Offset:</strong> {{ $tree->co2_offset }} kg</p>
                                <p><strong>Partner/NGO:</strong> {{ $tree->manager?->name ?? 'N/A' }}</p>
                            </div>
                            @if($tree->activeAdoption)
                                <p class="mt-4 px-3 py-2 bg-yellow-100 text-yellow-800 rounded text-sm">
                                    Adopted by: {{ $tree->activeAdoption->user->name }}
                                </p>
                            @else
                                <div class="mt-4 flex gap-2">
                                    <a href="{{ route('trees.show', $tree) }}" class="flex-1 bg-blue-600 text-white px-4 py-2 rounded text-center hover:bg-blue-700">View Details</a>
                                    @if(session('user'))
                                        <a href="{{ route('sponsorships.create', $tree) }}" class="flex-1 bg-green-600 text-white px-4 py-2 rounded text-center hover:bg-green-700">Sponsor</a>
                                    @else
                                        <a href="/login" class="flex-1 bg-green-600 text-white px-4 py-2 rounded text-center hover:bg-green-700">Sponsor</a>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-600 text-lg">No trees found. Try adjusting your filters.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $trees->links() }}
            </div>
        </main>
    </div>
</div>
@endsection
