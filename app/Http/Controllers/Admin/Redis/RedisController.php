<?php

namespace App\Http\Controllers\Admin\Redis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;

class RedisController extends Controller
{
   public $user_number = 50; // 允许进入队列的人数
 
    /**
     * 这个方法，相当于点击进入商品详情页,开启秒杀活动
     */
    public function index()
    {
    	// Redis::del('goods_name');
        $goods_number = 10; // 商品库存数量为10
 
        if (! empty(Redis::llen('goods_name'))) {
        	$str = '已经设置了库存了';
        	return view('admin.redis.index')->with(['str' => $str]);
        }
 
        // 初始化
        Redis::command('del', ['user_number', 'success', 'uid']);
 
        // 将商品存入redis链表中
        for ($i = 1; $i <= $goods_number; $i++) {
 		
            // lpush从链表头部添加元素
            Redis::lpush('goods_name', $i);
        }
 
        // 设置过期时间
        $this->setTime();
 
        // 返回链表 goods_name 的长度
        $str = '商品存入队列成功，数量：'.Redis::llen('goods_name');
        return view('admin.redis.index')->with(['str' => $str]);

    }
 
    public function setTime()
    {
        // 设置 goods_name 过期时间，相当于活动时间
        Redis::expire('goods_name', 120);
    }
 
 
    /**
     * 这个方法，相当于点击 抢购 操作
     */
    public function start()
    {
        $uid = session('user_id');  // 假设用户ID
 
        // 如果人数超过50，直接提示被抢完
        if (Redis::llen('user_number') > $this->user_number) {
            return Response(['code' =>1, 'msg' =>'遗憾，被抢完了']);
        }
 
        // 获取抢购结果,假设里面存了uid
        $result = Redis::lrange('uid', 0, 20);
        // 如果有一个用户只能抢一次，可以加上下面判断
        if (in_array($uid, $result)) {
        	return Response(['code' =>2, 'msg' =>'你已经抢过了']);
        }
 
        // 将用户加入队列中
        Redis::lpush('user_number', $uid);
 
        // 从链表的头部删除一个元素，返回删除的元素,因为pop操作是原子性，即使很多用户同时到达，也是依次执行
        $count = Redis::lpop('goods_name');
        if (! $count) {
            return Response(['code' =>3, 'msg' =>'被抢完了']);

        }
 
        $msg = '抢到的人为：'.$uid.'，商品ID为：'.$count;
        Redis::rpush('success', $msg);
        Redis::rpush('uid', $uid);
        return Response(['code' => 4, 'msg' => '恭喜你，抢到了,商品ID为：'.$count]);
    }
 
    /**
     * 查看抢到结果
     */
    public function result()
    {
        $result = Redis::lrange('success', 0, 20);
        dd($result);
    }

}
