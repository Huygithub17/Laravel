<?php

namespace App\Providers;

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
        // category::
        // Kết hợp cả policy và gate; ok
        Gate::define('category-list', 'App\Policies\CategoryPolicy@view');
        Gate::define('category-add', 'App\Policies\CategoryPolicy@create');
        Gate::define('category-edit', 'App\Policies\CategoryPolicy@update');
        Gate::define('category-delete', 'App\Policies\CategoryPolicy@delete');

//        Gate::define('category-list', function ($user) {
//            return $user->checkPermissionAccess(config('permissions.access.category-list'));
//        });

        //List
        Gate::define('menu-list', function ($user) {
            return $user->checkPermissionAccess(config('permissions.access.menu-list'));
        });

        Gate::define('slider-list', function ($user) {
            return $user->checkPermissionAccess(config('permissions.access.slider-list'));
        });

        Gate::define('product-list', function ($user) {
            return $user->checkPermissionAccess(config('permissions.access.product-list'));
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
