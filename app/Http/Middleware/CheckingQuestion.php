<?php

namespace App\Http\Middleware;

use App\Mc_question;
use Closure;
use Illuminate\Support\Facades\Auth;


class CheckingQuestion
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
        $mc_question = Mc_question::where('id', $request->statistic->id)->first();

        if ($mc_question->aplication_rating->branch_id == Auth::user()->branch_id) {
            return $next($request);
        }

        return redirect('/super')->with('alert', 'Access denied!!!');
    }
}
