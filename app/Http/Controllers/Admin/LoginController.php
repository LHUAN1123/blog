<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\LoginPost;
use App\Http\Requests\RegisterPost;

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

    //查找绑定邮箱
    public function doforget(Request $request)
    {
        $email = $request->only('email');
        if (empty($email['email'])) {
            return Response(['code' => 2, 'msg' => '邮箱不能为空！']);
        }

        $data = DB::table('admin_users')->where($email)->value("email");
        if ($data == $email['email']) {
            return Response(['code' => 1, 'msg' => '邮箱正确，请在输入框输入新密码', 'result' => $email['email']]);
        } else {
            return Response(['code' => 2, 'msg' => '您的邮箱没有在本站注册']);
        }
    }

    //修改密码将新密码发送至邮箱
    public function modify_pass(Request $request)
    {
        $email = $request->only('email');
        $data = $request->only('newpass');
        $pass = Hash::make($data['newpass']);
        $result =  DB::table('admin_users')->where($email)->update(['password' => $pass]);
       if ($result) {
           Mail::send('admin.email', ['emali' => $email['email'], 'newpass' =>  $data['newpass']],  function($message) use ($email){
               $message->to($email['email']);
               $message->subject('修改密码');
           });
           return Response(['code' => 1, 'msg' => '修改密码成功，已将您的新密码发送至您的邮箱！']);
       } else{
           return Response(['code' => 2, 'msg' => '修改密码失败！']);
       }
    }

    //后台会员注册
    public function doregister(RegisterPost $request)
    {
        $data = $request->only(['username', 'nickname','email']);
        //加密密码
        $password = Hash::make($request->password);
        $data['create_time'] = time();
        $data['password'] = $password;
        $result = DB::table('admin_users')->insertGetId($data);
        if ($result) {
            $info['uid'] = $result;
            $info['role_id'] = 7; 
            DB::table('user_role')->insert($info);
           return Response(['code' => 1, 'msg' => '注册成功！']); 
        } else {
            return Response(['code' => 2, 'msg' => '注册失败！']);
        }
    }
    
}
