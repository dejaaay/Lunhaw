<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login - Lunhaw</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="font-sans bg-neutral-50 text-neutral-900">
    <header class="border-b border-neutral-200 bg-white/70 backdrop-blur">
      <div class="container mx-auto px-4 py-4 flex items-center justify-between">
        <a href="/" class="flex items-center gap-2">
          <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-green-800 text-white">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z"/><path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"/></svg>
          </span>
          <span class="text-xl font-semibold">Lunhaw</span>
        </a>
      </div>
    </header>
    <main class="container mx-auto px-4 py-16">
      <div class="max-w-md mx-auto">
        <h1 class="text-2xl font-semibold text-center">User Login</h1>
        <form action="/login" method="post" class="mt-6 space-y-4 bg-white p-6 rounded-xl border">
          @csrf
          <div>
            <label class="block text-sm">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="mt-1 w-full border rounded-md px-3 py-2" required />
          </div>
          <div>
            <label class="block text-sm">Password</label>
            <input type="password" name="password" class="mt-1 w-full border rounded-md px-3 py-2" required />
          </div>
          @if ($errors->any())
            <p class="text-red-600 text-sm">{{ $errors->first() }}</p>
          @endif
          <button type="submit" class="w-full px-4 py-2 rounded-md bg-green-800 text-white">Login</button>
        </form>
        <p class="mt-4 text-center text-sm">Don't have an account? <a href="/register" class="text-green-800">Register</a></p>
        <p class="mt-1 text-center text-sm">Admin? <a href="/admin/login" class="text-green-800">Go to admin login</a></p>
      </div>
    </main>
  </body>
</html>
