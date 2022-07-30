<?php

// use App\Services\MasterService;

use App\Models\Tag;
use App\Services\MasterService;

function pr($object, $exit = true) {
    echo '<pre>';
    print_r($object);
    echo '</pre>';
    if ($exit == true) {
        exit;
    }
}


function getMamun()
{
    return new MasterService(); 
}
// $master  = new MasterService();

// dd($master->tags());

function articleTypes()
{
    return ['Article', 'News', 'Videos'];
}
function articleStatus()
{
    return ['Pending', 'Publish', 'Draft'];
}