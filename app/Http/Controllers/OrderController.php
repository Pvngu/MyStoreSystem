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
            'orders' => Order::with('customer')->filter(request(['search', 'status', 'customer', 'sort_column', 'sort_order']))->paginate(20)->withQueryString(),
            'customers' => Customer::orderBy('first_name')->get(),
            'orderCount' => Order::all()
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

        $order = Order::create($formFields);

        if(!$order) {
            return redirect('/orders')->with('errorMessage', 'There was an error');
        }

        if($request->has('ids')) {
            $totalAmount = [];
            $items = Item::whereIn('id', $request->ids)->get();
            foreach($items as $item) {
                $quantity = $request->quantities[$item->id];
                ItemOrder::create([
                    'order_id' => $order->id,
                    'item_id' => $item->id,
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
        $itemIdsInOrder = ItemOrder::where('order_id', $order->id)->pluck('item_id')->toArray();
        return view('orders.edit', [
            'order' => $order,
            'items' => Item::where('stock', '>', 0)->whereNotIn('id', $itemIdsInOrder)->orderBy('name')->get(),
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

        if(!$order) {
            return redirect('/orders')->with('errorMessage', 'There was an error');
        }

        if($request->has('ids')) {
            $totalAmount = [];
            $items = Item::whereIn('id', $request->ids)->get();

            foreach($items as $item) {
                $quantity = $request->quantities[$item->id];
                $itemOrder = ItemOrder::where('order_id', $order->id)->where('item_id', $item->id)->first();

                if($itemOrder) {
                    $oldQuantity = $itemOrder->quantity;
                    $itemOrder->update(['quantity' => $quantity]);
                    if($itemOrder->wasChanged('quantity')) {
                        $item->increment('stock', $oldQuantity);
                        $item->decrement('stock', $quantity);
                    }
                    array_push($totalAmount, $item->unit_price * $quantity);
                }
                else {
                    ItemOrder::create([
                        'order_id' => $order->id,
                        'item_id' => $item->id,
                        'quantity' =>$quantity
                    ]);
                    $item->decrement('stock', $quantity);
                    array_push($totalAmount, $item->unit_price * $quantity);
                }
                $order->update(['total_amount' => array_sum($totalAmount)]);
            }
            $itemOrderDeleted = ItemOrder::where('order_id', $order->id)->whereNotIn('item_id', $request->ids)->get();
            foreach($itemOrderDeleted as $itemOrder) {
                Item::where('id', $itemOrder->item_id)->increment('stock', $itemOrder->quantity);
                $itemOrder->delete();
            }
        }
        else{
            $itemOrderDeleted = ItemOrder::where('order_id', $order->id)->get();
            if($itemOrderDeleted){
                foreach($itemOrderDeleted as $itemOrder) {
                    Item::where('id', $itemOrder->item_id)->increment('stock', $itemOrder->quantity);
                    $itemOrder->delete();
                }
            }
            $order->update(['total_amount' => 0]);
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

    public function deleteOrders(Request $request){
        Order::whereIn('id', $request->ids)->delete();
        return back()->with('message', 'Orders deleted successfully');
    }

    public function getItems (Request $request) {
        $items = DB::table('item_order')
                    ->select('item_order.id','item_order.order_id', 'item_order.item_id','items.name', 'items.unit_price' ,'items.image', 'item_order.quantity')
                    ->join('items', 'items.id', '=', 'item_order.item_id')
                    ->where('order_id', $request->order_id)
                    ->get();
        return $items;
    }
}