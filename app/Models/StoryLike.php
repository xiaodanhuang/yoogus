<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\StoryLike
 *
 * @property integer $id
 * @property integer $story_id store 饰品故事的id
 * @property string $unionid
 * @property boolean $status 0:无效 1：点赞
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\StoryLike whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\StoryLike whereStoryId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\StoryLike whereUnionid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\StoryLike whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\StoryLike whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\StoryLike whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\StoryLike whereDeletedAt($value)
 * @mixin \Eloquent
 */
class StoryLike extends Model
{
    use SoftDeletes;
    /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'story_like';

    protected $dates = ['deleted_at'];

    /**
     * 可以被批量赋值的属性。
     *
     * @var array
     */
    protected $fillable = ['story_id', 'unionid'];


    public function story()
    {
        return $this->hasone('App\Models\Story', 'id', 'story_id');
    }
}
