<?php

namespace App\Services;

use App\Models\Tag;

trait ServiceTraits {
    
    public static function getAll()
    {
        return static::get();
    }
}