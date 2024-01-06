<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'image'];

    public function items() : HasMany {
        return $this->hasMany(Item::class);
    }

    public function scopeFilter($query, $filter){
        if($filter ?? false){
            $query->where('name', 'like', '%' . request('search') . '%');
        }
    }
}
