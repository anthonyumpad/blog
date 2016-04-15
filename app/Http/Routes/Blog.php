<?php
Route::group(['middlewareGroups' => ['web']], function () {
    Route::group(['middleware' => ['bloguser']], function () {
        Route::group(['prefix' => 'blog'], function () {
            Route::get('{username}',   ['as' => 'blog.user.index',  'uses' => 'BlogController@getUserIndex']);
        });
    });
});


