<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'slug', 'created_by', 'updated_by', '_key'];

    public function scopeFilter($query, $filters)
    {
        $query->when($filters->tag_name ?? false, function($query, $name){
            $query->where('name', 'like', '%' . trim($name) . '%');
        });
    }
}
