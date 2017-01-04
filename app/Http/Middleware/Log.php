<?php

namespace App\Http\Middleware;

use Closure;

class Log
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
        return $next($request);
    }
    
    public function terminate($request,$response)
    {
        //记录全局日志
        \App\Models\Log::insertLog($request,$response);
    }
}
