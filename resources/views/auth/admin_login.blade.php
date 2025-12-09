<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Login - Lunhaw</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="font-sans bg-neutral-50 text-neutral-900">
    @include('components.navbar')
    <main class="container mx-auto px-4 py-16">
      <div class="max-w-md mx-auto">
        <h1 class="text-2xl font-semibold text-center">Admin Login</h1>
        <form action="/admin/login" method="post" class="mt-6 space-y-4 bg-white p-6 rounded-xl border">
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
        <p class="mt-4 text-center text-sm">User? <a href="/login" class="text-green-800">Go to user login</a></p>
      </div>
    </main>
  </body>
</html>
