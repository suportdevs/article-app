<?php

namespace App\Services;

use App\Models\Tag;

class MasterService {

    public $name = 'Mamun';
    public function tags()
    {
        return Tag::first()->name;
    }

}