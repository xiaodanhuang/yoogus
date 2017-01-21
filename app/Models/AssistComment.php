<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssistComment extends Model
{
    use SoftDeletes;
    /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'assist_comment';

    protected $dates = ['deleted_at'];

    protected $hidden = ['unionid', 'status', 'created_at', 'updated_at', 'deleted_at',];
}
