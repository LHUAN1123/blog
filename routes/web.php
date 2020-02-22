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

/*------------------------后台路由---------------------------*/
Route::view('/admin/login', 'admin.login');					       			//后台登录页面
Route::post('/admin/doLogin', 'Admin\LoginController@doLogin');				//处理后台登录

Route::post('/admin/upload', 'Admin\ToolController@oneFile');				//单文件文件上传公用接口

Route::group(['namespace' => 'Admin', 'middleware' => ['admin.login']], function () {

Route::get('/', 'AdminController@index'); 									//后台公共菜单
Route::get('/admin/welcome', 'AdminController@welcome');					//后台主页
Route::get('/admin/logout', 'AdminController@logout');						//退出登陆

// -------------------------------图片、音乐、文章、视频上传-----------------------------------//
Route::resource('/admin/video', 'Upload\VideoController');					//上传视频列表


// ---------------------------------------------------------------------------------------------//

// --------------------------------角色模块-----------------------------------------//


Route::get('/role/auth/{id}', 'Role\RoleController@auth');			//角色授权
Route::resource('/admin/role', 'Role\RoleController');				//角色
Route::resource('/admin/power', 'Role\PowerController');			//权限
// ----------------------------------------------------------------------------------//
});