<?php

namespace App\Http\Middleware;

use App\Form_rating;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckingBranchFR
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
        $form_rating = Form_rating::where('id', $request->form_rating->id)->first();

        if ($form_rating == null) {
            return $next($request);
        }
        if ($form_rating->aplication_file->user->branch_id == Auth::user()->branch_id) {
            return $next($request);
        }

        return redirect('/super')->with('alert', 'Access denied!!!');
    }
}
