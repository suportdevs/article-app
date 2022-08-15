<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class MasterAppServiceProvider {

    public Array $users = [];
    public Array $urlSegments = [];
    public $urlPrefix;
    public $routePrefix;
    public function __construct()
    {
        $this->users[] = $this->users();
        $this->urlSegments[] = $this->urlSegments();
        $this->urlPrefix = $this->urlPrefix();
        $this->routePrefix = $this->routePrefix();
    }

    public function users()
    {
        return Auth::user() ?? [];
    }

    public function urlSegments()
    {
        return explode("/", $_SERVER['REQUEST_URI']);
    }

    public function urlPrefix()
    {dd($this->users());
        if(is_array($this->urlSegments()) && $this->urlSegments()[1] === $this->users()->slug){
            return $this->users()->slug . "/" ?? '';
        }
        return '';
    }

    public function routePrefix()
    {
        if(is_array($this->urlSegments()) && $this->urlSegments()[1] === $this->users()->slug){
            return $this->users()->slug . '.' ?? '';
        }
        return '';
    }

}