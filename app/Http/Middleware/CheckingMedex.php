<?php

namespace App\Http\Middleware;

use App\Medex;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckingMedex
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
        $medex = Medex::where('id', $request->medex->id)->first();

        if ($medex->user_id == Auth::id()) {
            return $next($request);
        }

        return redirect('/examinee')->with('alert', 'Access denied!!!');
    }
}
