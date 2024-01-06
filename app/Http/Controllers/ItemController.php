<?php

namespace App\Http\Controllers;
use App\Models\Item;
use App\Models\Category;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;

class ItemController extends Controller
{
    //Show all items
    public function index () {
        $items = Item::with('category')->filter(request(['search', 'status', 'category', 'sort_column', 'sort_order']))->paginate(20)->withQueryString();
        $categories = Category::orderBy('name')->get();
        return view('items.index', compact('items', 'categories'));
    }

    public function create () {
        $categories = Category::orderBy('name')->get()->where('id', '>', 1);
        return view('items.create', compact('categories'));
    }

    public function store(Request $request) {
        $formfields = $request->validate([
            'name' => ['required', Rule::unique('items', 'name')],
            'stock' => 'required|numeric',
            'cost_price' => 'required|numeric',
            'unit_price' => 'required|numeric',
            'category_id' => 'required'
        ]);

        if($request->hasFile('image')){
            $formfields['image'] = $request->file('image')->store('item_images', 'public');
        }

        Item::create($formfields);

        return redirect('/inventory/items')->with('message', 'Item created successfully!');
    }

    public function edit(Item $item){
        $categories = Category::orderBy('name')->get();
        return view('items.edit', ['item' => $item], compact('categories'));
    }

    public function update(Request $request, Item $item){
        $formFields = $request->validate([
            'name' => 'required',
            'stock' => 'required|numeric',
            'cost_price' => 'required|numeric',
            'unit_price' => 'required|numeric',
            'category_id' => 'required'
        ]);

        if($request->hasFile('image')){
            FIle::delete('storage/' . $item->image);
            $formFields['image'] = $request->file('image')->store('item_images', 'public');
        }
        else if($request->empty_image == 'yes'){
            FIle::delete('storage/' . $item->image);
            $formFields['image'] = '';
        }

        $item->update($formFields);

        return redirect('/inventory/items')->with('message', 'Item updated successfully!');
    }

    public function destroy(Request $request) {
        $item = Item::find($request->item_delete_id);
        if($item) {
            $destination = 'storage/' . $item->image;
            if(File::exists($destination)) {
                File::delete($destination);
            }
            $item->delete();
            return back()->with('message', 'Item deleted successfully');
        }
        else {
            return back()->with('errorMessage', 'Item was not found');
        }
    }
}