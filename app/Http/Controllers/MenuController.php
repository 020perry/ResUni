<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class MenuController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $menus = Menu::with('menuItems')->get();

        return view('menu.index', compact('menus'));
    }

    public function show(Menu $menu)
    {
        $menu->load('menuItems'); // Eager laadt de menu-items
        return view('menu.show', compact('menu'));
    }

    public function getMenus()
    {
        $menus = Menu::with('menuItems')->get();
        return $menus;
    }

    public function getCategories()
    {
        $categories = Category::all();
        return $categories;
    }
    public function generateQrCode($menuId)
    {
        $url = route('menu.show', ['menu' => $menuId]);

        $qrCode = QrCode::size(100)->generate($url);
        $base64Image = 'data:image/png;base64,' . base64_encode($qrCode);

        return response()->json(['qrCodeImage' => $base64Image]);
    }

//    public function generateQrCode($menuId)
//    {
//        $url = route('menu.showByCode', ['code' => $menuId]);
//
//        $qrCode = QrCode::size(100)->generate($url);
//        $base64Image = 'data:image/png;base64,' . base64_encode($qrCode);
//
//        return response()->json(['qrCodeImage' => $base64Image]);
//    }

    public function showByCode($code)
    {
        $menuItem = MenuItem::findOrFail($code);
        return view('menu.show', compact('menuItem'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('menu.create', compact('categories'));
    }
    public function createMenu()
    {
        return view('create_menu');
    }
    public function storeCombined(Request $request)
    {
        $request->validate([
            'menu_name' => 'required',
            'item_name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_ids' => 'array',
        ]);

        // Creëer het menu en het menu-item binnen een transactie
        DB::beginTransaction();

        try {
            // Creëer het menu
            $menu = Menu::create([
                'name' => $request->input('menu_name'),
            ]);

            // Creëer het menu-item en koppel het aan het menu
            $menuItem = MenuItem::create([
                'name' => $request->input('item_name'),
                'price' => $request->input('price'),
                'description' => $request->input('description'),
                'menu_id' => $menu->id,
            ]);

            // Verwerk de afbeelding en beschikbaarheid zoals eerder

            // Koppel het menu-item aan het menu
            $menu->menuItems()->attach($menuItem->id);

            // Koppel categorieën aan het menu-item
            $menuItem->categories()->sync($request->input('category_ids', []));

            // Commit de transactie
            DB::commit();

            return redirect()->route('menu.index')->with('success', 'Menu and menu item created successfully.');
        } catch (\Exception $e) {
            // Als er een fout optreedt, maak de transactie ongedaan
            DB::rollback();

            return redirect()->back()->withInput()->withErrors(['error' => 'Error creating menu and menu item.']);
        }
    }

    public function storeMenu(Request $request)
    {
        $request->validate([
            'name' => 'required', // Valideer de naam van het menu
        ]);

        $menu = new Menu();
        $menu->name = $request->input('name');
        $menu->save();

        return redirect()->route('menu.index')->with('success', 'Menu created successfully.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_ids' => 'array',
        ]);

        $available = $request->has('available') ? true : false;

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('menu_images', 'public');
        }

        $menuItem = MenuItem::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'extra_description' => $request->input('extra_description', null), // optioneel veld
            'available' => $available,
            'image' => $imagePath,
        ]);

        $menuItem->categories()->sync($request->input('category_ids', []));

        return redirect()->route('menu.index')->with('success', 'Menu item created successfully.');
    }

    public function update(Request $request, MenuItem $menuItem)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_ids' => 'array',
        ]);

        $imagePath = $menuItem->image;
        if ($request->hasFile('image')) {
            if ($menuItem->image) {
                Storage::disk('public')->delete($menuItem->image);
            }
            $imagePath = $request->file('image')->store('menu_images', 'public');
        }

        $menuItem->update([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'extra_description' => $request->input('extra_description'),
            'available' => $request->input('available', false),
            'image' => $imagePath,
        ]);

        $menuItem->categories()->sync($request->input('category_ids', []));

        return redirect()->route('menu.index')->with('success', 'Menu item updated successfully.');
    }

    public function destroy(MenuItem $menuItem)
    {
        if ($menuItem->image) {
            Storage::disk('public')->delete($menuItem->image);
        }

        $menuItem->categories()->detach();
        $menuItem->delete();

        return redirect()->route('menu.index')->with('success', 'Menu item deleted successfully.');
    }
}
