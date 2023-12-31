<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::filter(request('search'))->paginate(20);
        $items = Item::all();
        return view('categories.index', compact('categories'));
    }
    
    public function create() {
        $items = Item::orderBy('name')->get();
        return view('categories.create', compact('items'));
    }
}
