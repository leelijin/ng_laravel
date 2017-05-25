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
    protected $page;
    protected $limit;
    
    public function __construct(Request $request)
    {
        $this->request=$request;
        $this->params=$request->all();
        $this->uid=(int)($this->request->has('uid')?$this->params['uid']:0);
        $this->page = (int)($this->request->has('page')?$this->params['page']:1);
        $this->limit = (int)($this->request->has('limit')?$this->params['limit']:10);
        //$this->limit = 40;
    }
    
}
