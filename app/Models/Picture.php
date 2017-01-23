<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $table='picture';
    
    public static function getPath($id)
    {
        return self::whereId($id)->value('path');
    }
}
