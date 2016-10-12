<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\UserStyle
 *
 * @property integer $id
 * @property string $openid
 * @property string $style_type
 * @property string $style_name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\UserStyle whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserStyle whereOpenid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserStyle whereStyleType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserStyle whereStyleName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserStyle whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserStyle whereUpdatedAt($value)
 */
class UserStyle extends Model
{
    protected $table = 'user_styles';

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
