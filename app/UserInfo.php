<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\UserInfo
 *
 * @property integer $id
 * @property string $openid
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\UserInfo whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserInfo whereOpenid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserInfo whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserInfo whereUpdatedAt($value)
 */
class UserInfo extends Model
{
    protected $table = 'user_infos';

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
