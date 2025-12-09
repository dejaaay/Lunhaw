<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Organization Insights - Lunhaw</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="font-sans bg-neutral-50 text-neutral-900">
    @include('components.navbar')
    <main class="container mx-auto px-4 py-16">
      <div class="max-w-3xl mx-auto text-center mb-10">
        <h1 class="text-4xl font-bold">Organization Tree Adoption Insights</h1>
        <p class="mt-3 text-neutral-700">See how many of your trees have been adopted.</p>
      </div>
      <div class="max-w-xl mx-auto bg-white rounded-lg shadow p-8">
        <canvas id="adoptionChart" width="400" height="300"></canvas>
        <div class="mt-8 text-center">
          <p class="text-lg">Total Trees: <span class="font-bold">{{ $total }}</span></p>
          <p class="text-lg">Adopted Trees: <span class="font-bold text-green-700">{{ $adopted }}</span></p>
        </div>
      </div>
    </main>
    <script>
      const ctx = document.getElementById('adoptionChart').getContext('2d');
      new Chart(ctx, {
        type: 'doughnut',
        data: {
          labels: ['Adopted', 'Not Adopted'],
          datasets: [{
            data: [{{ $adopted }}, {{ $total - $adopted }}],
            backgroundColor: ['#22c55e', '#e5e7eb'],
            borderWidth: 2
          }]
        },
        options: {
          plugins: {
            legend: { position: 'bottom' }
          }
        }
      });
    </script>
  </body>
</html>
