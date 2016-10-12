<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\UsedCoupon
 *
 * @property integer $id
 * @property string $coupon
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\UsedCoupon whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UsedCoupon whereCoupon($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UsedCoupon whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UsedCoupon whereUpdatedAt($value)
 */
class UsedCoupon extends Model
{
    protected $table = 'used_coupons';

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
