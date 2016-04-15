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
                Route::get('list',             ['as' => 'admin.post.list',        'uses' => 'Admin\PostController@all']);
                Route::get('create',           ['as' => 'admin.post.get.create',  'uses' => 'Admin\PostController@createAction']);
                Route::post('create',          ['as' => 'admin.post.post.create', 'uses' => 'Admin\PostController@create']);
                Route::post('delete/{postId}', ['as' => 'admin.post.post.delete', 'uses' => 'Admin\PostController@delete']);
                Route::get('delete/{postId}',  ['as' => 'admin.post.get.delete',  'uses' => 'Admin\PostController@delete']);
                Route::get('edit/{postId}',    ['as' => 'admin.post.edit',        'uses' => 'Admin\PostController@editAction']);
            });

            /* admin category routes */
            Route::group(['prefix' => 'category'], function () {
                Route::get('list',              ['as' => 'admin.category.list',        'uses' => 'Admin\CategoryController@all']);
                Route::get('create',            ['as' => 'admin.category.get.create',  'uses' => 'Admin\CategoryController@createAction']);
                Route::post('create',           ['as' => 'admin.category.post.create', 'uses' => 'Admin\CategoryController@create']);
                Route::get('edit',              ['as' => 'admin.category.get.edit',    'uses' => 'Admin\CategoryController@editAction']);
                Route::get('edit/{categoryId}', ['as' => 'admin.route.edit',           'uses' => 'Admin\CategoryController@editAction']);

            });
        });

    });
});


