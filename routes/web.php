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

Route::post('/login', [AuthController::class, 'login'])->middleware('guest');

Route::middleware('auth')->group(function () {

    Route::get('/logout', [AuthController::class, 'logout']);

    Route::get('/home', function () {
        return view('home');
    });

    Route::get('/logout', [AuthController::class, 'logout']);

    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('permission:menu-dashboard');

    // <----------------------------> Inventory <---------------------------->
    Route::controller(ItemController::class)->group(function () {
        // Show all Inventory
        Route::get('inventory/items', 'index')->middleware('permission:menu-inventory');

        // Show create form
        Route::get('inventory/items/create', 'create')->middleware('permission:create inventory');

        // Store item data
        Route::post('inventory/items', 'store')->middleware('permission:create inventory');

        // Show edit form
        Route::get('inventory/items/{item}/edit', 'edit')->middleware('permission:edit inventory');

        // Update items
        Route::put('inventory/items/{item}', 'update')->middleware('permission:edit inventory');

        // Delete an item
        Route::delete('inventory/items/{item}', 'destroy')->middleware('permission:delete inventory');

        //Delete more than one item
        Route::post('/inventory/items/delete-items', 'deleteItems')->middleware('permission:delete inventory');
    });

    // <----------------------------> Categories <---------------------------->
    Route::controller(CategoryController::class)->group(function () {

        // Show all categories
        Route::get('inventory/categories', 'index')->middleware('permission:menu-inventory');

        // Show create form
        Route::get('inventory/categories/create', 'create')->middleware('permission:create inventory');

        // Store Category Data
        Route::post('inventory/categories', 'store')->middleware('permission:create inventory');

        // Show edit form
        Route::get('inventory/categories/{category}/edit', 'edit')->middleware('permission:create inventory');

        //Update categories
        Route::put('inventory/categories/{category}', 'update')->middleware('permission:edit inventory');

        // Delete a category
        Route::delete('inventory/categories/{category}', 'destroy')->middleware('permission:delete inventory');

        //Delete more than one category
        Route::post('/inventory/categories/delete-categories', 'deleteCategories')->middleware('permission:delete inventory');
    });

    // <----------------------------> Customers <---------------------------->
    Route::controller(CustomerController::class)->group(function () {
        // Show all customers
        Route::get('customers', 'index')->middleware('permission:menu-customers');

        // Show create form
        Route::get('customers/create', 'create')->middleware('permission:create customer');

        // Select Country, States and cities option
        Route::get('countries', [CustomerController::class, 'getCountries'])->middleware('permission:create customer')->name('countries');
        Route::get('states', [CustomerController::class, 'getStates'])->middleware('permission:create customer')->name('states');
        Route::get('cities', [CustomerController::class, 'getCities'])->middleware('permission:create customer')->name('cities');

        // Store customer data
        Route::post('customers', 'store')->middleware('permission:create customer');

        // Show edit form
        Route::get('customers/{customer}/edit', 'edit')->middleware('permission:edit customer');
        // Update customers
        Route::put('customers/{customer}', 'update')->middleware('permission:edit customer');

        // Delete a customer
        Route::delete('customers/{customer}', 'destroy')->middleware('permission:delete customer');

        // Delete more than one customer
        Route::post('customers/delete-customers', 'deleteCustomers')->middleware('permission:delete customer');
    });
    
    // <----------------------------> Orders <---------------------------->
    Route::controller(OrderController::class)->group(function () {

        // Show all orders
        Route::get('orders', 'index')->middleware('permission:menu-orders');

        // Show create form
        Route::get('orders/create', 'create')->middleware('permission:create order');

        // Get ordered items
        Route::get('items', 'getItems')->name('items')->middleware('permission:menu-orders');

        // Store order data
        Route::post('orders', 'store')->middleware('permission:create order');

        //Show edit form
        Route::get('orders/{order}/edit', 'edit')->middleware('permission:edit order');

        // Update order data
        Route::put('orders/{order}', 'update')->middleware('permission:edit order');

        // Delete an order
        Route::delete('orders/{order}', 'destroy')->middleware('permission:delete order');

        // Delete more than one order
        Route::post('orders/delete-orders', 'deleteOrders')->middleware('permission:delete order');
    });

    // <----------------------------> Users <---------------------------->
    Route::controller(UserController::class)->group(function () {

        // Show all users
        Route::get('users', 'index')->middleware('permission:menu-users');

        // Show create form
        Route::get('users/create', 'create')->middleware('permission:create user');
        // Store user data
        Route::post('users', 'store')->middleware('permission:create user');

        // Show edit form
        Route::get('users/{user}/edit', 'edit')->middleware('permission:edit user');
        //Update users
        Route::put('users/{user}', 'update')->middleware('permission:edit user');

        // Delete a user
        Route::delete('users/{user}', 'destroy')->middleware('permission:delete user');

        // Delete more than one user
        Route::post('users/delete-users', 'deleteUsers')->middleware('permission:delete user');
    });

    Route::controller(RoleController::class)->group(function () {
        // Show all roles
        Route::get('users/roles', 'index')->middleware('permission:menu-users');

        // Show create form
        Route::get('users/roles/create', 'create')->middleware('permission:create user');

        // store role data
        Route::post('users/roles', 'store')->middleware('permission:create user');

        // Show edit form
        Route::get('users/roles/{role}/edit', 'edit')->middleware('permission:edit user');

        // update roles
        Route::put('users/roles/{role}', 'update')->middleware('permission:edit user');

        // Delete role
        Route::delete('users/roles/{role}', 'destroy')->middleware('permission:delete user');

        // Delete more than one user
        Route::post('users/roles/delete-roles', 'deleteRoles')->middleware('permission:delete user');
    });
});
