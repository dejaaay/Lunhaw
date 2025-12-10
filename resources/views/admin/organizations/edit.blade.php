@extends('layouts.app')

@section('title', 'Edit Organization - Project Lunhaw')

@section('content')
<div class="max-w-lg mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Edit Organization / Partner</h1>
    <form action="{{ route('admin.organizations.update', $user) }}" method="POST" class="bg-white rounded-lg shadow p-6 space-y-6" data-confirm="Are you sure you want to edit this org?">
        @csrf
        @method('PUT')
        <input type="hidden" name="confirm" value="1">
        <div>
            <label class="block text-sm font-medium text-gray-700">Organization Name</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            @error('email') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Password (leave blank to keep current)</label>
            <input type="password" name="password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            <p class="text-xs text-gray-500 mt-1">Password must be at least 6 characters if changing.</p>
            @error('password') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Bio (optional)</label>
            <textarea name="bio" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('bio', $user->bio) }}</textarea>
            @error('bio') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>
        <button type="submit" class="w-full bg-green-700 text-white py-2 rounded-md hover:bg-green-800">Save Changes</button>
    </form>
</div>
@endsection
