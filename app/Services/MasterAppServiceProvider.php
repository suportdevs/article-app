<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserPermission;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class MasterAppServiceProvider extends Controller {

    public Array $users = [];
    public static $currentUserId;
    public $permitId;
    public Array $urlSegments = [];
    public $urlPrefix;
    public $routePrefix;
    public function __construct()
    {   
        $this->middleware('web');
            // $this->currentUserId = Auth::id();
            $this->permitId = UserPermission::where('user_id', Auth::id())->pluck('user_id')->toArray();
            $this->urlSegments = $this->urlSegments();
            $this->urlPrefix = $this->urlPrefix();
            $this->routePrefix = $this->routePrefix();
    }

    public function users()
    {
        // dd(Auth::user());
        return User::pluck('slug')->toArray();
    }

    public function urlSegments()
    {
        $requestUrl = $_SERVER['REQUEST_URI'] ?? "/";
        return explode('/', $requestUrl);
    }

    public function urlPrefix()
    {
        dd(self::$currentUserId);
        if(in_array(self::$currentUserId, $this->permitId)){
            if(is_array($this->urlSegments()) && $this->urlSegments() !== null && !empty($this->urlSegments())){
                if(in_array($this->urlSegments()[1], $this->users())){
                    return $this->urlSegments()[1];
                } else {
                    return "";
                }
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

    public function currentUser()
    {
        return UserPermission::where('user_id', Auth::id())->first();
    }

    public static function getAuth($auth)
    {
        return self::$currentUserId = $auth;
    }

}