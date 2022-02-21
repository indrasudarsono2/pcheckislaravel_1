<?php

namespace App\Http\Middleware;

use App\License;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckingLicense
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
        if ($request->license == null) {
            return $next($request);
        }
        $license = License::where('id', $request->license->id)->first();

        if ($license->user_id == Auth::id()) {
            return $next($request);
        }

        return redirect('/examinee')->with('alert', 'Access denied!!!');
    }
}
