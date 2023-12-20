@extends('layouts.master')

@section('title', 'Create Menu and Menu Item')

@section('content')
    <div class="flex items-center justify-center h-screen">
        <div class="max-w-md w-full border-8 p-6 rounded-md">
            <h1 class="text-3xl font-bold mb-4">Create Menu and Menu Item</h1>

            {{-- Weergeven van validatiefouten --}}
            @if ($errors->any())
                <div class="mb-4 p-4 text-sm text-red-600 bg-red-100 rounded-lg" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('menu.storeCombined') }}" method="post" enctype="multipart/form-data">
                @csrf

                {{-- Veld voor de naam van het menu --}}
                <div class="mb-4">
                    <label for="menu_name" class="block text-sm font-medium text-gray-700 mb-1">Menu Name:</label>
                    <input type="text" name="menu_name" id="menu_name" placeholder="Menu Name" class="input input-bordered w-full max-w-xs" required>
                </div>

                {{-- Velden voor het menu-item --}}
                <div class="mb-4">
                    <label for="item_name" class="block text-sm font-medium text-gray-700 mb-1">Menu Item Name:</label>
                    <input type="text" name="item_name" id="item_name" placeholder="Item Name" class="input input-bordered w-full max-w-xs" required>
                </div>

                <div class="mb-4">
                    <input type="number" name="price" id="price" placeholder="Price" class="input input-bordered w-full max-w-xs" required>
                </div>

                <div class="mb-4">
                    <textarea name="description" id="description" class="textarea textarea-bordered" placeholder="Description"></textarea>
                </div>

                <div class="mb-4">
                    <input type="file" name="image" id="image" accept="image/*" class="file-input file-input-bordered w-full max-w-xs" />
                </div>

                <div class="mb-4">
                    <input type="checkbox" checked="checked" name="available" id="available" class="checkbox" />
                    <span class="text-sm text-gray-500">Available</span>
                </div>

                <div class="mb-4">
                    <label for="category_ids" class="block text-sm font-medium text-gray-700 mb-1">Categories:</label>
                    <select name="category_ids[]" id="category_ids" class="select select-bordered w-full max-w-xs" multiple>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="bg-blue-500 text-white p-2 rounded-md cursor-pointer w-full">Create</button>
            </form>
        </div>
    </div>
@endsection
