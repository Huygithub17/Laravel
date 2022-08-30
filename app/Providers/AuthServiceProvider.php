<?php

namespace App\Providers;

use App\Models\Product;
use App\Services\PermissionGateAndPolicyAccess;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
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

        // Tối ưu code theo video 93: ------->>>>>>>>>> lưu bên Services;

        $permissionGateAndPolicy = new PermissionGateAndPolicyAccess();
        $permissionGateAndPolicy->setGateAndPlicyAccess();

        //-----------------------------------------------
        // Gate: Phương pháp 1:

        Gate::define('slider-list', function ($user) {
            return $user->checkPermissionAccess(config('permissions.access.slider-list'));
        });

        Gate::define('setting-list', function ($user) {
            return $user->checkPermissionAccess(config('permissions.access.setting-list'));
        });

        Gate::define('user-list', function ($user) {
            return $user->checkPermissionAccess(config('permissions.access.user-list'));
        });

        Gate::define('role-list', function ($user) {
            return $user->checkPermissionAccess(config('permissions.access.role-list'));
        });
    }

}
