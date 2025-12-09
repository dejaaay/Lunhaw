<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>User Dashboard - Lunhaw</title>
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
          <a href="/dashboard" class="hover:text-neutral-900">Dashboard</a>
          <span class="inline-flex items-center gap-2">
            <span class="text-neutral-600">{{ $user['name'] ?? $user['email'] }}</span>
            <a href="/logout" class="px-3 py-1 rounded-md border text-sm bg-green-800 text-white">Logout</a>
          </span>
        </nav>
      </div>
    </header>
    <main>
      <section class="container mx-auto px-4 py-12">
        <h1 class="text-3xl font-semibold">Welcome, {{ $user['name'] ?? $user['email'] }}</h1>
        <p class="mt-2 text-neutral-700">Here are your planted trees and sponsorships.</p>

        <div class="mt-8 grid md:grid-cols-2 gap-8">
          <div>
            <h2 class="text-xl font-semibold">Your Planted Trees</h2>
            <div class="mt-4 grid grid-cols-1 gap-4">
              @forelse($planted as $t)
                <div class="rounded-[10px] bg-[#F7FCF5] border border-[#cce7c9] p-5 text-green-800">
                  <div class="font-semibold text-green-900">{{ $t->species }}</div>
                  <div class="text-sm">{{ $t->location ?? 'Unknown location' }}</div>
                  <div class="text-xs mt-1">Planted: {{ $t->planted_at ?? 'N/A' }}</div>
                </div>
              @empty
                <p class="text-sm text-neutral-700">No planted trees yet.</p>
              @endforelse
            </div>
          </div>
          <div>
            <h2 class="text-xl font-semibold">Your Sponsorships</h2>
            <div class="mt-4 grid grid-cols-1 gap-4">
              @forelse($sponsorships as $s)
                <div class="rounded-[10px] bg-[#F7FCF5] border border-[#cce7c9] p-5 text-green-800">
                  <div class="font-semibold text-green-900">{{ $s->species ?? 'Sponsored Tree' }}</div>
                  <div class="text-sm">{{ $s->location ?? 'Unknown location' }}</div>
                  <div class="text-xs mt-1">Amount: {{ $s->amount ? '₱'.number_format($s->amount,2) : 'N/A' }}</div>
                </div>
              @empty
                <p class="text-sm text-neutral-700">No sponsorships yet.</p>
              @endforelse
            </div>
          </div>
        </div>
      </section>
    </main>
  </body>
  </html>
