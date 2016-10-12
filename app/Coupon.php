<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Coupon
 *
 * @property integer $id
 * @property string $coupon
 * @property boolean $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Coupon whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Coupon whereCoupon($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Coupon whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Coupon whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Coupon whereUpdatedAt($value)
 */
class Coupon extends Model
{
    protected $table = 'coupons';

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
