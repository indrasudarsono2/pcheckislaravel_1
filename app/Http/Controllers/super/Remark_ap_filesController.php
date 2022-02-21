<?php

namespace App\Http\Controllers\super;

use App\Activity;
use App\Aplication_file;
use App\Http\Controllers\Controller;
use App\Remark_ap_file;
use App\Session;
use Illuminate\Http\Request;

class Remark_ap_filesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Session $session, Activity $activity)
    {
        $remark_ap_file = Remark_ap_file::all();
        return view('super/score/remark_ap_file', compact('session', 'activity', 'remark_ap_file'));
    }

    public function index_session(Session $session)
    {
        $remark_ap_file = Remark_ap_file::all();
        return view('super.monitor.remark_ap_file', compact('session', 'remark_ap_file'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Session $session)
    {
        $remark_ap_file = Remark_ap_file::all();
        return view('super.history.remark_ap_file', compact('session', 'remark_ap_file'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Remark_ap_file  $remark_ap_file
     * @return \Illuminate\Http\Response
     */
    public function show(Remark_ap_file $remark_ap_file)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Remark_ap_file  $remark_ap_file
     * @return \Illuminate\Http\Response
     */
    public function edit(Remark_ap_file $remark_ap_file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Remark_ap_file  $remark_ap_file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Remark_ap_file $remark_ap_file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Remark_ap_file  $remark_ap_file
     * @return \Illuminate\Http\Response
     */
    public function destroy(Remark_ap_file $remark_ap_file)
    {
        //
    }
}
