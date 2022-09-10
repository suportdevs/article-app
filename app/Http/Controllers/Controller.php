<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\MasterAppServiceProvider;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;

class Controller extends MasterAppServiceProvider
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public $projects;
    public function __construct()
    {
        $this->projects = Auth::user();
    }
}
