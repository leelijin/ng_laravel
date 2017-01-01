<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\StartAd
 *
 * @property int $id
 * @property string $title
 * @property string $cover
 * @property int $second
 * @property string $link
 * @method static \Illuminate\Database\Query\Builder|\App\StartAd whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\StartAd whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\StartAd whereCover($value)
 * @method static \Illuminate\Database\Query\Builder|\App\StartAd whereSecond($value)
 * @method static \Illuminate\Database\Query\Builder|\App\StartAd whereLink($value)
 * @mixin \Eloquent
 */
class StartAd extends Model
{
    protected $table='start_ad';
}
