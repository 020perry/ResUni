<!-- resources/views/menu/create.blade.php -->

@extends('layouts.master')

@section('title', 'Create Menu Item')

@section('content')
    <div class="flex items-center justify-center h-screen">
        <div class="max-w-md w-full border-8 p-6 rounded-md">
            <h1 class="text-3xl font-bold mb-4">Create Menu Item</h1>

            <form action="{{ route('menu.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <input type="text" name="name" id="name" placeholder="Type here Name" class="input input-bordered w-full max-w-xs" required>
                </div>

                <div class="mb-4">
                    <input type="number" name="price" id="price" placeholder="Type here price" class="input input-bordered w-full max-w-xs" required>
                </div>

                <div class="mb-4">
                    <textarea name="description" id="description" class="textarea textarea-bordered" placeholder="description"></textarea>
                </div>

                <div class="mb-4">
                    <input type="file" name="image" id="image" accept="image/*" class="file-input file-input-bordered w-full max-w-xs" />
                </div>

                <div class="mb-4">
                    <input type="checkbox" checked="checked" name="available" id="available" class="checkbox" />
                    <span class="text-sm text-gray-500">Check if the menu item is available</span>
                </div>

                <div class="mb-4">
                    <label for="category_ids" class="block text-sm font-medium text-gray-700 mb-1">Categories:</label>
                    <select name="category_ids[]" id="category_ids" class="select select-bordered w-full max-w-xs">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="bg-blue-500 text-white p-2 rounded-md cursor-pointer w-full">Create Menu Item</button>
            </form>
        </div>
    </div>
@endsection
