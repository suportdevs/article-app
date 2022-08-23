<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscriber extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['email', '_key'];

    public function scopeFilter($query, $filters)
    {
        $query->when($filters->email ?? false, function($query, $email) {
            $query->where('email', 'like', '%' . trim($email) . '%');
        });
    }
}
