<?php

use App\Models\Item;
use App\Models\Customer;
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
    $customerCount = Customer::count();
    return view('dashboard', compact('itemCount', 'customerCount'));
});

// inventory

// Show all Inventory
Route::get('inventory/items', [ItemController::class, 'index']);

// Show create form
Route::get('inventory/items/create', [ItemController::class, 'create']);

// Store item data
Route::post('inventory/items', [ItemController::class, 'store']);

// Show edit form
Route::get('inventory/items/{item}/edit', [ItemController::class, 'edit']);

// Update items
Route::put('inventory/items/{item}', [ItemController::class, 'update']);

// Delete an item
Route::delete('inventory/items/{item}', [ItemController::class, 'destroy']);

//categories

// Show all categories
Route::get('inventory/categories', [CategoryController::class, 'index']);

// Show create form
Route::get('inventory/categories/create', [CategoryController::class, 'create']);

// Store Category Data
Route::post('inventory/categories', [CategoryController::class, 'store']);

// Show edit form
Route::get('inventory/categories/{category}/edit', [CategoryController::class, 'edit']);

//Update categories
Route::put('inventory/categories/{category}', [CategoryController::class, 'update']);

// Delete a category
Route::delete('inventory/categories/{category}', [CategoryController::class, 'destroy']);

//Customers

// Show all customers
Route::get('customers', [CustomerController::class, 'index']);

// Show create form
Route::get('customers/create', [CustomerController::class, 'create']);

// Store customer data
Route::post('customers', [CustomerController::class, 'store']);

// Show edit form
Route::get('customers/{customer}/edit', [CustomerController::class, 'edit']);

// Update customers
Route::put('customers/{customer}', [CustomerController::class, 'update']);

// Delete a customer
Route::delete('customers/{customer}', [CustomerController::class, 'destroy']);