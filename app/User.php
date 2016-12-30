<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\User
 *
 * @property int $id
 * @property string $nickname
 * @property string $mobile
 * @property string $password
 * @property string $avatar
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $rank 等级
 * @property int $gold 金币
 * @property int $star 星级
 * @property int $strength 体力
 * @property int $current_star_level 当前星级场关卡
 * @property int $current_gold_level 当前金币场关卡
 * @property string $token
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Question[] $questions
 * @method static \Illuminate\Database\Query\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereNickname($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereMobile($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereAvatar($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRank($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereGold($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereStar($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereStrength($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCurrentStarLevel($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCurrentGoldLevel($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereToken($value)
 * @mixin \Eloquent
 */
class User extends Model
{
    use SoftDeletes;
    
    protected $guarded=[];
    
    public function questions()
    {
        return $this->belongsToMany(Question::class);
    }
    
    public function setTokenAttribute()
    {
        return str_random(20);
    }
}
