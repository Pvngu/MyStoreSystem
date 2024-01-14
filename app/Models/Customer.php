<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'email', 'phone', 'active', 'address_id'];

    public function address()  : BelongsTo {
        return $this->belongsTo(Address::class);
    }

    public function orders() : HasMany {
        return $this->hasMany(Order::class);
    }

    public function scopeFilter($query, array $filters){
        if($filters['search'] ?? false){
            $query->where('id', request('search'))
            ->orWhere(DB::raw('CONCAT(first_name, " ", last_name)'), 'like', '%' . request('search') . '%');
        }

        if($filters['status'] ?? false) {
            $query->where('active', $filters['status'] == 'active' ? 1 : 0);
        }

        if(($filters['sort_order']) ?? false) {
            if($filters['sort_column'] == 'name') {
                $query->orderBy('first_name', $filters['sort_order'] == 'D' ? 'desc' : 'asc');
            }
            else {
                $query->orderBy(request('sort_column'), $filters['sort_order'] == 'D' ? 'desc' : 'asc');
            }
        }

    }
}