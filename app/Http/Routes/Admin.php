<?php
Route::group(['middlewareGroups' => ['web']], function () {
    Route::get('/', function () {
        return view('index');
    });

    Route::group(['prefix' => 'admin'], function () {
        Route::post('authenticate',    ['as' => 'admin.authenticate', 'uses' => 'Admin\AuthController@authenticate']);
        Route::get('logout',           ['as' => 'admin.logout',       'uses' => 'Admin\AuthController@logout']);
    });

    Route::group(['middleware' => ['auth.sentinel']], function () {
        /* admin routes*/
        Route::group(['prefix' => 'admin'], function () {
            Route::get('dashboard',    ['as' => 'admin.dashboard', 'uses' => 'Admin\DashboardController@index']);

            /* admin post routes */
            Route::group(['prefix' => 'post'], function () {
                Route::get('list',    ['as' => 'post.list',   'uses' => 'Admin\PostController@all']);
                Route::get('create',  ['as' => 'post.create', 'uses' => 'Admin\PostController@create']);
                Route::get('edit',    ['as' => 'post.edit',   'uses' => 'Admin\PostController@edit']);
            });

            /* admin category routes */
            Route::group(['prefix' => 'category'], function () {
                Route::get('list',    ['as' => 'category.list',   'uses' => 'Admin\CategoryController@all']);
                Route::get('create',  ['as' => 'category.create', 'uses' => 'Admin\CategoryController@create']);
                Route::get('edit',    ['as' => 'category.edit',   'uses' => 'Admin\CategoryController@edit']);

            });
        });

    });
});


