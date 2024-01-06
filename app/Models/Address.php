<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Address extends Model
{
    use HasFactory;

    public function customers() : hasMany {
        return $this->hasMany(Customer::class);
    }

    public function city() : BelongsTo {
        return $this->belongsTo(City::class);
    }
}
