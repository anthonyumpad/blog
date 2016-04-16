<?php
Route::group(['middlewareGroups' => ['web']], function () {
    Route::group(['middleware' => ['auth.sentinel', 'isSuperAdmin']], function () {
        /* superadmin routes*/
        Route::group(['prefix' => 'superadmin'], function () {
            Route::get('dashboard',    ['as' => 'superadmin.dashboard', 'uses' => 'SuperAdmin\DashboardController@index']);

            /* superadmin user routes */
            Route::group(['prefix' => 'user'], function () {
                Route::get('list',       ['as' => 'superadmin.user.get.list',    'uses' => 'SuperAdmin\UserController@all']);
                Route::get('create',     ['as' => 'superadmin.user.get.create',  'uses' => 'SuperAdmin\UserController@createAction']);
                Route::post('create',    ['as' => 'superadmin.user.post.create', 'uses' => 'SuperAdmin\UserController@create']);
                Route::get('edit/{uid}', ['as' => 'superadmin.user.get.edit',    'uses' => 'SuperAdmin\UserController@editAction']);
            });

        });

    });
});


