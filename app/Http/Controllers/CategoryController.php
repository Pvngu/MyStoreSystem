<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::with('items')->filter(request('search'))->paginate(20);
        $items = Item::get();
        return view('categories.index', compact('categories'));
    }
    
    public function create() {
        $items = Item::orderBy('name')->where('category_id', '=', '1')->get();
        return view('categories.create', compact('items'));
    }

    public function store(Request $request) {
        $formFields = $request->validate([
            'name' => ['required', Rule::unique('categories', 'name')],
            'description' => 'required'
        ]);

        if($request->hasFile('image')){
            $formFields['image'] = $request->file('image')->store('category_images', 'public');
        }

        $category = Category::create($formFields);

        $itemCount = $request->itemCount;
        if($itemCount){
            for($i = 1; $i <= $itemCount; $i++) {
                $x = 'item' . $i; 
                $itemId = $request->$x;
                Item::where('id',$itemId)->update(['category_id'=>$category->id]);
            }
        }
        
        return redirect('/inventory/categories')->with('message', 'Category created successfully');
    }

    public function edit(Category $category) {
        $items = Item::orderBy('name')->where('category_id', '=', '1')->get();
        $categoryItems = Item::orderBy('name')->where('category_id', '=', $category->id)->get();
        return view('categories.edit',[
            'category' => $category,
            'items' => $items,
            'categoryItems' => $categoryItems
        ]);
    }

    public function update(Request $request, Category $category) {
        $formFields = $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('image')){
            FIle::delete('storage/' . $category->image);
            $formFields['image'] = $request->file('image')->store('category_images', 'public');
        }
        else if($request-> empty_image == 'yes'){
            File::delete('storage/' . $category->image);
            $formFields['image'] = '';
        }

        $category->update($formFields);

        $itemCount = $request->itemCount;
        if($itemCount){
            Item::where('category_id',$category->id)->update(['category_id'=> '1']);
            for($i = 1; $i <= $itemCount; $i++) {
                $x = 'item' . $i; 
                $itemId = $request->$x;
                Item::where('id',$itemId)->update(['category_id'=>$category->id]);
            }
        }

        return redirect('/inventory/categories')->with('message', 'Category updated successfully');
    }

    public function destroy(Request $request) {
        $category = Category::find($request->category_delete_id);
        if($category) {
            $destination = 'storage/' . $category->image;
            if(File::exists($destination)) {
                File::delete($destination);
            }

            Item::where('category_id',$category->id)->update(['category_id' => 1]);
            
            $category->delete();
        }
        else{
            return redirect('/inventory/categories')->with('errorMessage', 'Category was not found');
        }
        return redirect('/inventory/categories')->with('message', 'Category deleted successfully');
    }
}
