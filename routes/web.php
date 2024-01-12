<?php

use App\Models\Item;
use App\Models\Order;
use App\Models\Customer;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
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
    $orderCount = Order::count();
    return view('dashboard', compact('itemCount', 'customerCount', 'orderCount'));
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

//Delete several items
Route::post('/inventory/items/delete-items', [ItemController::class, 'deleteItems']);

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

//Delete several categories
Route::post('/inventory/categories/delete-categories', [CategoryController::class, 'deleteCategories']);

//Customers

// Show all customers
Route::get('customers', [CustomerController::class, 'index']);

// Show create form
Route::get('customers/create', [CustomerController::class, 'create']);

// Select Country, States and cities option
Route::get('countries', [CustomerController::class, 'getCountries'])->name('countries');
Route::get('states', [CustomerController::class, 'getStates'])->name('states');
Route::get('cities', [CustomerController::class, 'getCities'])->name('cities');

// Store customer data
Route::post('customers', [CustomerController::class, 'store']);

// Show edit form
Route::get('customers/{customer}/edit', [CustomerController::class, 'edit']);

// Update customers
Route::put('customers/{customer}', [CustomerController::class, 'update']);

// Delete a customer
Route::delete('customers/{customer}', [CustomerController::class, 'destroy']);

// Orders

// Show all orders
Route::get('orders', [OrderController::class, 'index']);

// Show create form
Route::get('orders/create', [OrderController::class, 'create']);

// Store order data
Route::post('orders', [OrderController::class, 'store']);

//Show edit form
Route::get('orders/{order}/edit', [OrderController::class, 'edit']);

// Update order data
Route::put('orders/{order}', [OrderController::class, 'update']);

// Delete an order
Route::delete('orders/{order}', [OrderController::class, 'destroy']);

// Users

// Show all users
Route::get('users', [UserController::class, 'index']);

// Show create form
Route::get('users/create', [UserController::class, 'create']);

// Store user data
Route::post('users', [UserController::class, 'store']);

// Show edit form
Route::get('users/{user}/edit', [UserController::class, 'edit']);

//Update users
Route::put('users/{user}', [UserController::class, 'update']);

// Delete a user
Route::delete('users/{user}', [UserController::class, 'destroy']);