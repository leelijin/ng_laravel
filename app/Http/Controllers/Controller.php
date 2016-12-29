<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Input;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    protected $request;
    protected $params;
    protected $uid;
    
    public function __construct(Request $request)
    {
        $this->request=$request;
        $this->params=$request->all();
        $this->uid=(int)($this->request->has('uid')?$this->params['uid']:0);
    }
    
}
