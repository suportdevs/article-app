<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('fontend.home', [
            'categories'        => Category::all(),
            'posts'             => Post::with('user', 'category')->latest()->take(10)->get(),
        ]);
    }
}
