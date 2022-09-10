<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait Master {
    public static function cr()
    {
        return Auth::user();
    }
}