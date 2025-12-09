@extends('layouts.app')

@section('title', $tree->common_name ?? $tree->species . ' - Project Lunhaw')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <!-- Image -->
            @if($tree->current_photo_path)
                <img src="{{ asset('storage/' . $tree->current_photo_path) }}" alt="{{ $tree->species }}" class="w-full h-96 object-cover rounded-lg">
            @else
                <div class="w-full h-96 bg-gray-200 rounded-lg flex items-center justify-center">
                    <span class="text-8xl">🌳</span>
                </div>
            @endif

            <!-- Tree Information -->
            <div class="bg-white rounded-lg shadow p-6 mt-6">
                <h1 class="text-3xl font-bold text-gray-900">{{ $tree->common_name ?? $tree->species }}</h1>
                <p class="text-gray-600 italic mt-2">{{ $tree->scientific_name }}</p>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6">
                    <div class="bg-blue-50 p-4 rounded">
                        <p class="text-sm text-gray-600">Status</p>
                        <p class="text-lg font-bold text-blue-600">{{ ucfirst($tree->status) }}</p>
                    </div>
                    <div class="bg-green-50 p-4 rounded">
                        <p class="text-sm text-gray-600">CO₂ Offset</p>
                        <p class="text-lg font-bold text-green-600">{{ $tree->co2_offset }} kg</p>
                    </div>
                    <div class="bg-yellow-50 p-4 rounded">
                        <p class="text-sm text-gray-600">Location</p>
                        <p class="text-lg font-bold text-yellow-600">{{ $tree->location ?? 'N/A' }}</p>
                    </div>
                    <div class="bg-purple-50 p-4 rounded">
                        <p class="text-sm text-gray-600">Planted</p>
                        <p class="text-lg font-bold text-purple-600">{{ $tree->planted_at?->format('Y-m-d') ?? 'N/A' }}</p>
                    </div>
                </div>

                @if($tree->description)
                    <div class="mt-6 border-t pt-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-2">Description</h2>
                        <p class="text-gray-700">{{ $tree->description }}</p>
                    </div>
                @endif

                @if($tree->notes)
                    <div class="mt-6 border-t pt-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-2">Notes</h2>
                        <p class="text-gray-700">{{ $tree->notes }}</p>
                    </div>
                @endif
            </div>

            <!-- Photo Timeline -->
            @if($photos->count() > 0)
                <div class="bg-white rounded-lg shadow p-6 mt-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Growth Timeline</h2>
                    <div class="space-y-4">
                        @foreach($photos as $photo)
                            <div class="border-l-4 border-green-600 pl-4">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="font-bold text-gray-900">{{ $photo->taken_at?->format('F d, Y') }}</p>
                                        @if($photo->growth_status)
                                            <span class="text-sm px-2 py-1 bg-blue-100 text-blue-800 rounded">{{ ucfirst($photo->growth_status) }}</span>
                                        @endif
                                    </div>
                                </div>
                                @if($photo->caption)
                                    <p class="text-gray-700 mt-2">{{ $photo->caption }}</p>
                                @endif
                                @if($photo->growth_notes)
                                    <p class="text-gray-600 text-sm mt-1">{{ $photo->growth_notes }}</p>
                                @endif
                                @if($photo->photo_path)
                                    <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="Growth photo" class="w-full h-64 object-cover rounded mt-2">
                                @endif
                                @if(session('user') && session('user.role') === 'ngo' && $tree->user_id === session('user.id'))
                                    <a href="{{ route('trees.photos.edit', [$tree, $photo]) }}" class="inline-block mt-2 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Edit Photo</a>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Sponsorships -->
            @if($sponsorships->count() > 0)
                <div class="bg-white rounded-lg shadow p-6 mt-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Sponsors</h2>
                    <p class="text-gray-600 mb-4">{{ $sponsorships->count() }} people have sponsored this tree</p>
                    <div class="space-y-2">
                        @foreach($sponsorships->unique('user_id') as $sponsorship)
                            <div class="flex justify-between items-center p-2 bg-gray-50 rounded">
                                <span class="font-medium">{{ $sponsorship->user->name }}</span>
                                <span class="text-green-600 font-bold">₱{{ number_format($sponsorship->amount, 2) }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div>
            @if($adoption)
                <div class="bg-green-50 border border-green-200 rounded-lg p-6 mb-6">
                    <h3 class="text-lg font-bold text-green-900 mb-2">✓ Adopted</h3>
                    <p class="text-green-800">Adopted by: <strong>{{ $adoption->user->name }}</strong></p>
                    <p class="text-sm text-green-700 mt-2">Since {{ $adoption->adopted_at->format('F d, Y') }}</p>
                </div>
            @else
                <div class="bg-white rounded-lg shadow p-6 mb-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Actions</h3>
                    @if(session('user') && session('user.role') === 'user')
                        @php
                            $isSponsor = \App\Models\Sponsorship::where('user_id', session('user.id'))->where('status', 'completed')->exists();
                        @endphp
                        @if($isSponsor)
                            <form action="{{ route('adoptions.store', $tree) }}" method="POST" class="mb-3">
                                @csrf
                                <button type="submit" class="w-full bg-green-600 text-white px-4 py-3 rounded-lg font-bold hover:bg-green-700">🌱 Adopt This Tree</button>
                            </form>
                        @else
                            <button type="button" class="w-full bg-gray-400 text-white px-4 py-3 rounded-lg font-bold cursor-not-allowed" disabled>🌱 Adopt (Sponsor to unlock)</button>
                        @endif
                    @elseif(session('user'))
                        <button type="button" class="w-full bg-gray-400 text-white px-4 py-3 rounded-lg font-bold cursor-not-allowed" disabled>🌱 Adopt (Only regular accounts can adopt)</button>
                    @else
                        <a href="/login" class="block w-full bg-green-600 text-white px-4 py-3 rounded-lg font-bold hover:bg-green-700 text-center">🌱 Adopt This Tree</a>
                    @endif
                </div>
            @endif

            <!-- Sponsor Section -->
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Support This Tree</h3>
                <p class="text-gray-600 text-sm mb-4">Help ensure this tree thrives and continues to offset CO₂</p>
                @if(session('user'))
                    <a href="{{ route('sponsorships.create', $tree) }}" class="block w-full bg-blue-600 text-white px-4 py-3 rounded-lg font-bold hover:bg-blue-700 text-center">💳 Sponsor</a>
                @else
                    <a href="/login" class="block w-full bg-blue-600 text-white px-4 py-3 rounded-lg font-bold hover:bg-blue-700 text-center">💳 Sponsor</a>
                @endif
            </div>

            <!-- Map -->
            @if($tree->latitude && $tree->longitude)
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Location</h3>
                    <div id="map" style="height: 300px; border-radius: 0.5rem;"></div>
                    <p class="text-sm text-gray-600 mt-2">Lat: {{ $tree->latitude }}, Lng: {{ $tree->longitude }}</p>
                </div>
            @endif
        </div>
    </div>
</div>

@if($tree->latitude && $tree->longitude)
    @section('scripts')
        <script>
            const map = L.map('map').setView([{{ $tree->latitude }}, {{ $tree->longitude }}], 13);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors',
                maxZoom: 19,
            }).addTo(map);

            L.marker([{{ $tree->latitude }}, {{ $tree->longitude }}]).addTo(map)
                .bindPopup('<strong>{{ $tree->common_name ?? $tree->species }}</strong><br>{{ $tree->location }}');
        </script>
    @endsection
@endif
@endsection
