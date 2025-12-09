<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Real-time Insights - Lunhaw</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="font-sans bg-neutral-50 text-neutral-900">
    @include('components.navbar')
    <main class="container mx-auto px-4 py-16">
      <div class="max-w-3xl mx-auto text-center mb-10">
        <h1 class="text-4xl font-bold">My Adopted Trees</h1>
        <p class="mt-3 text-neutral-700">See the status and updates for trees you have adopted.</p>
      </div>
      <div class="max-w-5xl mx-auto">
        @if($adoptions->isEmpty())
          <div class="text-center text-neutral-500">You have not adopted any trees yet.</div>
        @else
        <div class="overflow-x-auto">
          <table class="min-w-full bg-white shadow rounded-lg">
            <thead>
              <tr class="bg-green-100 text-green-900">
                <th class="py-3 px-4 text-left">Species</th>
                <th class="py-3 px-4 text-left">Location</th>
                <th class="py-3 px-4 text-left">Adopted At</th>
                <th class="py-3 px-4 text-left">Status</th>
                <th class="py-3 px-4 text-left">Latest Photo</th>
                <th class="py-3 px-4 text-left">Growth Notes</th>
              </tr>
            </thead>
            <tbody>
              @foreach($adoptions as $adoption)
                <tr class="border-b hover:bg-green-50">
                  <td class="py-2 px-4">{{ $adoption->tree->common_name ?? $adoption->tree->species ?? 'N/A' }}</td>
                  <td class="py-2 px-4">{{ $adoption->tree->location ?? 'N/A' }}</td>
                  <td class="py-2 px-4">{{ $adoption->adopted_at ? $adoption->adopted_at->format('Y-m-d') : 'N/A' }}</td>
                  <td class="py-2 px-4">
                    <span class="inline-block px-2 py-1 rounded text-xs {{ $adoption->status === 'active' ? 'bg-green-200 text-green-800' : 'bg-gray-200 text-gray-700' }}">
                      {{ ucfirst($adoption->status) }}
                    </span>
                  </td>
                  <td class="py-2 px-4">
                    @if($adoption->tree->latestPhoto)
                      <img src="{{ asset('storage/' . $adoption->tree->latestPhoto->photo_path) }}" alt="Tree Photo" class="h-16 w-16 object-cover rounded shadow">
                    @else
                      <span class="text-neutral-400">No photo</span>
                    @endif
                  </td>
                  <td class="py-2 px-4">
                    @if($adoption->tree->latestPhoto && $adoption->tree->latestPhoto->growth_notes)
                      <span>{{ $adoption->tree->latestPhoto->growth_notes }}</span>
                    @else
                      <span class="text-neutral-400">No notes</span>
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        @endif
      </div>
    </main>
  </body>
</html>
