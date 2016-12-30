<?php
/**
 * Created by PhpStorm.
 * User: 59431
 * Date: 2016/12/30
 * Time: 21:02
 */

namespace app\Repository;


use App\User;

class UserRepo
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    
    public function findUserProfile()
    {
        
    }
    
    
}