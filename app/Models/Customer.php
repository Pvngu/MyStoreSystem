<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public function scopeFilter($query, array $filters){
        if($filters['search'] ?? false){
            $query->where('first_name', 'like', '%' . request('search') . '%')
            ->orwhere('last_name', 'like', '%' . request('search') .'%');
        }

        if($filters['status'] ?? false) {
            $query->where('active', '=', request('status'));
        }
    }
}
