<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    //
    use SoftDeletes;
    /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'order';

    protected $dates = ['deleted_at'];
}
