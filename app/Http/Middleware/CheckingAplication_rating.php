<?php

namespace App\Http\Middleware;

use App\Aplication_rating;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckingAplication_rating
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
        $aplication_rating = Aplication_rating::where('id', $request->aplication_rating->id)->first();

        if ($aplication_rating->branch_id == Auth::user()->branch_id) {
            return $next($request);
        }

        return redirect('/super')->with('alert', 'Access denied!!!');
    }
}
