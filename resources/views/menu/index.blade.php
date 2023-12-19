<!-- resources/views/menu/index.blade.php -->

@extends('layouts.master')

@section('title', 'Menu Index')

@section('content')
    <h1 class="text-3xl font-bold mb-4 text-center">Menu</h1>


    <div x-data="{ selectedCategory: '' }" class="flex flex-wrap justify-center mb-4">
        <div id="actionsBox" class="border rounded-md p-4 mb-4 max-w-md mx-2 relative">
            <div class="mb-4">
                <label for="categoryFilter" class="block text-sm font-medium text-green-500 mb-1">Filter by Category:</label>
                <select x-model="selectedCategory" id="categoryFilter" name="categoryFilter" class="mt-1 p-2 border rounded-md w-full bg-white">
                    <option value="">All Categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                @foreach ($menuItems as $menuItem)
                    <div x-show="selectedCategory === '' || '{{ implode(',', $menuItem->categories->pluck('id')->toArray()) }}'.split(',').includes(selectedCategory)"
                         class="menu-item-container bg-white p-4 rounded-md shadow-md transition duration-300 transform hover:shadow-2xl">
                        <div class="mb-4">
                            <img src="{{ asset('storage/' . $menuItem->image) }}" alt="{{ $menuItem->name }}" class="w-full h-32 object-cover rounded-md mb-2">
                        </div>
                        <p class="text-lg font-semibold mb-2 text-blue-600">{{ $menuItem->name }}</p>
                        <p class="text-gray-600">{{ $menuItem->description }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="max-w-md mx-2">
            <div class="border rounded-md p-4 bg-gray-100 mb-4">
                <h2 class="text-xl font-semibold mb-4 text-green-500">Actions</h2>

                <!-- Add Menu Item -->
                <div class="mb-2">
                    <a href="{{ route('menu.create') }}" class="bg-blue-500 text-white p-2 rounded-md cursor-pointer">Add Menu Item</a>
                </div>

                <!-- Edit Menu Item -->
                <div class="mb-2">
                    <a href="{{ route('menu.edit', $menuItem->id) }}" class="bg-yellow-500 text-white p-2 rounded-md cursor-pointer">Edit Menu Item</a>
                </div>

                <!-- Delete Menu Item -->
                <div>
                    <form action="{{ route('menu.destroy', $menuItem->id) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this menu item?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white p-2 rounded-md cursor-pointer">Delete Menu Item</button>
                    </form>
                </div>
            </div>

            <!-- QR Code -->
            <div class="border rounded-md p-4 bg-gray-100">
                <h2 class="text-xl font-semibold mb-4 text-blue-500">QR Code</h2>

                <!-- Generate QR Code -->
                <div class="mb-2">
                    <button class="bg-blue-500 text-white p-2 rounded-md cursor-pointer">Generate QR Code</button>
                </div>

                <!-- Placeholder for displaying the QR code image -->
                <div>
                    <img src="{{ asset('path-to-placeholder-image') }}" alt="QR Code" class="w-full h-32 object-cover rounded-md mb-2">
                </div>
            </div>
        </div>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2" defer></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('menuController', () => ({
                selectedCategory: '',
            }));
        });
    </script>

@endsection
