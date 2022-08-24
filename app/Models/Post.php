<?php

namespace App\Models;

use App\Services\QueryTriggerService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes, QueryTriggerService;

    protected $fillable = ['category_id', 'tag_id', 'title', 'slug', 'intro', 'description', 'image', 'status', 'type', 'is_featured', 'created_by', 'updated_by', '_key'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function scopeFilter($query, $fillters)
    { 
        $query->when($fillters->title ?? false, function($query, $title){
            $query->where('title', 'like', '%' . trim($title) . '%')->orWhere('intro', 'like', '%' . trim($title) . '%')->orWhere('description', 'like', '%' . trim($title) . '%');
        })->when($fillters->category_id ?? false, function($query, $category_id){
            $query->where('category_id', $category_id);
        })->when($fillters->tag_id ?? false, function($query, $tag_id){
            // echo "<pre>";
            // var_dump($tag_id);
            // echo "</pre>";
            // foreach($this->tag_id as $tagArr){
            //     array_search($tag_id, $tagArr, true);
            // };
            // $query->where('category_id', $category_id);
        });
    }
}
