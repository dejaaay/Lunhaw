@extends('layouts.app')

@section('title', 'Add Tree - Project Lunhaw')

@section('content')
<div class="max-w-lg mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Add New Tree</h1>
    <form action="{{ route('partner.trees.store') }}" method="POST" class="bg-white rounded-lg shadow p-6 space-y-6">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700">Species</label>
            <select name="species" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                <option value="">Select species</option>
                <option value="Mango">Mango</option>
                <option value="Calamansi">Calamansi</option>
                <option value="Narra">Narra</option>
                <option value="Acacia">Acacia</option>
                <option value="Mahogany">Mahogany</option>
                <option value="Bamboo">Bamboo</option>
                <option value="Ipil-ipil">Ipil-ipil</option>
                <option value="Molave">Molave</option>
                <option value="Balete">Balete</option>
                <option value="Bitaog">Bitaog</option>
                <option value="Agoho">Agoho</option>
                <option value="Yakal">Yakal</option>
                <option value="Tanguile">Tanguile</option>
                <option value="Almaciga">Almaciga</option>
                <option value="Dao">Dao</option>
                <option value="Dita">Dita</option>
                <option value="Gmelina">Gmelina</option>
                <option value="Kamagong">Kamagong</option>
                <option value="Lauan">Lauan</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Location</label>
            <input type="text" name="location" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Planted At (optional)</label>
            <input type="date" name="planted_at" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" max="2025-12-10">
        </div>
        <button type="submit" class="w-full bg-green-700 text-white py-2 rounded-md hover:bg-green-800">Add Tree</button>
    </form>
</div>
@endsection
