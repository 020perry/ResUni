<!-- resources/views/menu/index.blade.php -->

@extends('layouts.master')

@section('title', 'Menu Index')

@section('content')
    <h1 class="text-3xl font-bold mb-4 text-center">Menu</h1>

    <div x-data="menuController()" class="flex flex-wrap justify-center mb-4">
        <!-- Categories Filter -->
        <div class="container border bg-base-300 rounded-md p-4 mb-4 max-w-md mx-2 relative">
            <div class="mb-4">
                <label for="categoryFilter" class="block mb-1">Filter by Category:</label>
                <select x-model="selectedCategory" id="categoryFilter" class="p-2 shadow menu dropdown-content z-[1] bg-base-100 rounded-box w-full ">
                    <option value="">All Categories</option>
                    <template x-for="category in categories" :key="category.id">
                        <option x-bind:value="category.id" x-text="category.name"></option>
                    </template>
                </select>
            </div>

            <!-- Menu Items Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                <template x-for="menuItem in filteredMenuItems" :key="menuItem.id">
                    <div class="menu-item-container bg-base-200 rounded-md shadow-md transition duration-300 transform hover:shadow-2xl flex flex-col">
                        <!-- Image Placeholder -->
                        <figure>
                            <img x-bind:src="menuItem.image" alt="" class="w-full h-32 object-cover rounded-t-md">
                        </figure>
                        <h2 class="card-title p-1" x-text="menuItem.name"></h2>
                        <p class="p-1" x-text="menuItem.price"></p>
                        <p class="p-1" x-text="menuItem.description"></p>
                    </div>
                </template>
            </div>
        </div>

        <!-- Actions Section -->
        <div class="max-w-md mx-2">
            <!-- Existing Actions (Add, Edit, Delete) -->
            <!-- ... Your existing action buttons and forms ... -->

            <!-- QR Code Section -->
            <div class="border rounded-md p-4 bg-base-300 mb-4">
                <!-- Generate QR Code -->
                <button class="btn" @click="generateQrCode(menu.id)">Generate QR Code</button>

                <!-- Display QR Code -->
                <div x-show="qrCode">
                    <img :src="qrCode" alt="QR Code" class="w-full h-32 object-cover rounded-md mb-2">
                </div>
            </div>
        </div>
    </div>

    <script>
        function menuController() {
            return {
                selectedCategory: '',
                categories: [],
                menuItems: [],
                qrCode: '',

                init() {
                    this.fetchCategories();
                    this.fetchMenuItems();
                },

                fetchCategories() {
                    fetch('/categories')
                        .then(response => response.json())
                        .then(data => this.categories = data);
                },

                fetchMenuItems() {
                    fetch('/menus')
                        .then(response => response.json())
                        .then(data => this.menuItems = data);
                },

                get filteredMenuItems() {
                    return this.menuItems.filter(item =>
                        this.selectedCategory === '' || item.categories.includes(parseInt(this.selectedCategory))
                    );
                },

                generateQrCode(menuId) {
                    fetch(`/generate-qr-code/${menuId}`)
                        .then(response => response.json())
                        .then(data => {
                            this.qrCode = data.qrCodeImage;
                        });
                }
            };
        }
    </script>
@endsection
