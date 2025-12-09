@extends('layouts.app')

@section('title', 'Tree Map - Project Lunhaw')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-4xl font-bold text-gray-900 mb-4">Tree Map</h1>
    <div id="map" style="height: 600px; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);"></div>
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
                        L.marker([tree.latitude, tree.longitude])
                            .bindPopup(`<div><strong>${tree.common_name || tree.species}</strong><br>${tree.location || ''}</div>`)
                            .addTo(map);
                    }
                });
            })
            .catch(err => console.error('Error loading trees:', err));
    </script>
@endsection
