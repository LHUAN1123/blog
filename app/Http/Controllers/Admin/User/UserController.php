<?php

namespace App\Http\Controllers\Admin\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use DB;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = User::paginate(15);
        return view('admin.user.list')->with(['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = DB::table('admin_role')->get();
        return view('admin.user.create')->with(['data' => $data]);
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
        $data = $request->except('repass');
        if ($data['password'] == $request->repass) {

            $data['password'] = Hash::make($data['password']);
            $data['create_time'] = time();
            $res = DB::table('admin_users')->insertGetId($data);

            if ($res) {

                $arr['uid'] = $res;
                $arr['role_id'] = $data['role'];
                $result = DB::table('user_role')->insert($arr);

                return Response(['code' => 1, 'msg' => '添加成功！']);
            } else {
                return Response(['code' => 2, 'msg' => '添加失败！']);  
            }

        } else {
            return Response(['code' => 3, 'msg' => '确认密码与密码不一致']);
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
        $data = DB::table('admin_role')->get();
        $result = DB::table('admin_users')->where('id', $id)->first();
        return view('admin.user.edit')->with(['data' => $data, 'result' => $result]);
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

        $role = DB::table('user_role')->where('uid', $id)->first();
            $result = DB::table('admin_users')->where('id', $id)->update($data);
            if($result){
                DB::table('user_role')->where('uid', $id)->update(['role_id' => $data['role']]);
                return Response(['code' => 1, 'msg' => '添加成功！']);                
            } else {
                return Response(['code' => 2, 'msg' => '添加失败！']);                
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
       $result = DB::table('admin_users')->where('id', $id)->delete();
       if ($result) {
          DB::table('user_role')->where('uid', $id)->delete();
          return Response(['code' => 1, 'msg' => '删除成功！']);                
       } else {
          return Response(['code' => 2, 'msg' => '删除失败！']);
       }
    }
}
