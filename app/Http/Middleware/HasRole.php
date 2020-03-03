<?php

namespace App\Http\Middleware;
use App\Models\User;
use App\Models\Role;
use App\Models\Power;
use DB;
use Closure;
class HasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // 1.获取当前请求的路由，对应的控制器方法名
        // "App\Http\Controllers\Admin\AdminController@index"
        $route = \Route::current()->getActionName();

        // 2.获取当前用户的权限组
        $user = User::find(session()->get('user_id'));
        $roles = $user->role;
        //根据角色找权限
        $data = DB::table('role_power')
                    ->where('role_power.role_id', '=', $roles)
                    ->leftJoin('admin_power', 'role_power.power_id', '=', 'admin_power.id')
                    ->get();
        $urls = [];

        foreach ($data as $key => $value) {
           $urls[] = $value->urls;
        }
        // 去掉重复的权限
        $urls = array_unique($urls);
        
        // 判断当前请求的路由对应控制器的方法名是否在当前用户拥有的权限列表中也就是$urls中
        // if (!in_array($route, $urls)) {

        //     if ($request->ajax()) {
        //         return Response(['status'=>0,'msg'=>'很抱歉，您暂无操作此功能的权限！']);
        //     } else {
        //         return response()->view('errors.noaccess');
        //     }

        // } else {
            return $next($request);
        // }
    }
}
