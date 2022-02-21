<?php

namespace App\Http\Middleware;

use App\Session;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckingSession
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
        $session = Session::where('id', $request->session->id)->first();

        if ($session->branch_id == Auth::user()->branch_id) {
            return $next($request);
        }

        return redirect('/super')->with('alert', 'Access denied!!!');
    }
}
