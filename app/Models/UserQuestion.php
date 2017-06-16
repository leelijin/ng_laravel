<?php
/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 2017/6/13
 * Time: 10:59
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class UserQuestion extends Model
{
    protected $table='user_question';
    protected $guarded=[];
    public $timestamps=false;
}