<?php

namespace App\Services;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MasterAppServiceProvider {

    public Array $users = [];
    public Array $urlSegments = [];
    public $urlPrefix;
    public $routePrefix;
    public function __construct()
    {
        $this->users[] = $this->users();
        $this->urlSegments = $this->urlSegments();
        $this->urlPrefix = $this->urlPrefix();
        $this->routePrefix = $this->routePrefix();
    }

    public function users()
    {
        return User::get();
    }

    public function urlSegments()
    {
        $requestUrl = $_SERVER['REQUEST_URI'] ?? "/";
        return explode('/', $requestUrl);
    }

    public function urlPrefix()
    {
        if(is_array($this->urlSegments()) && $this->urlSegments() !== null && !empty($this->urlSegments())){
            foreach($this->users() as $user){
                // dd($this->urlSegments());
                return ($this->urlSegments()[1] === $user->slug) ? $user->slug : '';
            }
        }
    }

    public function routePrefix()
    {
        if(is_array($this->urlSegments()) && $this->urlSegments() !== null){
            foreach($this->users() as $user){
                return ($this->urlSegments()[1] === $user->slug) ? $user->slug . "." : '';
            }
        }
        return '';
    }

}