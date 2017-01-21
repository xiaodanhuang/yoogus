<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoodComment extends Model
{
    //
    use SoftDeletes;
    protected $table = 'goods_comment';

    protected $dates = ['deleted_at'];

    protected $hidden = ['unionid', 'status', 'created_at', 'updated_at', 'deleted_at',];
}
