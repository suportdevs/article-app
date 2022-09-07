<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\MasterAppServiceProvider;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
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
        return User::pluck('slug')->toArray();
    }

    public function urlSegments()
    {
        $requestUrl = $_SERVER['REQUEST_URI'] ?? "/";
        return explode('/', $requestUrl);
    }

    public function urlPrefix()
    {
        if(is_array($this->urlSegments()) && $this->urlSegments() !== null && !empty($this->urlSegments())){
            if(in_array($this->urlSegments()[1], $this->users())){
                return $this->urlSegments()[1];
            } else {
                return "";
            }
        }
    }

    public function routePrefix()
    {
        if(is_array($this->urlSegments()) && $this->urlSegments() !== null){
            if(in_array($this->urlSegments()[1], $this->users())){
                return $this->urlSegments()[1] . '.';
            } else {
                return "";
            }
        }
        return '';
    }
    
    public function getSetting()
    {
        return 25;
    }
}
