<?php

namespace App\Services;

use App\Models\Tag;

class MasterService {

    public function tags()
    {
        return Tag::first()->name;
    }

}