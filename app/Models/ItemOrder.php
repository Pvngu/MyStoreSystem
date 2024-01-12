<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemOrder extends Model
{
    use HasFactory;

    protected $table = 'item_order';

    protected $fillable = ['order_id', 'item_id', 'quantity', 'total_amount'];

    public function item() : BelongsTo {
        return $this->belongsTo(Item::class);
    }
}
