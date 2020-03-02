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
            ->name('admin.authorizations.store');
        // 刷新 token
        Route::put('authorizations/current', 'AuthorizationsController@update')
            ->name('admin.authorizations.update');
        // 删除 token
        Route::delete('authorizations/current', 'AuthorizationsController@destroy')
            ->name('admin.authorizations.destroy');
    });

    // 需要 token 验证的接口
    Route::group([
        'middleware' => [
            // 此处认证的是 admin 守卫
            'auth:admin'],
    ], function () {
        /****************************************************管理员*******************************************************/
        // 列表
        Route::get('admins', 'AdminsController@index')
            ->name('admin.admins.index');
        // 查看当前用户
        Route::get('admins/current/show', 'AdminsController@currentShow')
            ->name('admin.admins.current.show');
        // 详情
        Route::get('admins/{admin}', 'AdminsController@show')
            ->name('admin.admins.show');
        // 新增
        Route::post('admins', 'AdminsController@store')
            ->name('admin.admins.store');
        // 修改当前用户
        Route::patch('admins/current/update', 'AdminsController@currentUpdate')
            ->name('admin.admins.current.update');
        // 修改
        Route::patch('admins/{admin}', 'AdminsController@update')
            ->name('admin.admins.update');
        // 删除
        Route::delete('admins/{admin}', 'AdminsController@destroy')
            ->name('admin.admins.destroy');
    });
});
