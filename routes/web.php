<?php

use Illuminate\Support\Facades\Route;
use Symfony\Component\Routing\Router;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;

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

Route::get('/', [AuthController::class, 'show'])->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/home', function () {
    return view('home');
})->middleware('auth');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

// inventory

// Show all Inventory
Route::get('inventory/items', [ItemController::class, 'index'])->middleware('auth');

// Show create form
Route::get('inventory/items/create', [ItemController::class, 'create'])->middleware('auth');

// Store item data
Route::post('inventory/items', [ItemController::class, 'store'])->middleware('auth');

// Show edit form
Route::get('inventory/items/{item}/edit', [ItemController::class, 'edit'])->middleware('auth');

// Update items
Route::put('inventory/items/{item}', [ItemController::class, 'update'])->middleware('auth');

// Delete an item
Route::delete('inventory/items/{item}', [ItemController::class, 'destroy'])->middleware('auth');

//Delete more than one item
Route::post('/inventory/items/delete-items', [ItemController::class, 'deleteItems'])->middleware('auth');

//categories

// Show all categories
Route::get('inventory/categories', [CategoryController::class, 'index'])->middleware('auth');

// Show create form
Route::get('inventory/categories/create', [CategoryController::class, 'create'])->middleware('auth');

// Store Category Data
Route::post('inventory/categories', [CategoryController::class, 'store'])->middleware('auth');

// Show edit form
Route::get('inventory/categories/{category}/edit', [CategoryController::class, 'edit'])->middleware('auth');

//Update categories
Route::put('inventory/categories/{category}', [CategoryController::class, 'update'])->middleware('auth');

// Delete a category
Route::delete('inventory/categories/{category}', [CategoryController::class, 'destroy'])->middleware('auth');

//Delete more than one category
Route::post('/inventory/categories/delete-categories', [CategoryController::class, 'deleteCategories'])->middleware('auth');

//Customers

// Show all customers
Route::get('customers', [CustomerController::class, 'index'])->middleware('auth');

// Show create form
Route::get('customers/create', [CustomerController::class, 'create'])->middleware('auth');

// Select Country, States and cities option
Route::get('countries', [CustomerController::class, 'getCountries'])->name('countries');
Route::get('states', [CustomerController::class, 'getStates'])->name('states');
Route::get('cities', [CustomerController::class, 'getCities'])->name('cities');

// Store customer data
Route::post('customers', [CustomerController::class, 'store']);

// Show edit form
Route::get('customers/{customer}/edit', [CustomerController::class, 'edit'])->middleware('auth');

// Update customers
Route::put('customers/{customer}', [CustomerController::class, 'update'])->middleware('auth');

// Delete a customer
Route::delete('customers/{customer}', [CustomerController::class, 'destroy'])->middleware('auth');

// Delete more than one customer
Route::post('customers/delete-customers', [CustomerController::class, 'deleteCustomers'])->middleware('auth');

// Orders

// Show all orders
Route::get('orders', [OrderController::class, 'index'])->middleware('auth');

// Show create form
Route::get('orders/create', [OrderController::class, 'create'])->middleware('auth');

// Get ordered items
Route::get('items', [OrderController::class, 'getItems'])->name('items')->middleware('auth');

// Store order data
Route::post('orders', [OrderController::class, 'store'])->middleware('auth');

//Show edit form
Route::get('orders/{order}/edit', [OrderController::class, 'edit'])->middleware('auth');

// Update order data
Route::put('orders/{order}', [OrderController::class, 'update'])->middleware('auth');

// Delete an order
Route::delete('orders/{order}', [OrderController::class, 'destroy'])->middleware('auth');

// Delete more than one order
Route::post('orders/delete-orders', [OrderController::class, 'deleteOrders'])->middleware('auth');

// Users

// Show all users
Route::get('users', [UserController::class, 'index'])->middleware('auth');

// Show create form
Route::get('users/create', [UserController::class, 'create'])->middleware('auth');

// Store user data
Route::post('users', [UserController::class, 'store'])->middleware('auth');

// Show edit form
Route::get('users/{user}/edit', [UserController::class, 'edit'])->middleware('auth');

//Update users
Route::put('users/{user}', [UserController::class, 'update'])->middleware('auth');

// Delete a user
Route::delete('users/{user}', [UserController::class, 'destroy'])->middleware('auth');

// Delete more than one user
Route::post('users/delete-users', [UserController::class, 'deleteUsers'])->middleware('auth');

// Show all roles
Route::get('users/roles', [RoleController::class, 'index'])->middleware('auth');

// Show create form
Route::get('users/roles/create', [RoleController::class, 'create'])->middleware('auth');

// store role data
Route::post('users/roles', [RoleController::class, 'store'])->middleware('auth');

// Show edit form
Route::get('users/roles/{role}/edit', [RoleController::class, 'edit']);

// update roles
Route::put('users/roles/{role}', [RoleController::class, 'update']);

// Delete role
Route::delete('users/roles/{role}', [RoleController::class, 'destroy'])->middleware('auth');
