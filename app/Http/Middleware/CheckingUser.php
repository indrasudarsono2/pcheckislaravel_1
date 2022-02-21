<?php

namespace App\Http\Middleware;

use App\UserModel;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckingUser
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
        $user = UserModel::where('id', $request->user->id)->first();

        if ($user->branch_id == Auth::user()->branch_id) {
            return $next($request);
        }

        return redirect('/super')->with('alert', 'Access denied!!!');
    }
}
