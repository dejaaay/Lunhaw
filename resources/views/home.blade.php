<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Lunhaw - Adopt a Tree, Grow a Future</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
      @vite(['resources/css/app.css','resources/js/app.js'])
    @endif
  </head>
  <body class="font-sans bg-neutral-50 text-neutral-900">
    <header class="sticky top-0 z-50 border-b border-neutral-200 bg-white/70 backdrop-blur">
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
        <nav class="hidden md:flex items-center gap-6 text-sm text-neutral-700">
          <a href="/adopt-sponsor" class="hover:text-neutral-900">Adopt Trees</a>
          <a href="/adopt-sponsor" class="hover:text-neutral-900">Sponsor Projects</a>
          <a href="/track" class="hover:text-neutral-900">Track Impact</a>
          <a href="/insights" class="hover:text-neutral-900">View Reports</a>
          @if(session('admin') || session('user'))
            <span class="inline-flex items-center gap-2">
              <span class="text-neutral-600">{{ session('admin.email') ?? session('user.name') ?? session('user.email') }}</span>
              <a href="/logout" class="px-3 py-1 rounded-md border text-sm">Logout</a>
            </span>
          @else
            <a href="/login" class="hover:text-neutral-900">Login</a>
            <a href="/register" class="hover:text-neutral-900">Register</a>
            <a href="/admin/login" class="hover:text-neutral-900">Admin</a>
          @endif
        </nav>
        <div class="flex items-center gap-2">
          <a href="/adopt-sponsor" class="px-4 py-2 rounded-md bg-green-800 text-white text-sm">Sponsor Now</a>
          <a href="/login" class="px-4 py-2 rounded-md border border-neutral-300 text-sm">Login</a>
        </div>
      </div>
    </header>
    <main>
      <section class="bg-gradient-to-b from-green-50 to-white">
        <div class="container mx-auto px-4 py-16">
          <div class="max-w-3xl mx-auto text-center">
            <p class="text-green-700 font-medium">Supporting UN Sustainable Development Goals</p>
            <h1 class="mt-2 text-4xl md:text-5xl font-bold leading-tight">Adopt a Tree, Grow a Future</h1>
            <p class="mt-4 text-neutral-700">Join thousands of environmental champions in creating a greener tomorrow. Sponsor tree planting, track your impact, and help combat climate change one tree at a time.</p>
            <div class="mt-6 flex items-center justify-center gap-3">
              <a href="/adopt-sponsor" class="px-5 py-2.5 rounded-md bg-green-800 text-white text-sm">Adopt a Tree</a>
              <a href="/track" class="px-5 py-2.5 rounded-md border border-neutral-300 text-sm">View Impact</a>
            </div>
            <div class="mt-8 grid grid-cols-1 sm:grid-cols-3 gap-8">
              <div class="rounded-[10px] bg-[#F7FCF5] border border-[#cce7c9] p-6 text-center text-green-800">
                <div class="text-2xl font-bold text-green-900">111111</div>
                <div class="text-xs">Trees Planted</div>
              </div>
              <div class="rounded-[10px] bg-[#F7FCF5] border border-[#cce7c9] p-6 text-center text-green-800">
                <div class="text-2xl font-bold text-green-900">2222222</div>
                <div class="text-xs">Tons CO₂ Offset</div>
              </div>
              <div class="rounded-[10px] bg-[#F7FCF5] border border-[#cce7c9] p-6 text-center text-green-800">
                <div class="text-2xl font-bold text-green-900">3333333</div>
                <div class="text-xs">Active Sponsors</div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section id="about" class="container mx-auto px-4 py-16 bg-white">
        <div class="max-w-4xl mx-auto text-center">
          <h2 class="text-3xl font-semibold">How Lunhaw Works</h2>
          <p class="mt-2 text-neutral-700">Simple steps to make a lasting environmental impact.</p>
        </div>
        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6 max-w-3xl mx-auto justify-items-center">
          <a href="/choose" class="w-[240px] rounded-[10px] bg-[#F7FCF5] border border-[#cce7c9] p-5 text-green-800 text-center block">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mx-auto mb-3">
              <path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z"/>
              <path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"/>
            </svg>
            <div class="text-lg font-semibold text-green-1000">Choose a tree</div>
            <p class="mt-2 text-sm">Select reforestation initiatives aligned with your values.</p>
          </a>
          <a href="/adopt-sponsor" class="w-[240px] rounded-[10px] bg-[#F7FCF5] border border-[#cce7c9] p-5 text-green-800 text-center block">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mx-auto mb-3">
              <path d="M20.8 8.6a5 5 0 0 0-7.1 0L12 10.3 10.3 8.6a5 5 0 1 0-7.1 7.1L12 22l8.8-6.3a5 5 0 0 0 0-7.1z"></path>
            </svg>
            <div class="text-lg font-semibold text-green-900">Adopt or sponsor</div>
            <p class="mt-2 text-sm">Fund tree planting and support local communities.</p>
          </a>
          <a href="/track" class="w-[240px] rounded-[10px] bg-[#F7FCF5] border border-[#cce7c9] p-5 text-green-800 text-center block">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mx-auto mb-3">
              <rect x="4" y="10" width="4" height="8" rx="1"></rect>
              <rect x="10" y="6" width="4" height="12" rx="1"></rect>
              <rect x="16" y="12" width="4" height="6" rx="1"></rect>
            </svg>
            <div class="text-lg font-semibold text-green-900">Track your impact</div>
            <p class="mt-2 text-sm">See growth, CO₂ offsets, and verified reports.</p>
          </a>
        </div>
      </section>
      <section class="bg-white">
        <div class="container mx-auto px-4 py-16">
          <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl font-semibold">Why Choose Lunhaw?</h2>
            <p class="mt-2 text-neutral-700">Transparent, impactful, and rewarding tree adoption platform.</p>
          </div>
          <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6 max-w-3xl mx-auto justify-items-center">
            <a href="/partners" class="w-[240px] rounded-[10px] bg-[#F7FCF5] border border-[#cce7c9] p-5 text-green-800 text-center block">
              <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mx-auto mb-3">
                <path d="M12 2l7 4v6c0 5-3.5 9-7 10-3.5-1-7-5-7-10V6l7-4z"></path>
                <path d="M9 12l2 2 4-4"></path>
              </svg>
              <div class="text-lg font-semibold text-green-900">Verified partners</div>
              <p class="mt-2 text-sm">Work with NGOs and LGUs for credible projects.</p>
            </a>
            <a href="/insights" class="w-[240px] rounded-[10px] bg-[#F7FCF5] border border-[#cce7c9] p-5 text-green-800 text-center block">
              <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mx-auto mb-3">
                <rect x="4" y="10" width="4" height="8" rx="1"></rect>
                <rect x="10" y="6" width="4" height="12" rx="1"></rect>
                <rect x="16" y="12" width="4" height="6" rx="1"></rect>
              </svg>
              <div class="text-lg font-semibold text-green-900">Real-time insights</div>
              <p class="mt-2 text-sm">Monitor trees planted and carbon offset over time.</p>
            </a>
            <a href="/rewards" class="w-[240px] rounded-[10px] bg-[#F7FCF5] border border-[#cce7c9] p-5 text-green-800 text-center block">
              <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mx-auto mb-3">
                <rect x="3" y="10" width="18" height="10" rx="2"></rect>
                <path d="M12 10v10"></path>
                <rect x="3" y="7" width="18" height="3"></rect>
                <path d="M9 7c-1.7 0-3-1.3-3-3s1.3-3 3-3c3 0 3 6 3 6"></path>
                <path d="M15 7c1.7 0 3-1.3 3-3s-1.3-3-3-3c-3 0-3 6-3 6"></path>
              </svg>
              <div class="text-lg font-semibold text-green-900">Community rewards</div>
              <p class="mt-2 text-sm">Celebrate milestones and share achievements.</p>
            </a>
          </div>
        </div>
      </section>
      <section class="container mx-auto px-4 py-16">
        <div class="rounded-xl bg-green-800 text-white p-10 flex items-center justify-between gap-6">
          <div>
            <h3 class="text-2xl font-semibold">Ready to Make a Difference?</h3>
            <p class="mt-2 opacity-90">Join thousands of environmental champions and start your tree adoption journey today.</p>
          </div>
          <a href="/adopt-sponsor" class="px-5 py-2.5 rounded-md bg-white text-green-900 text-sm font-medium">Start Now</a>
        </div>
      </section>
    </main>
    <footer class="border-t border-neutral-200 bg-white">
      <div class="container mx-auto px-4 py-12">
        <div class="grid md:grid-cols-4 gap-8">
          <div class="space-y-3">
            <div class="flex items-center gap-2">
              <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-green-600 text-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z"/>
                  <path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"/>
                </svg>
              </span>
              <span class="text-xl font-semibold">Lunhaw</span>
            </div>
            <p class="text-sm text-neutral-700">Empowering communities to combat climate change through sustainable tree adoption and sponsorship.</p>
          </div>
          <div>
            <h4 class="font-semibold mb-3">Platform</h4>
            <ul class="space-y-2 text-sm text-neutral-700">
              <li><a href="#adopt" class="hover:text-neutral-900">Adopt Trees</a></li>
              <li><a href="#sponsor" class="hover:text-neutral-900">Sponsor Projects</a></li>
              <li><a href="#impact" class="hover:text-neutral-900">Track Impact</a></li>
              <li><a href="#reports" class="hover:text-neutral-900">View Reports</a></li>
            </ul>
          </div>
          <div>
            <h4 class="font-semibold mb-3">Community</h4>
            <ul class="space-y-2 text-sm text-neutral-700">
              <li><a href="#" class="hover:text-neutral-900">For NGOs</a></li>
              <li><a href="#" class="hover:text-neutral-900">For LGUs</a></li>
              <li><a href="#" class="hover:text-neutral-900">For Institutions</a></li>
              <li><a href="#" class="hover:text-neutral-900">Partners</a></li>
            </ul>
          </div>
          <div>
            <h4 class="font-semibold mb-3">Support</h4>
            <ul class="space-y-2 text-sm text-neutral-700">
              <li><a href="#" class="hover:text-neutral-900">Help Center</a></li>
              <li><a href="#" class="hover:text-neutral-900">Contact Us</a></li>
              <li><a href="#" class="hover:text-neutral-900">Privacy Policy</a></li>
              <li><a href="#" class="hover:text-neutral-900">Terms of Service</a></li>
            </ul>
          </div>
        </div>
        <div class="border-t border-neutral-200 mt-8 pt-8 text-center text-sm text-neutral-700">
          <p>© 2025 Lunhaw. All rights reserved. Made with 💚 for our mother nature.</p>
        </div>
      </div>
    </footer>
  </body>
</html>
