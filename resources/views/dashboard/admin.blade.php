<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Dashboard - Lunhaw</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="font-sans bg-neutral-50 text-neutral-900">
    <header class="sticky top-0 z-50 border-b border-neutral-200 bg-white/70 backdrop-blur">
      <div class="container mx-auto px-4 py-4 flex items-center justify-between">
        <a href="/" class="flex items-center gap-2">
          <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-green-800 text-white">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z"/><path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"/></svg>
          </span>
          <span class="text-xl font-semibold">Lunhaw</span>
        </a>
        <nav class="hidden md:flex items-center gap-6 text-sm text-neutral-700">
          <a href="/adopt-sponsor" class="hover:text-neutral-900">Adopt Trees</a>
          <a href="/adopt-sponsor" class="hover:text-neutral-900">Sponsor Projects</a>
          <a href="/track" class="hover:text-neutral-900">Track Impact</a>
          <a href="/insights" class="hover:text-neutral-900">View Reports</a>
          <a href="/admin" class="hover:text-neutral-900">Admin</a>
          <span class="inline-flex items-center gap-2">
            <span class="text-neutral-600">{{ $admin['email'] }}</span>
            <a href="/logout" class="px-3 py-1 rounded-md border text-sm bg-green-800 text-white    ">Logout</a>
          </span>
        </nav>
      </div>
    </header>
    <main>
      <section class="container mx-auto px-4 py-12">
        <h1 class="text-3xl font-semibold">Admin Dashboard</h1>
        <p class="mt-2 text-neutral-700">Platform overview and metrics.</p>

        <div class="mt-8 grid grid-cols-1 sm:grid-cols-3 gap-6">
          <div class="rounded-[10px] bg-[#F7FCF5] border border-[#cce7c9] p-6 text-center text-green-800">
            <div class="text-2xl font-bold text-green-900">{{ $usersCount }}</div>
            <div class="text-xs">Total Users</div>
          </div>
          <div class="rounded-[10px] bg-[#F7FCF5] border border-[#cce7c9] p-6 text-center text-green-800">
            <div class="text-2xl font-bold text-green-900">{{ $treesCount }}</div>
            <div class="text-xs">Trees Planted</div>
          </div>
          <div class="rounded-[10px] bg-[#F7FCF5] border border-[#cce7c9] p-6 text-center text-green-800">
            <div class="text-2xl font-bold text-green-900">{{ $sponsorshipsCount }}</div>
            <div class="text-xs">Active Sponsorships</div>
          </div>
        </div>
      </section>
    </main>
  </body>
  </html>
