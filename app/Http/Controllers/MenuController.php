<?php

// app/Http/Controllers/MenuController.php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $menuItems = MenuItem::all();

        return view('menu.index', compact('categories', 'menuItems'));
    }

    public function create()
    {
        $categories = Category::all();
        $menuItems = MenuItem::all();

        return view('menu.create', compact('categories', 'menuItems'));
    }

    public function store(Request $request)
    {
        // Validate the input, this is a basic example
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Allow only image files
            'category_ids' => 'array', // Since multiple categories are possible
        ]);

        // Convert the 'on' value from checkbox to boolean
        $available = $request->has('available') ? true : false;

        // Upload the image if provided
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('menu_images', 'public');
        }

        // Create menu item
        $menuItem = MenuItem::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'extra_description' => $request->input('extra_description'),
            'available' => $available,
            'image' => $imagePath,
        ]);

        // Attach categories to the menu item
        $menuItem->categories()->sync($request->input('category_ids', []));

        return redirect()->route('menu.index')->with('success', 'Menu item created successfully.');
    }

    public function update(Request $request, MenuItem $menuItem)
    {
        // Validate the input, this is a basic example
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Allow only image files
            'category_ids' => 'array',
        ]);

        // Upload the new image if provided
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($menuItem->image) {
                Storage::disk('public')->delete($menuItem->image);
            }

            // Store the new image
            $imagePath = $request->file('image')->store('menu_images', 'public');
        } else {
            // Keep the existing image
            $imagePath = $menuItem->image;
        }

        // Update menu item
        $menuItem->update([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'extra_description' => $request->input('extra_description'),
            'available' => $request->input('available', false),
            'image' => $imagePath,
        ]);

        // Attach categories to the menu item
        $menuItem->categories()->sync($request->input('category_ids', []));

        return redirect()->route('menu.index')->with('success', 'Menu item updated successfully.');
    }
    public function destroy(MenuItem $menuItem)
    {
        $menuItem->categories()->detach(); // Detach categorieën voordat het menu-item wordt verwijderd
        $menuItem->delete();

        return redirect()->route('menu.index')->with('success', 'Menu item deleted successfully.');
    }
}
