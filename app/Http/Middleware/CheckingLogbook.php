<?php

namespace App\Http\Middleware;

use App\Log_book;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckingLogbook
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
        if ($request->logbook == null) {
            return $next($request);
        }
        $logbook = Log_book::where('id', $request->logbook->id)->first();

        if ($logbook->user_id == Auth::id()) {
            return $next($request);
        }

        return redirect('/examinee')->with('alert', 'Access denied!!!');
    }
}
