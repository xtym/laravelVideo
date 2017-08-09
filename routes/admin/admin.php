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
Route::group(['prefix'=>'admin','namespace'=>'Admin'],function (){
    // 后台首页
    Route::get('index','Entry@index');
    // 后台登录
    Route::match(['get','post'],'login','Entry@login');
    // 后台退出
    Route::get('logout','Entry@logout');
    // 后台首页
    Route::get('changepassword','Entry@changepassword');
});