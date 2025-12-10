<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Project Lunhaw')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css">
    @yield('styles')
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    @include('components.navbar')

    <!-- Flash Messages -->
    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded max-w-7xl mx-auto mt-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded max-w-7xl mx-auto mt-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded max-w-7xl mx-auto mt-4">
            {{ session('error') }}
        </div>
    @endif

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-lg font-bold mb-4">Project Lunhaw</h3>
                    <p class="text-gray-400">Adopt a Tree, Grow a Future</p>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="/trees" class="hover:text-white">Browse Trees</a></li>
                        <li><a href="/trees/map" class="hover:text-white">Map</a></li>
                        <li><a href="/partners" class="hover:text-white">Partners</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Contact</h4>
                    <p class="text-gray-400">Email: info@lunhaw.org</p>
                    <p class="text-gray-400">Phone: +63 (0) 2 1234 5678</p>
                </div>
            </div>
            <hr class="border-gray-700 my-8">
            <p class="text-center text-gray-400">&copy; 2025 Project Lunhaw. All rights reserved.</p>
        </div>
    </footer>

    @yield('scripts')
</body>
</html>

<script>
// Global confirmation handler: only trigger for
// - forms with `data-confirm` on submit
// - anchors or buttons that themselves have `data-confirm` on click
document.addEventListener('click', function(e) {
    const el = e.target.closest('a[data-confirm], button[data-confirm], input[type="submit"][data-confirm]');
    if (!el) return;
    const msg = el.getAttribute('data-confirm') || 'Are you sure?';
    if (!confirm(msg)) {
        e.preventDefault();
        e.stopPropagation();
    }
});

document.addEventListener('submit', function(e) {
    const form = e.target;
    if (!(form instanceof HTMLFormElement)) return;
    const msg = form.getAttribute('data-confirm');
    if (msg) {
        if (!confirm(msg)) {
            e.preventDefault();
        }
    }
});
</script>
