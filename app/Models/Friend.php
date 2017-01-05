<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Friend
 *
 * @property int $id
 * @property int $from_uid 发起者uid
 * @property int $to_uid 接收者uid
 * @property bool $type 类型，1为好友请求，2为体力请求
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property bool $status
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Friend whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Friend whereFromUid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Friend whereToUid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Friend whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Friend whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Friend whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Friend whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Friend type($type)
 * @mixin \Eloquent
 */
class Friend extends Model
{
    protected $table='friend_requests';
    protected $guarded=[];
    
    public function scopeType($query,$type)
    {
        return $query->whereType($type)
            ->orderBy('status','desc')
            ->orderBy('id','desc');
    }
    
    
    
}
