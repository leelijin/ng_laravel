<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionWrong extends Model
{
    protected $guarded=[];
    protected $hidden=['uid','created_at','updated_at'];
    protected $appends=['question'];
    
    public function getQuestionAttribute()
    {
        return $this->attributes['question']=Question::whereId($this->attributes['question_id'])->value('question');
    }
}
