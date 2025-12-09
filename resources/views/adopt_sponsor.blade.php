<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Adopt or Sponsor - Lunhaw</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="font-sans bg-neutral-50 text-neutral-900">
    @include('components.navbar')
    <main class="container mx-auto px-4 py-16">
      <div class="max-w-3xl mx-auto text-center">
        <h1 class="text-4xl font-bold">Adopt or Sponsor</h1>
        <p class="mt-3 text-neutral-700">Fund tree planting directly or sponsor larger community reforestation efforts.</p>
        <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-4">
          <a href="/trees" class="px-6 py-3 rounded-md bg-green-800 text-white font-medium hover:bg-green-900">Browse Available Trees</a>
          <a href="/trees/map" class="px-6 py-3 rounded-md border border-neutral-300 font-medium hover:bg-neutral-50">View on Map</a>
        </div>
      </div>
    </main>
  </body>
</html>
