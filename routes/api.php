<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// 允许异步跨域请求
header('Access-Control-Allow-Origin:*');

// api路由设置
Route::group(['prefix'=>'api','namespace'=>'Api'],function (){

    Route::get( '/commendLessons/{rows}', 'Handle@commendLessons' );
    Route::get( '/hotLessons/{rows}', 'Handle@hotLessons' );
    Route::get( '/tags', 'Handle@tags' );
    Route::get( '/lessons/{tid?}', 'Handle@lessons' );
    Route::get( '/videos/{lid}', 'Handle@videos' );

});