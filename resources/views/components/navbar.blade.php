<nav class="sticky top-0 z-50 border-b border-neutral-200 bg-white/70 backdrop-blur">
  <div class="container mx-auto px-4 py-4 flex items-center justify-between">
    <a href="/" class="flex items-center gap-2">
      <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-green-800 text-white">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z"/>
          <path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"/>
        </svg>
      </span>
      <span class="text-xl font-semibold">Lunhaw</span>
    </a>

    <!-- Admin Navigation -->
    @if(session('admin'))
      <div class="hidden md:flex items-center gap-6 text-sm text-neutral-700">
        <a href="/admin" class="hover:text-neutral-900">Dashboard</a>
        <a href="/trees" class="hover:text-neutral-900">All Trees</a>
        <a href="/admin/sponsorships" class="hover:text-neutral-900">Sponsorships</a>
        <a href="/insights" class="hover:text-neutral-900">Reports</a>
      </div>

      <div class="flex items-center gap-2">
        <span class="hidden md:inline text-neutral-600 text-sm">{{ session('admin.name') ?? session('admin.email') }}</span>
        <a href="/admin" class="px-3 py-2 rounded-md bg-red-800 text-white text-sm hover:bg-red-900">Admin</a>
        <a href="/logout" class="px-3 py-2 rounded-md border border-neutral-300 text-sm hover:bg-neutral-50">Logout</a>
      </div>

    <!-- User Navigation -->
    @elseif(session('user'))
      <div class="hidden md:flex items-center gap-6 text-sm text-neutral-700">
        <a href="/trees" class="hover:text-neutral-900">Browse Trees</a>
        <a href="/trees/map" class="hover:text-neutral-900">Map</a>
        <a href="/choose" class="hover:text-neutral-900">How It Works</a>
        <a href="/partners" class="hover:text-neutral-900">Partners</a>
        <a href="/insights" class="hover:text-neutral-900">Reports</a>
      </div>

      <div class="flex items-center gap-2">
        <span class="hidden md:inline text-neutral-600 text-sm">{{ session('user.name') ?? session('user.email') }}</span>
        <a href="/my-adoptions" class="px-3 py-2 rounded-md border border-neutral-300 text-sm hover:bg-neutral-50">My Trees</a>
        <a href="/dashboard" class="px-3 py-2 rounded-md bg-green-800 text-white text-sm hover:bg-green-900">Dashboard</a>
        <a href="/logout" class="px-3 py-2 rounded-md border border-neutral-300 text-sm hover:bg-neutral-50">Logout</a>
      </div>

    <!-- Guest Navigation -->
    @else
      <div class="hidden md:flex items-center gap-6 text-sm text-neutral-700">
        <a href="/trees" class="hover:text-neutral-900">Browse Trees</a>
        <a href="/trees/map" class="hover:text-neutral-900">Map</a>
        <a href="/choose" class="hover:text-neutral-900">How It Works</a>
        <a href="/partners" class="hover:text-neutral-900">Partners</a>
        <a href="/insights" class="hover:text-neutral-900">Reports</a>
      </div>

      <div class="flex items-center gap-2">
        <a href="/login" class="px-3 py-2 rounded-md border border-neutral-300 text-sm hover:bg-neutral-50">Login</a>
        <a href="/register" class="px-3 py-2 rounded-md bg-green-800 text-white text-sm hover:bg-green-900">Register</a>
      </div>
    @endif
  </div>
</nav>
