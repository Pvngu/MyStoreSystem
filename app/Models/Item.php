<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'stock', 'cost_price', 'unit_price', 'category_id', 'image'];

    public function category() : BelongsTo {
        return $this->belongsTo(Category::class);
    }

    public function scopeFilter($query, array $filters) {
        if($filters['search'] ?? false) {
            $query->where('name', 'like', '%' . request('search') . '%');
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
    }
}
