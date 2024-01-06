<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    use HasFactory;

    public function addresses(): hasMany{
        return $this->hasMany(Address::class);
    }

    public function country():BelongsTo {
        return $this->belongsTo(Country::class);
    }
}
