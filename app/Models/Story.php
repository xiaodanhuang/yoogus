<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Story
 *
 * @property integer $id
 * @property string $unionid
 * @property string $title
 * @property string $content 饰品故事的文字描述
 * @property integer $num_comment 评论的条数
 * @property integer $num_like 点赞的条数
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Story whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Story whereUnionid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Story whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Story whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Story whereNumComment($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Story whereNumLike($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Story whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Story whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Story whereDeletedAt($value)
 * @mixin \Eloquent
 */
class Story extends Model
{
    use SoftDeletes;
    /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'story';

    protected $dates = ['deleted_at'];

    protected $hidden = ['id', 'unionid', 'status', 'created_at', 'updated_at', 'deleted_at',];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'unionid', 'unionid');
    }
}
