<?php

namespace App\Http\Controllers\Admin\Role;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Power;
use DB;
use Illuminate\Support\Facades\Redis;

class PowerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //定义一个变量，存放所有的权限
        $data = [];
        // $data = Power::paginate(15);
        $listkey = 'LIST:POWER';
        $hashkey = 'HASH:POWER';
        // redis中存要取得权限
        if (\Redis::exists($listkey)) {
            
            $list = \Redis::lrange($listkey, 0,-1);
            foreach($list as $k=>$v){
                $data[] = \Redis::hgetall($hashkey.$v);
            }
            // dd($data);
        }else {
            // 1.链接mysql数据库，获取需要的数据
            $data[] = Power::get()->ToArray();
             
            // 2.将数据存入redis
             foreach($data as $value){
                foreach ($value as $k => $v) {
                 \Redis::rpush($listkey,$v['id']);
                 \Redis::hMset($hashkey.$v['id'],$v);
                }

             }
            
        }
        // 3.返回数据给客户端
        return view('admin.role.power.list')->with(['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = DB::table('admin_category')->get();
        return view('admin.role.power.create')->with(['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();
        $result = Power::insert($data);
        if ($result) {
            return Response(['code' => 1, 'msg' => '新增成功！']);
        } else {
            return Response(['code' => 2, 'msg' => '新增失败！']);           
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data = DB::table('admin_category')->get();
        $power = Power::where('id', $id)->first();
        return view('admin.role.power.edit')->with(['data' => $data, 'power' => $power]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $data = $request->all();
        $result = Power::where('id', $id)->update($data);
        if ($result) {
            return Response(['code' => 1, 'msg' => '编辑成功！']);
        } else {
            return Response(['code' => 2, 'msg' => '编辑失败！']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $result = Power::where('id', $id)->delete();
        if ($result) {
            return Response(['code' => 1, 'msg' => '删除成功！']);
        } else {
            return Response(['code' => 2, 'msg' => '删除成功！']);
        }
        
    }
}
