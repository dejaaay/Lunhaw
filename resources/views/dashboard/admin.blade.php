<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Dashboard - Lunhaw</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="font-sans bg-neutral-50 text-neutral-900">
    @include('components.navbar')
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
