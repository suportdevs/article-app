<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function(User $user, $ability) {
            if($user->role_id == 1){
                return true;
            }
            return $this->hasPermission($ability);
        });
        
    }
    private function hasPermission($ability)
        {
            $permissions = Auth::user()->permission->items ?? "{}";
            $permissions = json_decode($permissions, true);
            return array_key_exists($ability, $permissions);
        }
}
