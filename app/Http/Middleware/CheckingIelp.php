<?php

namespace App\Http\Middleware;

use App\Ielp;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckingIelp
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
        $ielp = Ielp::where('id', $request->ielp->id)->first();

        if ($ielp->user_id == Auth::id()) {
            return $next($request);
        }

        return redirect('/examinee')->with('alert', 'Access denied!!!');
    }
}
