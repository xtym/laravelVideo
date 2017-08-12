<?php
/**
 * Created by PhpStorm.
 * User: ziyun
 * Date: 2017/8/9
 * Time: 19:34
 */


//Route::get('/login','Admin\Entry@login');

// 后台群组路由 []
// prefix  共同前缀  路由前缀
// middleware 共同作用中间件
// namespace 共同命名空间
// domain  子域名路由

// 验证登陆的中间件组
Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>['admin.auth']],function (){
    // 后台首页
    Route::get('index','Entry@index');
    Route::get('/','Entry@index');

    // 后台退出
    Route::get('logout','Entry@logout');
    // 载入后台修改密码界面
    Route::get('changepassword','Entry@changepassword');
    // 后台修改密码
    Route::post('password','Entry@password');

    // tag 资源路由 排除show 路由
    Route::resource('tag','Tag',['except'=>['show']]);

    // vedio 视频管理资源路由
    Route::resource('lesson','Lesson');
});

// 没有验证登陆中间件组
Route::group(['prefix'=>'admin','namespace'=>'Admin'],function (){
    // 后台登录
    Route::match(['get','post'],'login','Entry@login');
});