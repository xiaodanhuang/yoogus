<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Help
 *
 * @mixin \Eloquent
 * @property integer $id
 * @property string $unionid
 * @property string $content 寻饰启事的文字描述
 * @property boolean $level 紧急等级 1：A 2：B
 * @property integer $num_comment 评论的条数
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Assist whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Assist whereUnionid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Assist whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Assist whereLevel($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Assist whereNumComment($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Assist whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Assist whereUpdatedAt($value)
 * @property boolean $status 1:正常 2：被屏蔽
 * @property \Carbon\Carbon $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Assist whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Assist whereDeletedAt($value)
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AssistImg[] $img
 */
class Assist extends Model
{
    use SoftDeletes;
    /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'assist';

    protected $dates = ['deleted_at'];

    protected $hidden = ['id', 'unionid', 'status', 'created_at', 'updated_at', 'deleted_at',];

    /**
     * 访问器被附加到模型数组的形式。
     *
     * @var array
     */
    protected $appends = ['level'];

    /**
     * level 字段格式化
     *
     * @param $value
     * @return string
     */
    public function getLevelAttribute()
    {
        $reply = $this->levelToStr($this->attributes['level']);
        return $reply;
    }

    /**
     * 紧急程度改成 字母
     *
     * @param $value
     * @return string
     */
    private function levelToStr($value)
    {
        switch ($value) {
            case 1:
                $reply = 'A';
                break;
            case '2':
                $reply = 'B';
                break;
            case '3':
                $reply = 'C';
                break;
            case '4':
                $reply = 'D';
                break;
            default:
                $reply = 'E';
        }
        return $reply;
    }

    /**
     * 获取与用户信息
     *
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'unionid', 'unionid');
    }

    /**
     * 获取图片集
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function img()
    {
        return $this->hasMany('App\Models\AssistImg', 'assist_id', 'id');
    }
}
