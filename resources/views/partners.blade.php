<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Verified Partners - Lunhaw</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="font-sans bg-neutral-50 text-neutral-900">
    @include('components.navbar')
    <main class="container mx-auto px-4 py-16">
      <div class="max-w-3xl mx-auto text-center mb-10">
        <h1 class="text-4xl font-bold">Verified Partners</h1>
        <p class="mt-3 text-neutral-700">Meet the NGOs and LGUs we collaborate with for credible, impactful projects.</p>
      </div>
      <div class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">
        @forelse($partners as $partner)
          <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center">
            @if($partner->profile_photo_path)
              <img src="{{ asset('images/' . $partner->profile_photo_path) }}" alt="{{ $partner->name }} Logo" class="w-20 h-20 object-contain rounded-full mb-4 bg-white border" />
            @else
              <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center text-3xl mb-4">
                <span>🌱</span>
              </div>
            @endif
            <h2 class="text-xl font-semibold">{{ $partner->name }}</h2>
            <p class="text-neutral-600 text-sm mt-1">{{ $partner->email }}</p>
            @if($partner->bio)
              <p class="mt-2 text-neutral-700">{{ $partner->bio }}</p>
            @endif
          </div>
        @empty
          <div class="col-span-full text-center text-neutral-500">No partners found.</div>
        @endforelse
      </div>
    </main>
  </body>
</html>
