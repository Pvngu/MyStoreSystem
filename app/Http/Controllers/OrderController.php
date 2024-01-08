<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use App\Models\Customer;
use Illuminate\Support\Carbon;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        return view('orders.index', [
            'orders' => Order::with('customer', 'items')->orderBy('id' ,'desc')->filter(request(['search', 'status', 'customer']))->paginate(20)->withQueryString(),
            'customers' => Customer::orderBy('first_name')->get()
        ]);
    }

    public function create() {
        return view('orders.create', [
            'items' => Item::where('stock', '>', 0)->orderBy('name')->get(),
            'customers' => Customer::orderBy('first_name')->get()
        ]);
    }
}
