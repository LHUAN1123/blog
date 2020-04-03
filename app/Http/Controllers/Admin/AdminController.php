<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use DB;
class AdminController extends Controller
{
    //后台公共菜单页
    public function index() 
    {
    	return view('admin.index');
    }

    //后台首页
    public function welcome() 
    {
        $data = DB::table('admin_upload')->where('type',1)->select('url')->get();
        // dd($data);
    	return view('admin.welcome',['data' => $data]);
    }

    //退出登陆
    public function logout()
    {
        Session()->flush();
        return redirect('/admin/login');
    }
}
