<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAddr extends Model
{
    //
    use SoftDeletes;

    protected $table = 'user_addr';

    protected $dates = ['deleted_at'];

    protected $hidden = ['id','unionid','created_at', 'updated_at', 'deleted_at',];
}
