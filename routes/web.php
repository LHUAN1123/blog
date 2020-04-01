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
Route::view('/admin/login', 'admin.login');					       			//后台登录页面测试修改内容
Route::post('/admin/doLogin', 'Admin\LoginController@doLogin');				//处理后台登录
Route::view('/admin/forget', 'admin.forget');								//忘记密码
Route::post('/admin/doforget', 'Admin\LoginController@doforget');			//查找绑定邮箱
Route::post('/admin/modify_pass', 'Admin\LoginController@modify_pass');   	//修改密码
Route::view('/admin/register', 'admin.register');							//用户注册页面
Route::post('/admin/doregister', 'Admin\LoginController@doregister');		//处理用户注册

Route::post('/admin/upload', 'Admin\ToolController@oneFile');				//单文件文件上传公用接口

Route::get('/noaccess', 'Admin\LoginController@noaccess');					//没有权限页面  
Route::get('/index/captcha/{tmp}', 'Admin\LoginController@captcha'); 



Route::group(['namespace' => 'Admin', 'middleware' => ['hasRole', 'admin.login']], function () {

Route::get('/', 'AdminController@index'); 									//后台公共菜单
Route::get('/admin/welcome', 'AdminController@welcome');					//后台主页
Route::get('/admin/logout', 'AdminController@logout');						//退出登陆

// -------------------------------图片、音乐、文章、视频上传-----------------------------------//
Route::resource('/admin/video', 'Upload\VideoController');					//上传视频列表


// ---------------------------------------------------------------------------------------------//

// --------------------------------角色权限模块-----------------------------------------//
Route::get('/role/auth/{id}', 'Role\RoleController@auth');			//角色授权
Route::post('/role/doauth', 'Role\RoleController@doauth');			//处理角色授权

Route::resource('/admin/role', 'Role\RoleController');				//角色
Route::post('/admin/role/{id}', 'Role\RoleController@update');		//角色编辑
Route::resource('/admin/power', 'Role\PowerController');			//权限
Route::post('/admin/power/{id}', 'Role\PowerController@update');	//权限编辑
// ----------------------------------------------------------------------------------//


// --------------------------------用户管理-----------------------------------------//
Route::resource('/admin/user', 'User\UserController');				//用户管理
Route::post('/admin/user/{id}', 'User\UserController@update');	//用户编辑

// --------------------------------------------------------------------------------//


// -------------------------------模拟秒杀-----------------------------------//
Route::get('/admin/init', 'Redis\RedisController@index');
Route::post('/admin/start', 'Redis\RedisController@start');
Route::get('/admin/show', 'Redis\RedisController@result');
// --------------------------------------------------------------------//
});
