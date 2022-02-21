<?php

namespace App\Http\Middleware;

use App\Aplication_file;
use App\Session;
use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckingAplication_file
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
        if (Auth::user()->branch_id == 1) {
            $now = Carbon::now();
            $exception = [];

            if ($now > "2021-11-04 23:59:59") {
                $session = Session::where('branch_id', Auth::user()->branch_id)->orderBy('id', 'desc')->first();
                $aplication_file = Aplication_file::where('user_id', Auth::id())->where('session_id', $session->id)
                    ->where('remark_ap_file_id', 2)->get();
                if ($aplication_file->isEmpty()) {
                    for ($i = 0; $i < count($exception); $i++) {
                        if (Auth::id() == $exception[$i]) {
                            return $next($request);
                            break;
                        }
                    }
                    return redirect('/examinee')->with('alert', 'Time is up !!!');
                } else {
                    return $next($request);
                }
            } else {
                return $next($request);
            }
        } else {
            return $next($request);
        }
    }
}
