<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //关联的数据表
    public $table = 'admin_role';

    //2.主键
    public $primaryKey = 'id';

    //3.允许批量操作的字段
    
    // public $fillable = ['username', 'nickname', 'password', 'email'];
    public $guarded = [];

    // 4.是否维护screate_time
    public $timestamps = false;
}
