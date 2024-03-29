<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Mamun;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes, Mamun;

    protected $fillable = ['name', 'slug', 'description', 'created_by', 'updated_by', '_key'];

    public function creator()
    {
        return $this->belongsTo(User::class, "created_by");
    }

    public function scopeFilter($query, $filters)
    {
        $query->when($filters->category_name ?? false, function($query, $name){
            $query->where('name', 'like', '%' . trim($name) . '%');
        });
    }
}
