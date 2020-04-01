<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Power;

class Role extends Model
{
    //关联的数据表
    public $table = 'admin_role';

    //2.主键
    public $primaryKey = 'id';

    protected $connection = 'mysql1';

    //3.允许批量操作的字段
    
    // public $fillable = ['username', 'nickname', 'password', 'email'];
    public $guarded = [];

    // 4.是否维护screate_time
    public $timestamps = false;

    //添加动态属性，关联权限模型
    public function power()
    {
        return $this->belongsToMany('App\Models\Power', 'role_power', 'role_id', 'power_id');
    }
}
