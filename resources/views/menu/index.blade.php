<!-- resources/views/menu/index.blade.php -->

@extends('layouts.master')

@section('title', 'Menu Index')

@section('content')
    <h1 class="text-3xl font-bold mb-4 text-center">Menu</h1>

    <div class="max-w-lg mx-auto border rounded-md p-4 bg-gray-100">
        <div class="mb-4">
            <label for="categoryFilter" class="block text-sm font-medium text-gray-700 mb-1">Filter by Category:</label>
            <select id="categoryFilter" name="categoryFilter" class="mt-1 p-2 border rounded-md w-full bg-white">
                <option value="">All Categories</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            @foreach ($menuItems as $menuItem)
                <div class="bg-white p-4 rounded-md shadow-md transition duration-300 transform hover:shadow-2xl">
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . $menuItem->image) }}" alt="{{ $menuItem->name }}" class="w-full h-32 object-cover rounded-md mb-2">
                    </div>
                    <p class="text-lg font-semibold mb-2 text-indigo-600">{{ $menuItem->name }}</p>
                    <p class="text-gray-600">{{ $menuItem->description }}</p>
                    <!-- Voeg andere velden toe zoals beschrijving, prijs, etc. -->
                </div>
            @endforeach
        </div>
    </div>
@endsection
