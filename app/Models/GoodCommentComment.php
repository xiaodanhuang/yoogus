<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class GoodCommentComment extends Model
{
    //
    use SoftDeletes;
    protected $table = 'goods_comment_comment';

    protected $dates = ['deleted_at'];

    protected $hidden = ['updated_at', 'deleted_at',];
}
