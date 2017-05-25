<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Question
 *
 * @property int $id
 * @property int $level_id
 * @property bool $level_type 1为星级场，2为金币场
 * @property string $title 标题
 * @property string $content 描述
 * @property string $image1
 * @property string $image2
 * @property array $answer_options 问题选项
 * @property string $right_answer 正确答案
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Level $level
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Question whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Question whereLevelId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Question whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Question whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Question whereImage1($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Question whereImage2($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Question whereAnswerOptions($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Question whereRightAnswer($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Question whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Question whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $question 标题
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Question whereQuestion($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Question base()
 */
class Question extends Model
{
    protected $guarded=[];
    protected $hidden=['level_id','created_at','updated_at'];
    protected $casts=[
        'answer_options'=>'array',
    ];
    //
    public function level()
    {
        return $this->belongsTo(Level::class);
    }
    
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    
    public function scopeBase($query)
    {
        return $query->select();
    }
    
    public function getImage1Attribute()
    {
        return $this->attributes['image1']=pictureTransfer($this->attributes['image1']);
    }
    
    public function getImage2Attribute()
    {
        return $this->attributes['image2']=pictureTransfer($this->attributes['image2']);
    }
}
