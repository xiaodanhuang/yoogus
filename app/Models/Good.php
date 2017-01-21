<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Good extends Model
{
    //
    use SoftDeletes;
    /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'goods';

    protected $dates = ['deleted_at'];

    protected $hidden = ['status','created_at', 'updated_at', 'deleted_at',];

    public function img(){
        return $this->hasMany('App\Models\Goodsimg','goods_id');
    }
}
