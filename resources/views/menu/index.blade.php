<!-- resources/views/menu/index.blade.php -->

@extends('layouts.master')

@section('title', 'Menu Index')

@section('content')
    <h1 class="text-3xl font-bold mb-4 text-center">Menu</h1>


    <div x-data="{ selectedCategory: '' }" class="flex flex-wrap justify-center mb-4">
        <div class="container border bg-base-300 rounded-md p-4 mb-4 max-w-md mx-2 relative">
            <div class="mb-4">
                <label for="categoryFilter" class="block mb-1">Filter by Category:</label>
                <select x-model="selectedCategory" id="categoryFilter" name="categoryFilter" class="p-2 shadow menu dropdown-content z-[1] bg-base-100 rounded-box w-full ">
                    <option value="">All Categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                @foreach ($menuItems as $menuItem)
                    <div x-show="selectedCategory === '' || '{{ implode(',', $menuItem->categories->pluck('id')->toArray()) }}'.split(',').includes(selectedCategory)"
                         class="menu-item-container  bg-base-200 rounded-md shadow-md transition duration-300 transform hover:shadow-2xl flex flex-col">
                        <div class="mb-4">
                            <figure>
                                <img src="{{ asset('storage/' . $menuItem->image) }}" alt="{{ $menuItem->name }}" class="w-full h-32 object-cover rounded-t-md">
                            </figure>
                        </div>
                        <h2 class="card-title p-1">{{ $menuItem->name }}</h2>
                        <p class="p-1">{{ $menuItem->price }}</p>
                        <p class="p-1">{{ $menuItem->description }}</p>
                    </div>
                @endforeach
            </div>


        </div>

        <div class="max-w-md mx-2">
            <div class="border rounded-md p-4 bg-base-300 mb-4">
                <h2 class="mb-4 ">Actions</h2>

                <!-- Add Menu Item -->
                <div class="mb-2">
                    <a href="{{ route('menu.create') }}" class="btn">Add Menu Item</a>
                </div>

                <!-- Edit Menu Item -->
                <div class="mb-2">
                    <a href="{{ route('menu.edit', $menuItem->id) }}" class="btn">Edit Menu Item</a>
                </div>

                <!-- Delete Menu Item -->
                <div>
                    <form action="{{ route('menu.destroy', $menuItem->id) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this menu item?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn">Delete Menu Item</button>
                    </form>
                </div>
            </div>

            <!-- QR Code -->
            <div class="border rounded-md p-4 bg-base-300 mb-4">
                <h2 class=" mb-4 ">QR Code</h2>

                <!-- Generate QR Code -->
                <div class="mb-2">
                    <button class="btn">Generate QR Code</button>
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
