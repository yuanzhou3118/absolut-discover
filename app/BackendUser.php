<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\BackendUser
 *
 * @property integer $id
 * @property string $account
 * @property string $pwd
 * @property boolean $status
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\BackendUser whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BackendUser whereAccount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BackendUser wherePwd($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BackendUser whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BackendUser whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BackendUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BackendUser whereUpdatedAt($value)
 */
class BackendUser extends Model
{
    protected $table = 'backend_users';

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
