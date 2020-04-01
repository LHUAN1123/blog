<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class ToolController extends Controller
{
    //单文件上传接口 $type代表上传类型：$file代表上传的文件
    public function upload($type,$file)
    {
    	//初始化文件
    	$dir = "upload/file" . date('Y-m',time()) .'/';

        //获取文件后缀名
        foreach ($file as $key => $value) {
            // dd($value);
            $ext = $value->getClientOriginalExtension();//后缀名
            $name = time() + rand(1,10000);//初始化文件名
            $url = $value->move($dir, $name.'.'.$ext);   //上传文件，将文件移动到项目存放文件的地方 
        }

    	//判断文件的类型
    	if ($type == 1) {
    		//获取路径和类型
    		$data['url'] = $url;
    		$data['type'] = 1;
            $data['create_time'] = time();
    		//将路径存入数据库
    		$id = DB::table('admin_upload')->insertGetId($data);
    		return $id;
    	} else if ($type == 2) {
    		//获取路径和类型
    		$data['url'] = $url;
    		$data['type'] = 2;
            $data['create_time'] = time();
    		//将路径存入数据库
    		$id = DB::table('admin_upload')->insertGetId($data);
    		return $id;
    	}else if (type == 3) {
    		//获取路径和类型
    		$data['url'] = $url;
    		$data['type'] = 3;
            $data['create_time'] = time();            
    		//将路径存入数据库
    		$id = DB::table('admin_upload')->insertGetId($data);
    		return $id;
    	}
    }

    public function oneFile(Request $request)
    {
        if (array_key_exists('image',$request->all())){
            $type = 1;
            $file = $request->file('image');
            $id = $this->upload($type, $file);
                if ($id) {
                    return Response(['id' => $id]);
                }

            } else if(array_key_exists('video',$request->all())){
            $type = 2;
            $file = $request->file('video');
            $id = $this->upload($type, $file);
                if ($id) {
                    return Response(['id' => $id]);
                }

            } else if (array_key_exists('music',$request->all())){
            $type = 3;
            $file = $request->file('music');
            $id = $this->upload($type, $file);
                if ($id) {
                    return Response(['id' => $id]);
                }
        }
    }
}
