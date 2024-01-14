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
            $filters['status'] == 'OutStock' ? $query->where('stock', '=', 0) : $query->where('stock', '>', 0);
        }

        if($filters['category'] ?? false) {
            $query->where('category_id', '=', request('category'));
        }
        

        if(($filters['sort_order']) ?? false) {
            if($filters['sort_column'] == 'category') {
                $query->join('categories', 'categories.id', '=', 'items.category_id')
                      ->orderBy('categories.name', $filters['sort_order'] == 'D' ? 'desc' : 'asc')
                      ->select('items.*', 'categories.name as category_name');
            }
            else {
                $query->orderBy(request('sort_column'), $filters['sort_order'] == 'D' ? 'desc' : 'asc');
            }
        }
    }
}
