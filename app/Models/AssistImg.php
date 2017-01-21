<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\AssistImg
 *
 * @property integer $id
 * @property integer $assist_id assist寻饰启事的id
 * @property string $url 图片的相对目录
 * @property boolean $status 0:被屏蔽 1：正常显示
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AssistImg whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AssistImg whereAssistId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AssistImg whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AssistImg whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AssistImg whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AssistImg whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AssistImg whereDeletedAt($value)
 * @mixin \Eloquent
 */
class AssistImg extends Model
{
    use SoftDeletes;
    /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'assist_img';

    protected $dates = ['deleted_at'];

    /**
     * 访问器被附加到模型数组的形式。
     *
     * @var array
     */
    protected $appends = ['url'];

    /**
     * 可以被批量赋值的属性。
     *
     * @var array
     */
    protected $fillable = ['assist_id', 'url', 'status'];

    /**
     * level 字段格式化
     *
     * @param $value
     * @return string
     */
    public function getUrlAttribute()
    {
        $reply = env('QINIU') . ($this->attributes['url']);
        return $reply;
    }
}
