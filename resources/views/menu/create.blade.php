<!-- resources/views/menu/create.blade.php -->

@extends('layouts.master')

@section('title', 'Create Menu Item')

@section('content')
    <h1 class="text-3xl font-bold mb-4">Create Menu Item</h1>

    <form action="{{ route('menu.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name:</label>
            <input type="text" name="name" id="name" class="p-2 border rounded-md w-full" required>
        </div>

        <div class="mb-4">
            <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Price:</label>
            <input type="number" name="price" id="price" class="p-2 border rounded-md w-full" required>
        </div>

        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description:</label>
            <textarea name="description" id="description" class="p-2 border rounded-md w-full" required></textarea>
        </div>

        <div class="mb-4">
            <label for="extra_description" class="block text-sm font-medium text-gray-700 mb-1">Extra Description:</label>
            <textarea name="extra_description" id="extra_description" class="p-2 border rounded-md w-full"></textarea>
        </div>

        <div class="mb-4">
            <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Image:</label>
            <input type="file" name="image" id="image" accept="image/*">
        </div>

        <div class="mb-4">
            <label for="available" class="block text-sm font-medium text-gray-700 mb-1">Available:</label>
            <input type="checkbox" name="available" id="available" class="mr-2">
            <span class="text-sm text-gray-500">Check if the menu item is available</span>
        </div>

        <button type="submit" class="bg-blue-500 text-white p-2 rounded-md cursor-pointer">Create Menu Item</button>
    </form>
@endsection
