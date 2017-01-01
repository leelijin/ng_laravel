<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Notice
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $link
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read mixed $create_time
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Notice whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Notice whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Notice whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Notice whereLink($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Notice whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Notice whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Notice extends Model
{
    protected $table='notice';
    protected $hidden=['updated_at'];
    protected $appends=['create_time'];
    
    public function getCreateTimeAttribute()
    {
        return $this->attributes['create_time']=strtotime($this->attributes['created_at']);
        
    }
}
