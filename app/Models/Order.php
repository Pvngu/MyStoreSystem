<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;

    public function items() : BelongsToMany {
        return $this->belongsToMany(Item::class);
    }

    public function customer() : BelongsTo {
        return $this->belongsTo(Customer::class);
    }

    public function scopeFilter($query, array $filters) {
        if($filters['search'] ?? false) {
            $query->where('id', '=', request('search'));
        }

        if($filters['status'] ?? false) {
            $query->where('status', '=', request('status'));
        }

        if($filters['customer'] ?? false) {
            $query->where('customer_id', '=', request('customer'));
        }
    }
}
