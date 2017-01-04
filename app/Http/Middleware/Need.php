<?php

namespace App\Http\Middleware;

use Closure;

class Need
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @param                           $param
     *
     * @return mixed
     */
    public function handle($request, Closure $next,$param)
    {
        if(!$request->has($param)){
            $message = $param == 'uid'?'需要登录':'需要参数:'.$param;
            return response()->json(['error_code'=>10,'message'=>$message,'data'=>[]]);
        }
        return $next($request);
    }
}
