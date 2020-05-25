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

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/',function(){
    return view('welcome');
});

// 登录页
// Route::get('login','Auth\LoginController@login');
Route::get('login',function(){
    return 123;
});
// 完成登录
Route::post('dologin','Home\LoginController@dologin');
// 退出登录
Route::get('loginout','Home\LoginController@loginout');
// 验证码
Route::get('code','Home\LoginController@code');

// // 用户修改密码
// Route::get('user/{id}/edit','Home\OldUserController@edit');
// // 执行用户修改密码
// Route::put('user/edit/{id}','Home\OldUserController@update');
Route::resource('user','Home\UserController');


Route::group(['namespace'=>'Home','middleware'=>['islogin']],function(){
    // 聊天页
    Route::get('chat','ChatController@show');
    // 发送消息
    Route::post('chat/write','ChatController@write');
    // 读取消息
    Route::get('chat/read','ChatController@read');

});


Route::get('/test',function(){
    if(1&&2){
        echo 'hoi';
    }
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
