<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Goodsimg extends Model
{
    //
    use SoftDeletes;
    /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'goods_img';

    protected $dates = ['deleted_at'];

    protected $fillable = ['goods_id', 'url', 'infor','status'];

    protected $hidden = ['id','goods_id','status','created_at', 'updated_at', 'deleted_at',];

}
