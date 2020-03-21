<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginPost;

class LoginController extends Controller
{
    //后台登录
    public function doLogin (LoginPost $request)
    {
        //判断验证码是否正确
        if(!strtolower(Session::get('milkcaptcha')) == strtolower($request->captcha)) {
            return Response(['code' => 4, 'msg' => '验证码不正确！']);
        }

        //查询用户信息
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

            //将需要的数据存入session
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

    //生成验证码
    public function captcha($tmp)
    {
        //生成验证码图片的builder对象，配置相应的属性
        $builder = new CaptchaBuilder;
        //可以设置图片的宽高及字体
        $builder->build($width = 250, $height = 70, $font = null);
        //获取验证码
        $phrase = $builder->getPhrase();
        //把内容存入session
        Session::flash('milkcaptcha', $phrase);
        //生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');
        $builder->output();
    }

    //忘记密码
    public function doforget(Request $request)
    {
        // dd($request->only('email'));
        return Response(['code' => 1, 'msg' => '邮箱正确，请在输入框输入新密码']);   
    }
}
