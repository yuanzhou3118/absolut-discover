<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\UserSubject
 *
 * @property integer $id
 * @property string $openid
 * @property string $subject
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\UserSubject whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserSubject whereOpenid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserSubject whereSubject($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserSubject whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserSubject whereUpdatedAt($value)
 */
class UserSubject extends Model
{
    protected $table = 'user_subjects';

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
