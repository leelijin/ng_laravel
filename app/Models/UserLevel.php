<?php
/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 2017/6/13
 * Time: 10:59
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class UserLevel extends Model
{
    protected $table='user_level';
    protected $guarded=[];
    public $timestamps=false;
}