<?php
Route::group(['middleware' => ['web']], function () {
    Route::get('/', function () {
        return view('index');
    });

    Route::group(['prefix' => 'admin'], function () {
        Route::post('authenticate',    ['as' => 'admin.authenticate', 'uses' => 'Admin\AuthController@authenticate']);
    });

    Route::group(['middleware' => ['auth.sentinel']], function () {
        Route::group(['prefix' => 'admin'], function () {
            Route::get('dashboard',    ['as' => 'admin.dashboard', 'uses' => 'Admin\DashboardController@index']);
        });
    });
});