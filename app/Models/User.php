<?php

namespace App\Models;

use App\Repository\UserRepo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * App\Models\User
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
 * @property string $uuid
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Question[] $questions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Item[] $items
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereNickname($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereMobile($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereAvatar($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereRank($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereGold($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereStar($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereStrength($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereCurrentStarLevel($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereCurrentGoldLevel($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User base()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User simple()
 * @mixin \Eloquent
 * @property bool $status
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User topStar($limit = 10)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User topGold($limit = 10)
 */
class User extends Model
{
    use SoftDeletes;
    
    protected $hidden=['password','deleted_at'];
    protected $fillable=['nickname','mobile','password','avatar','token','uuid','status','login_type'];
    protected $appends=['rank_num'];
    public static function boot()
    {
        parent::boot();
        static::addGlobalScope('status',function(Builder $builder){
            $builder->whereStatus(1);
        });
    }
    
    public function questions()
    {
        return $this->belongsToMany(Question::class);
    }
    
    public function items()
    {
        return $this->belongsToMany(Item::class);
    }
    
    
    public function setTokenAttribute()
    {
        $this->attributes['token'] = str_random(20);
    }
    
    public function getAvatarAttribute()
    {
        return $this->attributes['avatar']=pictureTransfer($this->attributes['avatar']);
    }
    
    public function getRankNumAttribute()
    {
        return $this->attributes['rank_num']=UserRepo::getUserRankNum($this->attributes['uid']);
    }
    public function getLoginTypeAttribute()
    {
        return $this->attributes['login_type']?:'phone';
    }
    
    public function getWrongPayAttribute()
    {
        if($this->attributes['wrong_pay'] !=1){
            $checkHaveEnoughFriends = DB::table('friend_requests')->where(function($query){
                    $query->where('from_uid',$this->attributes['id'])
                        ->orWhere('to_uid',$this->attributes['id']);
                })->whereType(1)->whereStatus(1)->count() >=5;
            return $checkHaveEnoughFriends ? 1 : 0;
        }
        return 1;
    }
    
    public function scopeBase($query)
    {
        return $query->select('id','id as uid','nickname','mobile','avatar','current_gold_level','current_star_level','rank','wrong_pay','mood','token');
    }
    
    public function scopeSimple($query)
    {
        return $query->select('id as uid','nickname','avatar','rank','login_type');
    }
    
    public function scopeTop($query,$limit=10)
    {
        return $query->orderBy('rank','desc')->orderBy('id')->select('id as uid','nickname','avatar','rank')->take($limit);
    }
    
    //public function scopeTopGold($query,$limit=10)
    //{
    //    return $query->orderBy('current_gold_level','desc')->select('id as uid','nickname','avatar','current_gold_level','rank')->take($limit);
    //}
    
    

}
