<?php

namespace App\Services;

use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

trait QueryTriggerService {
    
    public static function getByUser()
    {
        return static::where('created_by', Auth::user()->id);
    }
}