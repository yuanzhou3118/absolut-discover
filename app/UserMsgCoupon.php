<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\UserMsgCoupon
 *
 * @property integer $id
 * @property string $openid
 * @property string $name
 * @property string $mobile
 * @property string $coupon
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\UserMsgCoupon whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserMsgCoupon whereOpenid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserMsgCoupon whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserMsgCoupon whereMobile($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserMsgCoupon whereCoupon($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserMsgCoupon whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserMsgCoupon whereUpdatedAt($value)
 */
class UserMsgCoupon extends Model
{
    protected $table = 'user_msg_coupons';

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
