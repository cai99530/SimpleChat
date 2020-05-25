<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    //
    //    1. 关联的数据表
    public $table = 'content';

//    2. 主键
    public $primaryKey = 'cont_id';

//    3. 允许批量操作的字段

    //   public $fillable = ['user_name','user_pass','email','phone'];
    public $guarded = [];

//    4. 是否维护crated_at 和 updated_at字段

    public $timestamps = false;

    public function user(){
        return $this->belongsTo('\App\Model\User','user_id','cont_id');
    }


}
