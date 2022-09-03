<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'username',
        'slug',
        'name',
        'email',
        'password',
        '_key'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(UserRole::class, 'role_id', 'id');
    }

    public function permission()
    {
        return $this->belongsTo(UserPermission::class, 'user_id');
    }

    public function scopeFilter($query, $filters)
    {
        $query->when($filters->user_name ?? false, function ($query, $name){
            $query->where('username', 'like', '%' . trim($name) . '%')->orWhere('name', 'like', '%'. trim($name) . '%')->orWhere('email', 'like' . '%' . trim($name) . '%');
        });
    }
}
