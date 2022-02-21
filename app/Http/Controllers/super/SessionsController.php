<?php

namespace App\Http\Controllers\super;

use App\Aplication_file;
use App\Http\Controllers\Controller;
use App\Session;
use App\UserModel;
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
        $session = Session::where('branch_id', Auth::user()->branch_id)->orderBy('id', 'desc')->get();

        return view('super.preparing.session', compact('session'));
    }

    public function index_score()
    {
        $session = Session::where('branch_id', Auth::user()->branch_id)->orderBy('id', 'desc')->get();
        return view('super.score.session', compact('session'));
    }

    public function index_gain()
    {
        $session = Session::where('branch_id', Auth::user()->branch_id)->orderBy('id', 'desc')->get();
        return view('super.preparing.session_gain', compact('session'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('super.preparing.addSession');
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
            'year' => 'required',
            'period' => 'required'
        ]);

        Session::create([
            'year' => $request->year,
            'period' => $request->period,
            'text' => $request->text,
            'branch_id' => Auth::user()->branch_id
        ]);

        return redirect('sessions')->with('status', 'Session added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function show(Session $session)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function edit(Session $session)
    {
        return view('super.preparing.editSession', compact('session'));
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
        $request->validate([
            'year' => 'required',
            'period' => 'required'
        ]);

        Session::where('id', $request->session->id)
            ->update([
                'year' => $request->year,
                'period' => $request->period,
                'text' => $request->text
            ]);

        return redirect('sessions')->with('status', 'Session updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function destroy(Session $session)
    {
        Session::destroy('id', $session->id);
        return redirect('sessions')->with('status', 'Session deleted successfully');
    }

    public function user_session(UserModel $user)
    {
        $session = Session::with('Branch')->where('branch_id', Auth::user()->branch_id)->get();
        foreach ($session as $session) {
            $sess_id[] = $session->id;
        }

        $aplication_file = Aplication_file::with('Session', 'User')->where('user_id', $user->id)
            ->whereIn('session_id', $sess_id)->orderBy('id', 'desc')->get();

        return view('super.score.participant.aplication_file', compact('user', 'aplication_file'));
    }

    public function index_history()
    {
        $session = Session::where('branch_id', Auth::user()->branch_id)->orderBy('id', 'desc')->get();
        return view('super.history.session', compact('session'));
    }

    public function index_monitor()
    {
        $session = Session::where('branch_id', Auth::user()->branch_id)->orderBy('id', 'desc')->get();
        return view('super.monitor.session', compact('session'));
    }

    public function index_statistic()
    {
        $session = Session::where('branch_id', Auth::user()->branch_id)->orderBy('id', 'desc')->get();
        return view('super.statistic.session', compact('session'));
    }
}
