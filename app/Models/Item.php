<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Item
 *
 * @property int $id
 * @property string $title 道具名称
 * @property int $need_gold 需要金币
 * @property string $setting 道具效果设置
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Item whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Item whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Item whereNeedGold($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Item whereSetting($value)
 * @mixin \Eloquent
 */
class Item extends Model
{
    //
    protected $casts=[
        'settins'=>'array',
    ];
    protected $hidden=['setting'];
    
    
}
