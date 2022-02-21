<?php

namespace App\Http\Middleware;

use App\Score;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckingScoreUser
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
        $score = Score::where('id', $request->score->id)->first();

        if ($score->form_rating->aplication_file->user->id == Auth::id()) {
            return $next($request);
        }

        return redirect('/examinee')->with('alert', 'Access denied!!!');
    }
}
