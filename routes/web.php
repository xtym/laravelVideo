<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('test','Test@index')->name('test');

// 组件 路由组
Route::group(['prefix'=>'component','namespace'=>'Component'],function (){
    Route::match(['get','post'],'uploader','Uploader@uploader');
    Route::match(['get','post'],'filelists','Uploader@filesLists');
    Route::match(['get','post'],'oss','Oss@sign');

});

require __DIR__.'/admin/admin.php';
require __DIR__.'/api.php';