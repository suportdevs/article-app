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

function permissionModules()
{
    return [
        'articles_module' => 'Aritcles Module',
        'user_module'       => 'User Module',
        'subscribe_module'       => 'Subscribe Module'
    ];
}
function articles_module()
{
    return [
        'articles_module_list' => 'Aritcles Module List',
        'user_module_create'       => 'User Module Create',
        'subscribe_module_edit'       => 'Subscribe Module Edit'
    ];
}
function user_module()
{
    return [
        'articles_module_list' => 'Aritcles Module List',
        'user_module_create'       => 'User Module Create',
        'subscribe_module_edit'       => 'Subscribe Module Edit'
    ];
}
function subscribe_module()
{
    return [
        'articles_module_list' => 'Aritcles Module List',
        'user_module_create'       => 'User Module Create',
        'subscribe_module_edit'       => 'Subscribe Module Edit'
    ];
}