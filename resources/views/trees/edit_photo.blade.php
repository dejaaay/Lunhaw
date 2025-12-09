@extends('layouts.app')

@section('title', 'Edit Tree Photo - Project Lunhaw')

@section('content')
<div class="max-w-lg mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Edit Tree Photo</h1>
    <form action="{{ route('trees.photos.update', [$tree, $photo]) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow p-6 space-y-6">
        @csrf
        @method('POST')
        <div class="mb-6 text-center">
            @if($photo->photo_path)
                <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="Tree Photo" class="h-48 w-48 rounded-lg mx-auto mb-2 object-cover">
            @else
                <span class="inline-block h-48 w-48 rounded-lg bg-gray-200 mx-auto mb-2"></span>
            @endif
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Upload New Photo</label>
            <input type="file" name="photo" accept="image/*" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Caption</label>
            <input type="text" name="caption" value="{{ old('caption', $photo->caption) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Growth Notes</label>
            <textarea name="growth_notes" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('growth_notes', $photo->growth_notes) }}</textarea>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Growth Status</label>
            <input type="text" name="growth_status" value="{{ old('growth_status', $photo->growth_status) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>
        <button type="submit" class="w-full bg-green-700 text-white py-2 rounded-md hover:bg-green-800">Update Photo</button>
    </form>
</div>
@endsection
