<?php

namespace App\Http\Middleware;

use App\Aplication_file;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckingAplication_files
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
        $af = Aplication_file::where('id', $request->aplication_file->id)->first();

        if ($af->user_id == Auth::id()) {
            return $next($request);
        }

        return redirect('/examinee')->with('alert', 'Access denied!!!');
    }
}
