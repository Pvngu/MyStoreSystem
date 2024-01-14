<?php

namespace App\Http\Controllers;
use App\Models\Item;
use App\Models\Order;
use App\Models\Customer;
use App\Models\ItemOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        return view('orders.index', [
            'orders' => Order::filter(request(['search', 'status', 'customer', 'sort_column', 'sort_order']))->paginate(20)->withQueryString(),
            'customers' => Customer::orderBy('first_name')->get()
        ]);
    }

    public function create() {
        return view('orders.create', [
            'items' => Item::where('stock', '>', 0)->orderBy('name')->get(),
            'customers' => Customer::orderBy('first_name')->get()
        ]);
    }
    public function store(Request $request) {
        $formFields = $request->validate([
            'customer_id' => 'required',
            'date' => 'required',
            'status' => 'required'
        ]);
        
        $formFields['total_amount'] = 0;

        $order = Order::create($formFields);

        $itemCount = $request->itemCount;
        if($itemCount){
            $totalAmount = [];
            for($i = 1; $i <= $itemCount; $i++) {
                $itemId = $request->input('item' . $i);
                $quantity = $request->input('quantity' . $i);
                $item = Item::find($itemId);
                ItemOrder::create([
                    'order_id' => $order->id,
                    'item_id' => $itemId,
                    'quantity' => $quantity
                ]);
                $item->decrement('stock', $quantity);
                array_push($totalAmount, $item->unit_price * $quantity);
            }
            $order->update(['total_amount' => array_sum($totalAmount)]);
        }

        return redirect('/orders')->with('message', 'Order created successfully');
    }

    public function edit(Order $order) {
        return view('orders.edit', [
            'order' => $order,
            'items' => Item::where('stock', '>', 0)->orderBy('name')->get(),
            'customers' => Customer::orderBy('first_name')->get(),
            'itemsOrder'=> ItemOrder::where('order_id',$order->id)->get()
        ]);
    }

    public function update(Request $request, Order $order) {
        $formFields = $request->validate([
            'customer_id' => 'required',
            'date' => 'required',
            'status' => 'required'
        ]);

        $order->update($formFields);

        $itemCount = $request->itemCount;
        if($itemCount){
            $totalAmount = [];
            $ids = [];
            for($i = 1; $i <= $itemCount; $i++) {
                $itemId = $request->input('item' . $i);
                $quantity = $request->input('quantity' . $i);
                $itemOrder = ItemOrder::where('order_id', $order->id)->where('item_id', $itemId)->first();
                $item = Item::find($itemId);
                if($itemOrder) {
                    $item->increment('stock', $itemOrder->quantity);
                    $itemOrder->update([
                        'order_id' => $order->id,
                        'item_id' => $itemId,
                        'quantity' => $quantity
                    ]);
                    $item->decrement('stock', $quantity);
                    array_push($ids, $itemOrder->id);
                    array_push($totalAmount, $item->unit_price * $quantity);
                }
                elseif(is_null($itemOrder) && isset($itemId)){
                    $newItemOrder = ItemOrder::create([
                        'order_id' => $order->id,
                        'item_id' => $itemId,
                        'quantity' => $quantity
                    ]);
                    $item->decrement('stock', $quantity);
                    array_push($ids, $newItemOrder->id);
                    array_push($totalAmount, $item->unit_price * $quantity);
                }
            }
            ItemOrder::whereNotIn('id', $ids)->where('order_id', $order->id)->delete();
            $order->update(['total_amount' => array_sum($totalAmount)]);
        }

        return redirect('/orders')->with('message', 'Order updated successfully');
    }

    public function destroy(Request $request) {
        $order = Order::find($request->row_delete_id);
        if($order) {
            $order->delete();
            return back()->with('message', 'order successfully deleted');
        }
        else {
            return back()->with('errorMessage', 'Order was not found');
        }
    }
}
