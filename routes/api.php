<?php

Route::group([
    'prefix' => 'v1',
    'middleware' => ['bindings']
], function () {
    // 登录接口
    Route::group([
    ], function () {
        // 获取 token
        Route::post('authorizations', 'AuthorizationsController@store')
            ->name('api.authorizations.store');
        // 刷新 token
        Route::put('authorizations/current', 'AuthorizationsController@update')
            ->name('api.authorizations.update');
        // 删除 token
        Route::delete('authorizations/current', 'AuthorizationsController@destroy')
            ->name('api.authorizations.destroy');
    });

    // 需要 token 验证的接口
    Route::group([
        'middleware' => [
            // 此处认证的是 admin 守卫
            'auth:api'],
    ], function () {
        /****************************************************用户*******************************************************/
        // 列表
        Route::get('users', 'UsersController@index')
            ->name('api.users.index');
        // 查看当前用户
        Route::get('users/current/show', 'UsersController@currentShow')
            ->name('api.users.current.show');
        // 详情
        Route::get('users/{user}', 'UsersController@show')
            ->name('api.users.show');
        // 新增
        Route::post('users', 'UsersController@store')
            ->name('api.users.store');
        // 修改当前用户
        Route::patch('users/current/update', 'UsersController@currentUpdate')
            ->name('api.users.current.update');
        // 修改
        Route::patch('users/{user}', 'UsersController@update')
            ->name('api.users.update');
        // 删除
        Route::delete('users/{user}', 'UsersController@destroy')
            ->name('api.users.destroy');
    });
});

