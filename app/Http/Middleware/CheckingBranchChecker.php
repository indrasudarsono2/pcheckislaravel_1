<?php

namespace App\Http\Middleware;

use App\Gain_rating;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckingBranchChecker
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
        $gain_rating = Gain_rating::where('id', $request->gain_rating->id)->first();

        if ($gain_rating->branch_id == Auth::user()->branch_id) {
            return $next($request);
        }

        return redirect('/super')->with('alert', 'Access denied!!!');
    }
}
