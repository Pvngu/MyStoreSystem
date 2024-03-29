<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'status',
        'email',
        'password',
        'image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function scopeFilter($query, array $filters) {
        if($filters['search'] ?? false) {
            $query->where(DB::raw('CONCAT(first_name, " ", last_name)'), 'like', '%' . request('search') . '%')
            ->orWhere('username', 'like', '%'. request('search') . '%')
            ->orWhere('id', '=', request('search'));
        }
        if($filters['status'] ?? false) {
            $query->where('status', $filters['status'] == 'active' ? 1 : 0);
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
