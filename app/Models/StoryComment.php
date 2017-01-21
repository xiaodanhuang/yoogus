<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\StoryComment
 *
 * @property integer $id
 * @property integer $story_id story 饰品故事的id
 * @property string $unionid
 * @property string $content 用户对饰品故事的评论
 * @property boolean $status 0:无效、被屏蔽 1：正常
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\StoryComment whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\StoryComment whereStoryId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\StoryComment whereUnionid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\StoryComment whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\StoryComment whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\StoryComment whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\StoryComment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\StoryComment whereDeletedAt($value)
 * @mixin \Eloquent
 */
class StoryComment extends Model
{
    use SoftDeletes;
    /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'story_comment';

    protected $dates = ['deleted_at'];

    protected $hidden = ['unionid', 'status', 'created_at', 'updated_at', 'deleted_at',];
}
