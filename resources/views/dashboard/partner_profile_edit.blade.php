@extends('layouts.app')

@section('title', 'Edit Organization Profile - Project Lunhaw')

@section('content')
<div class="max-w-lg mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Change Profile Picture</h1>
    <form action="{{ route('partner.profile.update') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow p-6 space-y-6">
        @csrf
        @method('POST')
        <div class="mb-6 text-center">
            @if($user->profile_photo_path)
                <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="Profile Photo" class="h-24 w-24 rounded-full mx-auto mb-2 object-cover">
            @else
                <span class="inline-block h-24 w-24 rounded-full bg-gray-200 mx-auto mb-2"></span>
            @endif
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Upload New Photo</label>
            <input type="file" name="profile_photo" accept="image/*" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
        </div>
        <button type="submit" class="w-full bg-green-700 text-white py-2 rounded-md hover:bg-green-800">Update Photo</button>
    </form>
</div>
@endsection
