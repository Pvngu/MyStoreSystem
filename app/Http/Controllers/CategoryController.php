<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;

use function PHPUnit\Framework\isNull;

class CategoryController extends Controller
{
    public function index() {
        return view('categories.index', [
            'categories' => Category::with('items')->filter(request(['search', 'sort_column', 'sort_order']))->paginate(20),
            'categoryCount' => Category::where('id', '>', '0')->get(),
            'items' => Item::get()
        ]);
    }
    
    public function create() {
        return view('categories.create', [
            'items' => Item::orderBy('name')->where('category_id', '=', '1')->get()
        ]);
    }

    public function store(Request $request) {
        $formFields = $request->validate([
            'name' => ['required', Rule::unique('categories', 'name')],
            'description' => 'nullable'
        ]);

        if($request->hasFile('image')){
            $formFields['image'] = $request->file('image')->store('category_images', 'public');
        }

        $category = Category::create($formFields);

        if($category) {
            if($request->has('ids')) {
                Item::whereIn('id', $request->ids)->update(['category_id' => $category->id]);
            }
            
            return redirect('/inventory/categories')->with('message', 'Category created successfully');
        }
        else{
            return back()->with('errorMessage', 'There was an error');
        }
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

        if($category){
            if($request->has('ids')) {
                Item::whereIn('id', $request->ids)->update(['category_id' =>$category->id]);
                Item::where('category_id', $category->id)->whereNotIn('id', $request->ids)->update(['category_id' => 1]);
            }
            else{
                Item::where('category_id', $category->id)->update(['category_id' => 1]);
            }
            return redirect('/inventory/categories')->with('message', 'Category updated successfully');
        }
        else{
            return redirect('/inventory/categories')->with('errorMessage', 'There was an error');
        }
    }

    public function destroy(Request $request) {
        $category = Category::find($request->row_delete_id);
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

    public function deleteCategories(Request $request){
        $ids = $request->ids;
        foreach($ids as $id) {
            $category = Category::find($id);
            $destination = 'storage/' . $category->image;
            if(File::exists($destination)) {
                File::delete($destination);
            }
        }
        Item::whereIn('category_id',$ids)->update(['category_id' => 1]);
        Category::whereIn('id', $ids)->delete();

        return redirect('/inventory/categories')->with('message', 'Categories deleted successfully');
    }
}
