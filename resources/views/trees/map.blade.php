@extends('layouts.app')

@section('title', 'Tree Map - Project Lunhaw')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-4xl font-bold text-gray-900 mb-4">Tree Locations</h1>
    <p class="text-gray-600 mb-6">Explore all trees available for adoption on our interactive map</p>

    <div id="map" style="height: 600px; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);"></div>

    <!-- Legend -->
    <div class="bg-white rounded-lg shadow p-6 mt-6">
        <h2 class="text-lg font-bold text-gray-900 mb-4">Map Legend</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center text-white">🌳</div>
                <span class="text-gray-700">Available Tree</span>
            </div>
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center text-white">🌱</div>
                <span class="text-gray-700">Adopted Tree</span>
            </div>
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white">✓</div>
                <span class="text-gray-700">Mature Tree</span>
            </div>
        </div>
    </div>
</div>

@section('scripts')
    <script>
        const map = L.map('map').setView([14.5995, 120.9842], 11);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors',
            maxZoom: 19,
        }).addTo(map);

        // Load tree data from API
        fetch('/api/trees/map-data')
            .then(response => response.json())
            .then(trees => {
                trees.forEach(tree => {
                    if (tree.latitude && tree.longitude) {
                        let color = tree.status === 'mature' ? 'blue' : (tree.adoption ? 'yellow' : 'green');
                        let icon = tree.status === 'mature' ? '✓' : (tree.adoption ? '🌱' : '🌳');

                        const html = `
                            <div class="text-center">
                                <p class="font-bold">${tree.common_name || tree.species}</p>
                                <p class="text-sm text-gray-600">${tree.location}</p>
                                <p class="text-sm">CO₂: ${tree.co2_offset} kg</p>
                                <a href="/trees/${tree.id}" class="text-blue-600 hover:underline">View Details</a>
                            </div>
                        `;

                        const leafletIcon = L.icon({
                            html: `<div class="w-8 h-8 ${color === 'green' ? 'bg-green-500' : (color === 'yellow' ? 'bg-yellow-500' : 'bg-blue-500')} rounded-full flex items-center justify-center text-white text-lg">${icon}</div>`,
                            iconSize: [32, 32],
                            iconAnchor: [16, 16],
                            popupAnchor: [0, -16]
                        });

                        L.marker([tree.latitude, tree.longitude], { icon: leafletIcon })
                            .bindPopup(html)
                            .addTo(map);
                    }
                });
            })
            .catch(err => console.error('Error loading trees:', err));
    </script>
@endsection
@endsection
