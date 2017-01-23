<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\StartAd
 *
 * @property int $id
 * @property string $title
 * @property string $cover
 * @property int $second
 * @property string $link
 * @method static \Illuminate\Database\Query\Builder|\App\Models\StartAd whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\StartAd whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\StartAd whereCover($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\StartAd whereSecond($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\StartAd whereLink($value)
 * @mixin \Eloquent
 */
class StartAd extends Model
{
    protected $table='start_ad';
    
    public function getCoverAttribute()
    {
        return $this->attributes['cover']=pictureTransfer($this->attributes['cover']);
    }
}
