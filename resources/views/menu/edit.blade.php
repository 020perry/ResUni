<!-- resources/views/menu/edit.blade.php -->

@extends('layouts.master')

@section('title', 'Edit Menu Item')

@section('content')
    <h1>Edit Menu Item</h1>

    <form action="{{ route('menu.update', $menuItem->id) }}" method="post">
        @csrf
        @method('PUT')
        <!-- Andere velden voor menu-item hier... -->

        <label for="category_ids">Select Categories:</label>
        <select name="category_ids[]" id="category_ids" multiple>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $menuItem->categories->contains($category) ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <button type="submit">Update Menu Item</button>
    </form>
@endsection
