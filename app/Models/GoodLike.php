<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoodLike extends Model
{
    //
    use SoftDeletes;
    /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'goods_like';

    protected $dates = ['deleted_at'];
    protected $fillable = ['goods_id','unionid'];
    public function goods()
    {
        return $this->hasone('App\Models\Good', 'id', 'goods_id');
    }


}
