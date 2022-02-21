<?php

namespace App\Http\Controllers\examinee;

use App\Http\Controllers\Controller;
use App\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sessionss = Session::where('branch_id', Auth::user()->branch_id)->orderBy('id', 'desc')->get();

        return view('examinee.checker_menu.verSession', compact('sessionss'));
    }

    public function index_practice()
    {
        $sessionss = Session::where('branch_id', Auth::user()->branch_id)->orderBy('id', 'desc')->get();

        return view('examinee.checker_menu.verSessionPractice', compact('sessionss'));
    }

    public function index_getingRating()
    {
        $sessionss = Session::where('branch_id', Auth::user()->branch_id)->orderBy('id', 'desc')->get();

        return view('examinee.checker_menu.verSessionGetingRating', compact('sessionss'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function show(Session $session)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function edit(Session $session)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Session $session)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function destroy(Session $session)
    {
        //
    }
}
