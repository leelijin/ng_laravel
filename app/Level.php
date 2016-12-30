<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Level
 *
 * @property int $id
 * @property int $need_strength
 * @property int $question_number
 * @property int $time_limit
 * @property int $reward
 * @property int $challenge_times
 * @property bool $level_type 1为星级场，2为金币场
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Question[] $questions
 * @method static \Illuminate\Database\Query\Builder|\App\Level whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Level whereNeedStrength($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Level whereQuestionNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Level whereTimeLimit($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Level whereReward($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Level whereChallengeTimes($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Level whereLevelType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Level whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Level whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Level extends Model
{
    //
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
