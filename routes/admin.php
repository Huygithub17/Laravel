<?php
Route::prefix('admin')->group(function () {
    // Category: ok -11
    Route::prefix('categories')->group(function () {
        Route::get('/', [
            'as' => 'categories.index',
            'uses' => 'CategoryController@index',
            'middleware' => 'can:category-list'
        ]);
        Route::get('/create', [
            'as' => 'categories.create',
            'uses' => 'CategoryController@create',
            'middleware' => 'can:category-add'
        ]);
        Route::post('/store', [
            'as' => 'categories.store',
            'uses' => 'CategoryController@store'

        ]);
        Route::get('/edit/{id}', [
            'as' => 'categories.edit',
            'uses' => 'CategoryController@edit',
            'middleware' => 'can:category-edit'
        ]);

        Route::post('/update/{id}', [
            'as' => 'categories.update',
            'uses' => 'CategoryController@update'
        ]);
        Route::get('/delete/{id}', [
            'as' => 'categories.delete',
            'uses' => 'CategoryController@delete',
            'middleware' => 'can:category-delete'
        ]);

    });

    //Menu: ok -22 -ok
    Route::prefix('menus')->group(function () {
        Route::get('/', [
            'as' => 'menus.index',
            'uses' => 'MenuController@index',
            'middleware' => 'can:menu-list'
        ]);
        Route::get('/create', [
            'as' => 'menus.create',
            'uses' => 'MenuController@create',
            'middleware' => 'can:menu-add'
        ]);
        Route::post('/store', [
            'as' => 'menus.store',
            'uses' => 'MenuController@store'
        ]);

        Route::get('/edit/{id}', [
            'as' => 'menus.edit',
            'uses' => 'MenuController@edit',
            'middleware' => 'can:menu-edit'
        ]);

        Route::post('/update/{id}', [
            'as' => 'menus.update',
            'uses' => 'MenuController@update'
        ]);

        Route::get('/delete/{id}', [
            'as' => 'menus.delete',
            'uses' => 'MenuController@delete',
            'middleware' => 'can:menu-delete'
        ]);
    });

    //product: ok -33
    Route::prefix('products')->group(function () {
        Route::get('/', [
            'as' => 'products.index',
            'uses' => 'AdminProductsController@index',
            'middleware' => 'can:product-list'
        ]);
        Route::get('/create', [
            'as' => 'products.create',
            'uses' => 'AdminProductsController@create',
            'middleware' => 'can:product-add'
        ]);
        Route::post('/store', [
            'as' => 'products.store',
            'uses' => 'AdminProductsController@store'
        ]);
        Route::get('/edit/{id}', [
            'as' => 'products.edit',
            'uses' => 'AdminProductsController@edit',
            'middleware' => 'can:product-edit,id'
        ]);
        Route::post('/update/{id}', [
            'as' => 'products.update',
            'uses' => 'AdminProductsController@update'
        ]);
        Route::get('/delete/{id}', [
            'as' => 'products.delete',
            'uses' => 'AdminProductsController@delete',
            'middleware' => 'can:product-delete'
        ]);
    });

    //slider: ok -44
    Route::prefix('sliders')->group(function () {
        Route::get('/', [
            'as' => 'sliders.index',
            'uses' => 'AdminSlidersController@index',
            'middleware' => 'can:slider-list'
        ]);
        Route::get('/create', [
            'as' => 'sliders.create',
            'uses' => 'AdminSlidersController@create'
        ]);
        Route::post('/store', [
            'as' => 'sliders.store',
            'uses' => 'AdminSlidersController@store'
        ]);
        Route::get('/edit/{id}', [
            'as' => 'sliders.edit',
            'uses' => 'AdminSlidersController@edit'
        ]);

        Route::post('/update/{id}', [
            'as' => 'sliders.update',
            'uses' => 'AdminSlidersController@update'
        ]);
        Route::get('/delete/{id}', [
            'as' => 'sliders.delete',
            'uses' => 'AdminSlidersController@delete'
        ]);
    });

    //Settings: ok -55
    Route::prefix('settings')->group(function () {
        Route::get('/', [
            'as' => 'settings.index',
            'uses' => 'AdminSettingsController@index',
            'middleware' => 'can:setting-list'
        ]);
        Route::get('/create', [
            'as' => 'settings.create',
            'uses' => 'AdminSettingsController@create'
        ]);
        Route::post('/store', [
            'as' => 'settings.store',
            'uses' => 'AdminSettingsController@store'
        ]);
        Route::get('/edit/{id}', [
            'as' => 'settings.edit',
            'uses' => 'AdminSettingsController@edit'
        ]);
        Route::post('/update/{id}', [
            'as' => 'settings.update',
            'uses' => 'AdminSettingsController@update'
        ]);
        Route::get('/delete/{id}', [
            'as' => 'settings.delete',
            'uses' => 'AdminSettingsController@delete'
        ]);


    });

    //Users: ok -66
    Route::prefix('users')->group(function () {
        Route::get('/', [
            'as' => 'users.index',
            'uses' => 'AdminUsersController@index'
            //'middleware' => 'can:user-list'
        ]);
        Route::get('/create', [
            'as' => 'users.create',
            'uses' => 'AdminUsersController@create'
        ]);
        Route::post('/store', [
            'as' => 'users.store',
            'uses' => 'AdminUsersController@store'
        ]);
        Route::get('/edit/{id}', [
            'as' => 'users.edit',
            'uses' => 'AdminUsersController@edit'
        ]);
        Route::post('/update/{id}', [
            'as' => 'users.update',
            'uses' => 'AdminUsersController@update'
        ]);
        Route::get('/delete/{id}', [
            'as' => 'users.delete',
            'uses' => 'AdminUsersController@delete'
        ]);

    });

    //Roles: ok -77
    Route::prefix('roles')->group(function () {
        Route::get('/', [
            'as' => 'roles.index',
            'uses' => 'AdminRolesController@index',
            'middleware' => 'can:role-list'
        ]);
        Route::get('/create', [
            'as' => 'roles.create',
            'uses' => 'AdminRolesController@create',
            'middleware' => 'can:role-add'
        ]);
        Route::post('/store', [
            'as' => 'roles.store',
            'uses' => 'AdminRolesController@store'
        ]);
        Route::get('/edit/{id}', [
            'as' => 'roles.edit',
            'uses' => 'AdminRolesController@edit'
        ]);
        Route::post('/update/{id}', [
            'as' => 'roles.update',
            'uses' => 'AdminRolesController@update'
        ]);
        Route::get('/delete/{id}', [
            'as' => 'roles.delete',
            'uses' => 'AdminRolesController@delete'
        ]);
    });

    //Permissions: -8 continue - today: 29/8/2022 : Create a new one;
    Route::prefix('permissions')->group(function () {
        Route::get('/create', [
            'as' => 'permissions.create',
            'uses' => 'AdminPermissionsController@create'
        ]);

        Route::post('/store', [
            'as' => 'permissions.store',
            'uses' => 'AdminPermissionsController@store'
        ]);
    });
});
