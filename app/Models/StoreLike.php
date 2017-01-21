<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreLike extends Model
{
    //
    use SoftDeletes;
    /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'store_like';

    protected $dates = ['deleted_at'];
    public function store()
    {
        return $this->hasone('App\Models\Store', 'id', 'store_id');
    }
}
