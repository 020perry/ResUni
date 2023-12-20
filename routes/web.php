<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/menus', [MenuController::class, 'getMenus']);
Route::get('/categories', [MenuController::class, 'getCategories']);

// Menu routes
Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
Route::get('/menu/{menu}', [MenuController::class, 'show'])->name('menu.show');
Route::get('/menu/create', [MenuController::class, 'create'])->name('menu.create');
Route::post('/menu', [MenuController::class, 'store'])->name('menu.store');
Route::get('/menu/{menuItem}/edit', [MenuController::class, 'edit'])->name('menu.edit');
Route::put('/menu/{menuItem}', [MenuController::class, 'update'])->name('menu.update');
Route::delete('/menu/{menuItem}', [MenuController::class, 'destroy'])->name('menu.destroy');

// QR Code generation route
Route::get('/generate-qr-code/{menuId}', [MenuController::class, 'generateQrCode']);

// Route to show menu item by code
Route::get('/menu/show/{code}', [MenuController::class, 'showByCode'])->name('menu.showByCode');

Route::get('/menu/create-menu', [MenuController::class, 'createMenu'])->name('menu.createMenu');
Route::post('/menu/store-menu', [MenuController::class, 'storeMenu'])->name('menu.storeMenu');

Route::post('/menu/store-combined', [MenuController::class, 'storeCombined'])->name('menu.storeCombined');
