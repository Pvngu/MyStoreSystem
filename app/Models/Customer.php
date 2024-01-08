<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'email', 'phone', 'active'];

    public function address()  : BelongsTo {
        return $this->belongsTo(Address::class);
    }

    public function orders() : HasMany {
        return $this->hasMany(Order::class);
    }

    public function scopeFilter($query, array $filters){
        if($filters['search'] ?? false){
            $query->where('first_name', 'like', '%' . request('search') . '%')
            ->orwhere('last_name', 'like', '%' . request('search') .'%');
        }

        if($filters['status'] ?? false) {
            if($filters['status'] == 'active') {
                $query->where('active', '=', 1);
            }
            if($filters['status'] == "deactive") {
                $query->where('active', '=', 0);
            }
        }
    }
}
