<?php

namespace App\Http\Middleware;

use App\Sertificate_owner;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckingCompetenceSertificate
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
        if ($request->competence_sertificate == null) {
            return $next($request);
        } else {
            $competence_sertificate = Sertificate_owner::where('id', $request->competence_sertificate->id)->first();

            if ($competence_sertificate->user_id == Auth::id()) {
                return $next($request);
            }
        }

        return redirect('/examinee')->with('alert', 'Access denied!!!');
    }
}
