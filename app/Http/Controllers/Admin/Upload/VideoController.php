<?php

namespace App\Http\Controllers\Admin\Upload;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = DB::table('admin_video')
                ->leftJoin('admin_users','admin_video.user_id', '=', 'admin_users.id')
                ->leftJoin('admin_upload', 'admin_video.upload_picture_id', '=', 'admin_upload.id')
                ->select('admin_video.text', 'admin_video.title', 'admin_upload.url', 'admin_users.nickname', 'admin_video.create_time', 'admin_video.status')
                ->paginate(15);
        return view('admin.upload.video.list')->with(['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.upload.video.create');
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
        $data['user_id'] = session('user_id');
        $result = DB::table('admin_video')->insert($data);
        if ($result) {
           return Response(['code' => 1, 'msg' => '上传成功，待审核中']); 
        } else {
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
    }
}
