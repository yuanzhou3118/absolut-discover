<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\UserMsgNoCoupon
 *
 * @property integer $id
 * @property string $openid
 * @property string $name
 * @property string $mobile
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\UserMsgNoCoupon whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserMsgNoCoupon whereOpenid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserMsgNoCoupon whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserMsgNoCoupon whereMobile($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserMsgNoCoupon whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserMsgNoCoupon whereUpdatedAt($value)
 */
class UserMsgNoCoupon extends Model
{
    protected $table = 'user_msg_no_coupons';

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
