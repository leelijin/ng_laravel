<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
