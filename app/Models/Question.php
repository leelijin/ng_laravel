<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Question
 *
 * @property int $id
 * @property int $level_id
 * @property bool $level_type 1为星级场，2为金币场
 * @property string $title 标题
 * @property string $content 描述
 * @property string $image1
 * @property string $image2
 * @property string $answer_options 问题选项
 * @property string $right_answer 正确答案
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Level $level
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @method static \Illuminate\Database\Query\Builder|\App\Question whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Question whereLevelId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Question whereLevelType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Question whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Question whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Question whereImage1($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Question whereImage2($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Question whereAnswerOptions($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Question whereRightAnswer($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Question whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Question whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Question extends Model
{
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
}
