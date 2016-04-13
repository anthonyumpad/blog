<?php
Route::group(['middleware' => ['web']], function () {
    Route::get('/', function () {
        return view('index');
    });

    Route::group(['prefix' => 'admin'], function () {
        Route::post('authenticate',    ['as' => 'admin.authenticate', 'uses' => 'Admin\AuthController@authenticate']);
    });
});