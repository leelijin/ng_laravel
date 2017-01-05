<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\LevelSetting
 *
 * @property int $id
 * @property int $level_id
 * @property string $setting
 * @method static \Illuminate\Database\Query\Builder|\App\Models\LevelSetting whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\LevelSetting whereLevelId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\LevelSetting whereSetting($value)
 * @mixin \Eloquent
 */
class LevelSetting extends Model
{
    protected $table='level_setting';
    
    
}
