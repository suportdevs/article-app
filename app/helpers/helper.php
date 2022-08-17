<?php

// use App\Services\MasterService;

use App\Models\Tag;
use App\Services\MasterService;
use Illuminate\Support\Facades\Auth;

function pr($object, $exit = true) {
    echo '<pre>';
    print_r($object);
    echo '</pre>';
    if ($exit == true) {
        exit;
    }
}

function articleTypes()
{
    return ['Article', 'News', 'Videos'];
}
function articleStatus()
{
    return ['Pending', 'Publish', 'Draft'];
}

function authenticateUser() {

    return Auth::user();
}