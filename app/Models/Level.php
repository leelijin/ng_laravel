<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Level
 *
 * @property int $id
 * @property int $need_strength
 * @property int $question_number
 * @property int $time_limit
 * @property int $reward
 * @property bool $level_type 1为星级场，2为金币场
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Question[] $questions
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Level whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Level whereNeedStrength($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Level whereQuestionNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Level whereTimeLimit($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Level whereReward($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Level whereLevelType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Level whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Level whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property bool $status 关卡状态 0为未开通，1为已开通
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Level whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Level star()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Level gold()
 */
class Level extends Model
{
    protected $guarded=[];
    public static function boot()
    {
        parent::boot();
        static::addGlobalScope('status',function(Builder $builder){
            $builder->where('status','>=',0);
        });
    }
    
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    
    public function scopeStar($query)
    {
        return $query->select('id','need_strength','question_number','time_limit','status','notice')->whereLevelType(1);
    }
    
    public function scopeGold($query)
    {
        return $query->select('id','need_strength','question_number','time_limit','reward','status','notice')->whereLevelType(2);
    }
    
    public function getQuestionNumberAttribute()
    {
        return $this->attributes['question_number']=Question::whereLevelId($this->attributes['id'])->count();
    }
}
