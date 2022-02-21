<?php

namespace App\Http\Middleware;

use App\Education_owner;
use App\Formal_education;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckingFormalEducation
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
        if ($request->formal_education == null) {
            return $next($request);
        } else {
            $education_owner = Education_owner::where('id', $request->formal_education->id)->first();

            if ($education_owner->user_id == Auth::id()) {
                return $next($request);
            }
        }

        return redirect('/examinee')->with('alert', 'Access denied!!!');
    }
}
