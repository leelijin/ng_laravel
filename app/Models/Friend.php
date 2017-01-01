<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    protected $table='friend_requests';
    protected $guarded=[];
    
    public function scopeType($query,$type)
    {
        return $query->where('type',$type)
            ->orderBy('status','desc')
            ->orderBy('id','desc');
    }
    
    public function getMyHandleRequest($to_uid)
    {
        return $this->where('to_uid',$to_uid)->where('status',0)->type(1)->get();
    }
}
