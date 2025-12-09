<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>User Dashboard - Lunhaw</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="font-sans bg-neutral-50 text-neutral-900">
    @include('components.navbar')
    <main>
      <section class="container mx-auto px-4 py-12">
        <h1 class="text-3xl font-semibold">Welcome, {{ $user['name'] ?? $user['email'] }}</h1>
        <p class="mt-2 text-neutral-700">Here's your environmental impact at a glance.</p>

        <div class="mt-8 grid md:grid-cols-3 gap-6">
          <div class="rounded-[10px] bg-[#F7FCF5] border border-[#cce7c9] p-6 text-center">
            <div class="text-3xl font-bold text-green-900">{{ $planted->count() }}</div>
            <div class="text-sm text-green-800 mt-1">Trees Adopted</div>
          </div>
          <div class="rounded-[10px] bg-[#F7FCF5] border border-[#cce7c9] p-6 text-center">
            <div class="text-3xl font-bold text-green-900">{{ $sponsorships->count() }}</div>
            <div class="text-sm text-green-800 mt-1">Active Sponsorships</div>
          </div>
          <div class="rounded-[10px] bg-[#F7FCF5] border border-[#cce7c9] p-6 text-center">
            <div class="text-3xl font-bold text-green-900">₱{{ number_format($sponsorships->sum('amount'), 2) }}</div>
            <div class="text-sm text-green-800 mt-1">Total Sponsored</div>
          </div>
        </div>

        <div class="mt-8 grid md:grid-cols-2 gap-8">
          <div>
            <h2 class="text-xl font-semibold mb-4">Your Adopted Trees</h2>
            <div class="space-y-4">
              @forelse($planted as $t)
                <div class="rounded-[10px] bg-white border border-neutral-200 p-5">
                  <div class="font-semibold text-green-900">{{ $t->common_name ?? $t->species }}</div>
                  <div class="text-sm text-neutral-600">{{ $t->location ?? 'Unknown location' }}</div>
                  <div class="text-xs text-neutral-500 mt-1">Status: {{ ucfirst($t->status) }} | CO₂: {{ $t->co2_offset }}kg</div>
                  <a href="{{ route('trees.show', $t) }}" class="text-green-700 text-sm hover:underline mt-2 inline-block">View details →</a>
                </div>
              @empty
                <p class="text-sm text-neutral-700">No adopted trees yet. <a href="/trees" class="text-green-700 hover:underline">Browse available trees</a></p>
              @endforelse
            </div>
          </div>
          <div>
            <h2 class="text-xl font-semibold mb-4">Your Sponsorships</h2>
            <div class="space-y-4">
              @forelse($sponsorships as $s)
                <div class="rounded-[10px] bg-white border border-neutral-200 p-5">
                  <div class="font-semibold text-green-900">{{ $s->common_name ?? $s->species ?? 'Tree Sponsorship' }}</div>
                  <div class="text-sm text-neutral-600">{{ $s->location ?? 'Unknown location' }}</div>
                  <div class="flex justify-between items-center mt-2">
                    <span class="text-xs text-neutral-500">Amount: ₱{{ number_format($s->amount, 2) }}</span>
                    <span class="text-xs px-2 py-1 rounded {{ $s->status === 'completed' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">{{ ucfirst($s->status) }}</span>
                  </div>
                  <a href="/trees/{{ $s->tree_id }}" class="text-green-700 text-sm hover:underline mt-2 inline-block">View tree →</a>
                </div>
              @empty
                <p class="text-sm text-neutral-700">No sponsorships yet. <a href="/trees" class="text-green-700 hover:underline">Browse and sponsor trees</a></p>
              @endforelse
            </div>
          </div>
        </div>
      </section>
    </main>
  </body>
</html>
