<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginPost;

class LoginController extends Controller
{
    //后台登录
    public function doLogin (LoginPost $request)
    {
    	$where = $request->only(['username']);
    	$resutl = DB::table('admin_users')->where($where)->first();
    	if ($resutl == null) {
    		return Response(['code' => 0, 'msg' => '该用户还没有注册']);
    	}
    	//哈希解密
    	if (Hash::check($request->password, $resutl->password)) {
	    	//判断用户状态
	    	if($resutl->status == 0){
	    		return Response(['code' => 1, 'msg' => '该用户已被禁用']);
	    	}

	    	session(['user_id' => $resutl->id]);
	    	session(['nickname' => $resutl->nickname]);
	    	session(['user_name' => $resutl->username]);

		    return Response(['code' => 2, 'msg' => '登录成功，正在跳转！']);    		
    	} else {
	    	return Response(['code' => 3, 'msg' => '密码错误，请从新输入！']);
	    } 
    }

    //没有权限页面
    public function noaccess() 
    {
        return view('errors.noaccess');
    }
}
