<?php
/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 2016/12/28
 * Time: 11:13
 */

namespace App\Http\Controllers\Api;

use App\Models\Friend;
use App\Http\Controllers\Controller;
use App\Models\Notice;
use App\Models\StartAd;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index()
    {
        $con = DB::table('friend_requests')->where('status',0)->inRandomOrder()->first();
        dd($con);
        return array_rand(['accept'=>1,'reject'=>2]);
    }
    
    public function startAd()
    {
        $info = StartAd::first();
        return apiSuccess($info);
    }
    
    public function notice()
    {
        $announce=Notice::first();
        $friend = new Friend();
        if($this->request->has('uid')){
            $friend_requests=$friend->getMyHandleRequest($this->params['uid']);
            $friend_strength=Friend::where('to_uid',$this->uid)->type(2)->get();
        }else{
            $friend_requests=$friend_strength=[];
        }
        
        return apiSuccess(compact('announce','friend_requests','friend_strength'));
    }
    
}