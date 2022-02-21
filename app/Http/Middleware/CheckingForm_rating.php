<?php

namespace App\Http\Middleware;

use App\Form_rating;
use App\Schedule;
use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckingForm_rating
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
        $form_r = Form_rating::where('id', $request->form_rating->id)->first();
        $schedule = Schedule::where('branch_id', $form_r->aplication_file->user->branch_id)->first();
        $exception = [896, 1264, 1348];
        if ($schedule == null) {
            return redirect('/examinee')->with('alert', 'Examination hasn`t been started yet!');
        }
        $now = Carbon::now();

        if ($now < $schedule->schedule_start) {
            return redirect('/examinee')->with('alert', 'Examination hasn`t been started yet!');
        } else if ($now < $schedule->schedule_for_finish) {
            if ($form_r->aplication_file->user_id == Auth::id()) {
                return $next($request);
            }
        } else {
            for ($i = 0; $i < count($exception); $i++) {
                if (Auth::id() == $exception[$i]) {
                    return $next($request);
                    break;
                }
            }
            return redirect('/examinee')->with('alert', 'Time is up !!!');
        }
    }
}
