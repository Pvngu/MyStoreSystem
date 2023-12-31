<?php

use App\Models\Item;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    $itemCount = Item::count();
    return view('dashboard', compact('itemCount'));
});

// inventory

// Show all Inventory
Route::get('/inventory/items', [ItemController::class, 'index']);

// Show create form
Route::get('/inventory/items/create', [ItemController::class, 'create']);

// Store item data
Route::post('/inventory/items', [ItemController::class, 'store']);

// Show edit form
Route::get('/inventory/items/{item}/edit', [ItemController::class, 'edit']);

// Update items
Route::put('/inventory/items/{item}', [ItemController::class, 'update']);

// Delete an item
Route::delete('/inventory/items/{item}', [ItemController::class, 'destroy']);

//categories

// Show all categories
Route::get('/inventory/categories', [CategoryController::class, 'index']);

// Show create form
Route::get('/inventory/categories/create', [CategoryController::class, 'create']);

//Customers

// Show all customers
Route::get('/customers', [CustomerController::class, 'index']);
