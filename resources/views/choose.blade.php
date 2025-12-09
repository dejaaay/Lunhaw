@extends('layouts.app')

@section('title', 'How It Works - Project Lunhaw')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
  <h1 class="text-4xl font-bold text-center text-green-900 mb-10">How It Works</h1>
  <div class="overflow-x-auto pb-4">
    <div class="flex gap-8 min-w-[900px]">
      <!-- Step 1 -->
      <div class="bg-white rounded-2xl shadow-lg p-8 flex flex-col items-center min-w-[320px] max-w-xs">
        <div class="w-16 h-16 flex items-center justify-center rounded-full bg-green-100 mb-4">
          <span class="text-3xl">🌱</span>
        </div>
        <h2 class="text-xl font-semibold mb-2 text-green-800">1. Browse Trees</h2>
        <p class="text-gray-600 text-center">Explore a wide variety of tree species and projects. Use filters to find trees by species, location, or partner organization.</p>
      </div>
      <!-- Step 2 -->
      <div class="bg-white rounded-2xl shadow-lg p-8 flex flex-col items-center min-w-[320px] max-w-xs">
        <div class="w-16 h-16 flex items-center justify-center rounded-full bg-green-100 mb-4">
          <span class="text-3xl">🔍</span>
        </div>
        <h2 class="text-xl font-semibold mb-2 text-green-800">2. Learn & Decide</h2>
        <p class="text-gray-600 text-center">Read about each tree’s impact, growth, and the communities they support. Decide which tree or project you want to support.</p>
      </div>
      <!-- Step 3 -->
      <div class="bg-white rounded-2xl shadow-lg p-8 flex flex-col items-center min-w-[320px] max-w-xs">
        <div class="w-16 h-16 flex items-center justify-center rounded-full bg-green-100 mb-4">
          <span class="text-3xl">🤝</span>
        </div>
        <h2 class="text-xl font-semibold mb-2 text-green-800">3. Adopt or Sponsor</h2>
        <p class="text-gray-600 text-center">Adopt a tree for yourself or sponsor a tree for a community. Your contribution funds planting, care, and monitoring.</p>
      </div>
      <!-- Step 4 -->
      <div class="bg-white rounded-2xl shadow-lg p-8 flex flex-col items-center min-w-[320px] max-w-xs">
        <div class="w-16 h-16 flex items-center justify-center rounded-full bg-green-100 mb-4">
          <span class="text-3xl">�</span>
        </div>
        <h2 class="text-xl font-semibold mb-2 text-green-800">4. Secure Payment</h2>
        <p class="text-gray-600 text-center">Complete your adoption or sponsorship with our secure payment process. Receive a digital certificate and updates.</p>
      </div>
      <!-- Step 5 -->
      <div class="bg-white rounded-2xl shadow-lg p-8 flex flex-col items-center min-w-[320px] max-w-xs">
        <div class="w-16 h-16 flex items-center justify-center rounded-full bg-green-100 mb-4">
          <span class="text-3xl">📸</span>
        </div>
        <h2 class="text-xl font-semibold mb-2 text-green-800">5. Get Updates</h2>
        <p class="text-gray-600 text-center">Receive regular updates, photos, and growth reports about your tree. See the real-world impact of your support.</p>
      </div>
      <!-- Step 6 -->
      <div class="bg-white rounded-2xl shadow-lg p-8 flex flex-col items-center min-w-[320px] max-w-xs">
        <div class="w-16 h-16 flex items-center justify-center rounded-full bg-green-100 mb-4">
          <span class="text-3xl">📈</span>
        </div>
        <h2 class="text-xl font-semibold mb-2 text-green-800">6. Track & Celebrate</h2>
        <p class="text-gray-600 text-center">Track your tree’s growth and environmental benefits over time. Share your impact and inspire others to join!</p>
      </div>
    </div>
  </div>
</div>
@endsection
