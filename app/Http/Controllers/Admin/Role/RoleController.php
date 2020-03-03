<?php

namespace App\Http\Controllers\Admin\Role;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Power;
use DB;
class RoleController extends Controller
{

    //授权页
    public function auth($id)
    {
        //获取当前角色
        $role = Role::find($id);

        //获取所有的权限列表
        $power = Power::get();
        //获取当前角色拥有的权限
        $own_power = $role->power;

        //获取权限所属类别
        $data = DB::table('admin_category')->get();

        //角色拥有的权限id
        $own_powers = [];
        foreach ($own_power as  $v) {
           $own_powers[] = $v->id;
        }
        
        return view('admin.role.role.auth')
                    ->with([
                        'role' => $role, 
                        'power' => $power, 
                        'own_power' => $own_power, 
                        'own_powers' => $own_powers,
                        'data' => $data
                    ]);
    }


    public function doauth(Request $request)
    {
        //接收所有数据
        $data = $request->all();

        //添加新授予的权限
        if (!empty($data['power_id'])) {
            //删除当前角色所有权限
            DB::table('role_power')->where('role_id', $data['role_id'])->delete();

            foreach ($data['power_id'] as $k => $v) {
                DB::table('role_power')->insert(['role_id' => $data['role_id'], 'power_id' => $v]);
            }
            
            return Response(['code' => 1, 'msg' => '角色权限添加成功！']);
        } else {
            return Response(['code' => 2, 'msg' => '角色权限不能为空！']);
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Role::get();
        return view('admin.role.role.list')->with(['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.role.role.create');
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
        $data['create_time'] = time();
        $result = Role::create($data);
        if ($request) {
           return Response(['code' => 1, 'msg' => '添加成功']); 
        } else{
            return 2;
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
        $data = Role::where('id', $id)->select('id', 'name', 'describe')->first();
        return view('admin.role.role.edit', ['data' => $data]);
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
        $result = Role::where('id', $id)->update($data);
        if ($result){
            return Response(['code' => 1, 'msg' => '修改成功！']);
        } else {
            return Response(['code' => 2, 'msg' => '修改失败！']);
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
       $result = Role::where('id', $id)->delete();
       if ($result) {
            return Response(['code' => 1, 'msg' => '删除成功！']);
       } else {
            return Response(['code' => 2, 'msg' => '删除失败！']);
       }
    }
}
