<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'date', 'status', 'total_amount'];

    public function items() : BelongsToMany {
        return $this->belongsToMany(Item::class);
    }

    public function customer() : BelongsTo {
        return $this->belongsTo(Customer::class);
    }

    public function scopeFilter($query, array $filters) {
        if($filters['search'] ?? false) {
            $query->where('id', request('search'));
        }

        if($filters['status'] ?? false) {
            $query->where('status', request('status'));
        }

        if($filters['customer'] ?? false) {
            $query->where('customer_id', request('customer'));
        }
        
        if(($filters['sort_order']) ?? false) {
            $query->orderBy(request('sort_column'), $filters['sort_order'] == 'D' ? 'desc' : 'asc');
        }
    }
}
