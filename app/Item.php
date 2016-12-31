<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //
    protected $casts=[
        'settins'=>'array',
    ];
    protected $hidden=['setting'];
    
    
}
