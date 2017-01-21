<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\User
 *
 * @mixin \Eloquent
 * @property integer $id
 * @property string $unionid
 * @property string $openid
 * @property boolean $type 默认普通用户为1 预留字段
 * @property string $nickname 用户的微信昵称
 * @property boolean $sex 性别 1：男 2：女
 * @property string $language 用户的默认语言
 * @property string $city 用户所属城市
 * @property string $province 所属省份
 * @property string $country 国籍
 * @property string $headimgurl 用户头像的url 七牛上的全目录
 * @property \Carbon\Carbon $created_at 创建时间
 * @property \Carbon\Carbon $updated_at 更新时间
 * @property boolean $status 状态 1：正常 0：不正常
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereUnionid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereOpenid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereNickname($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereSex($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereLanguage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereCity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereProvince($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereCountry($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereHeadimgurl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereStatus($value)
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereDeletedAt($value)
 */
class User extends Model
{
    /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'user';
}
