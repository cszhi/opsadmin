<?php

namespace App\Http\Middleware;
use Illuminate\Http\Request;
use Closure;

class OperationLog
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle(Request $request, \Closure $next)
    {
        if( ! $request->is('*/ajaxIndex')  && ! $request->is('_debugbar/*') ) {
            if(\Auth::check()){
                $user = \Auth::user()->id;
            } else {
                $user = 0;
            }
            $log = [
                'user_id' => $user,
                'path'    => $request->path(),
                'method'  => $request->method(),
                'ip'      => $request->getClientIp(),
                'input'   => json_encode($request->except('password')),
            ];

            \App\Models\Operation_log::create($log);
        }

        return $next($request);
    }
}
