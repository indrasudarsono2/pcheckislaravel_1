<?php

namespace App\Http\Middleware;

use App\Group_member;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckingBranchGM
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
        $group_member = Group_member::where('id', $request->group_member->id)->first();

        if ($group_member == null) {
            return $next($request);
        }
        if ($group_member->user->branch_id == Auth::user()->branch_id) {
            return $next($request);
        }

        return redirect('/super')->with('alert', 'Access denied!!!');
    }
}
