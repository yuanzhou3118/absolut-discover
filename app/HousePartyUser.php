<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 * App\HousePartyUser
 *
 * @property integer $id
 * @property string $openid
 * @property string $city
 * @property integer $mobile
 * @property string $username
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\HousePartyUser whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\HousePartyUser whereOpenid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\HousePartyUser whereCity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\HousePartyUser whereMobile($value)
 * @method static \Illuminate\Database\Query\Builder|\App\HousePartyUser whereUsername($value)
 * @method static \Illuminate\Database\Query\Builder|\App\HousePartyUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\HousePartyUser whereUpdatedAt($value)
 * @property string $birthday
 * @property string $party_name
 * @method static \Illuminate\Database\Query\Builder|\App\HousePartyUser whereBirthday($value)
 * @method static \Illuminate\Database\Query\Builder|\App\HousePartyUser wherePartyName($value)
 * @property string $theme
 * @method static \Illuminate\Database\Query\Builder|\App\HousePartyUser whereTheme($value)
 * @property string $utm_source
 * @property string $utm_medium
 * @method static \Illuminate\Database\Query\Builder|\App\HousePartyUser whereUtmSource($value)
 * @method static \Illuminate\Database\Query\Builder|\App\HousePartyUser whereUtmMedium($value)
 */

class HousePartyUser extends Model
{
    protected $table = 'house_party_users';

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
