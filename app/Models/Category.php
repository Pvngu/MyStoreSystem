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

    public function scopeFilter($query, array $filters){
        if($filters['search'] ?? false){
            $query->where('name', 'like', '%' . request('search') . '%');
        }

        if(($filters['sort_order']) ?? false) {
            $column = request('sort_column');
            
            if($filters['sort_column'] == $column && $filters['sort_order'] == 'D'){
                $query->orderBy($column, 'desc');
            }
            
            else{
                $query->orderBy($column, 'asc');
            }
        }
    }
}
