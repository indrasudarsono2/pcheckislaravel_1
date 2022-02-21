<?php

namespace App\Http\Middleware;

use Closure;

class CheckingRemark
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$remark)
    {
        if (in_array($request->user()->remark_id, $remark)) {
            return $next($request);
        }
        return redirect('/super')->with('alert', 'Access denied!!!');
    }
}
