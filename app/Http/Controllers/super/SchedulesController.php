<?php

namespace App\Http\Controllers\super;

use App\Http\Controllers\Controller;
use App\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SchedulesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedule =  Schedule::where('branch_id', Auth::user()->branch_id)->get();
        // return $schedule;
        return view('super.preparing.schedule', compact('schedule'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('super.preparing.scheduleAdd');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'schedule_start' => 'required',
            'schedule_finish' => 'required'
        ]);

        $schedule_for_finish = date('Y-m-d', strtotime('+1 days', strtotime($request->schedule_finish)));

        Schedule::create([
            'branch_id' => Auth::user()->branch_id,
            'schedule_start' => $request->schedule_start,
            'schedule_finish' => $request->schedule_finish,
            'schedule_for_finish' => $schedule_for_finish,
        ]);

        return redirect()->route('schedules.index')->with('status', 'Schedule added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        return view('super.preparing.scheduleEdit', compact('schedule'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        $request->validate([
            'schedule_start' => 'required',
            'schedule_finish' => 'required'
        ]);

        $schedule_for_finish = date('Y-m-d', strtotime('+1 days', strtotime($request->schedule_finish)));

        Schedule::where('id', $schedule->id)
            ->update([
                'schedule_start' => $request->schedule_start,
                'schedule_finish' => $request->schedule_finish,
                'schedule_for_finish' => $schedule_for_finish,
            ]);

        return redirect()->route('schedules.index')->with('status', 'Schedule edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        //
    }
}
