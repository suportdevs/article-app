<?php

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
function permission_module()
{
    return [
        'articles_permission_module' => 'Aritcles Permission Module List',
        'user_permission_module'       => 'User Permission Module',
        'subscribe_permission_module'       => 'Subscribe Permission Module'
    ];
}
function articles_permission_module(){
    return [
        'tag_list'         => 'Tag List',
        'tag_create'       => 'Tag Create',
        'tag_edit'         => 'Tag Edit',
        'tag_delete'       => 'Tag Delete',
        'post_list'         => 'Post List',
        'post_create'       => 'Post Create',
        'post_edit'         => 'Post Edit',
        'post_delete'       => 'Post Delete'
    ];
}
function user_permission_module()
{
    return [
        'user_list'         => 'User List',
        'user_create'       => 'User Create',
        'user_edit'         => 'User Edit',
        'user_delete'       => 'User Delete'
    ];
}
function subscribe_permission_module()
{
    return [
        'subscription_list' => 'Subscription List',
        'subscription_delete'       => 'Subscribe Delete'
    ];
}