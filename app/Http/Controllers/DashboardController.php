<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use App\Models\Customer;
use App\Models\ItemOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index () {
        return view('dashboard', [
            'itemCount' => Item::count(),
            'customerCount' => Customer::count(),
            'orderCount' => Order::count(),
            'orders' => Order::orderBy('id', 'desc')
                       ->take(5)
                       ->get(),
            'topItems' => DB::table('item_order')
                       ->selectRaw('sum(quantity) as sold, item_order.item_id, items.name as name, items.image as image')
                       ->join('items', 'items.id', '=', 'item_order.item_id')
                       ->groupBy('name', 'item_id', 'image')
                       ->orderBy('sold', 'desc')
                       ->take(4)
                       ->get(),
            'totalEarning' => Order::all()->sum('total_amount')
        ]);
    }
}
