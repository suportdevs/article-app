<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['category_id', 'tag_id', 'title', 'slug', 'intro', 'description', 'image', 'status', 'type', 'is_featured', 'created_by', 'updated_by', '_key'];

    public function scopeFilter($query, $fillters)
    {
        $query->when($fillters->title ?? false, function($query, $title){
            $query->where('title', 'like', '%' . trim($title) . '%')->orWhere('intro', 'like', '%' . trim($title) . '%')->orWhere('description', 'like', '%' . trim($title) . '%');
        });
    }
}
