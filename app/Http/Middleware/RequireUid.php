<?php

namespace App\Http\Middleware;

use App\Http\Service\Api;
use Closure;

class RequireUid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //if(!$request->has('uid')){
        //    return Api::apiError(10,'需要登录');
        //}
        return $next($request);
    }
}
