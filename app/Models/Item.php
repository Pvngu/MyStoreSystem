<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'stock', 'cost_price', 'unit_price', 'category_id', 'image'];

    public function category() : BelongsTo {
        return $this->belongsTo(Category::class);
    }

    public function orders() : BelongsToMany {
        return $this->belongsToMany(Order::class);
    }

    public function scopeFilter($query, array $filters) {
        if($filters['search'] ?? false) {
            $query->where('name', 'like', '%' . request('search') . '%')
                  ->orWhere('id', '=', request('search'));
        }
        if($filters['status'] ?? false) {
            if($filters['status'] == 'OutStock'){
                $query->where('stock', '=', 0);
            }
            if($filters['status'] == 'InStock'){
                $query->where('stock', '>', 0);
            }
        }

        if($filters['category'] ?? false) {
            $query->where('category_id', '=', request('category'));
        }
        

        if(($filters['sort_order']) ?? false) {
            $column = request('sort_column');

            if($filters['sort_column'] == 'category_id') {
                if ($filters['sort_column'] == 'category_id' && $filters['sort_order'] == 'D') {
                    $query->join('categories', 'categories.id', '=', 'items.category_id')
                        ->orderBy('categories.name', 'desc')
                        ->select('items.*', 'categories.name as category_name');
                } else {
                    $query->join('categories', 'categories.id', '=', 'items.category_id')
                        ->orderBy('categories.name', 'asc')
                        ->select('items.*', 'categories.name as category_name');
                }
            }
            else {
                if($filters['sort_column'] == $column && $filters['sort_order'] == 'D'){
                    $query->orderBy($column, 'desc');
                }
                
                else{
                    $query->orderBy($column, 'asc');
                }
            }
        }
    }
}
