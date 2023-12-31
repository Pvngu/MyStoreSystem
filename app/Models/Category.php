<?php

namespace App\Models;

use App\Models\Item;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    public function item() : HasMany {
        return $this->hasMany(Item::class);
    }

    public function scopeFilter($query, $filter){
        if($filter ?? false){
            $query->where('name', 'like', '%' . request('search') . '%');
        }
    }
}
