<?php

namespace App\Http\Controllers\super;

use App\Gain_rating;
use App\Http\Controllers\Controller;
use App\Session;
use App\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;
use App\Checker_gain;

class Gain_ratingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Session $session)
    {
        $gain_rating = Gain_rating::where('branch_id', Auth::user()->branch_id)
            ->where('session_id', $session->id)->orderBy('id', 'desc')->get();
        return view('super/preparing/gaining_rating', compact('session', 'gain_rating'));
    }

    public function table(Session $session)
    {
        $gain_rating = Gain_rating::where('session_id', $session->id)->get();
        foreach ($gain_rating as $gain_rating) {
            $gain_id[] = $gain_rating->id;
            $gain_name[] = $gain_rating->user->name;
        }

        for ($i = 0; $i < count($gain_id); $i++) {
            $checker_gain[] = Checker_gain::with('user')->where('gain_rating_id', $gain_id[$i])->get();
        }

        $ceil = ceil(count($gain_name) / 5);
        $count = count($gain_name);

        return view('super.preparing.gainTable', compact('session', 'checker_gain', 'gain_name', 'ceil', 'count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Session $session)
    {
        $all_user = UserModel::where('branch_id', Auth::user()->branch_id)->orderBy('name', 'asc')->get();
        $examinee = $all_user->whereIn('remark_id', [3, 4]);

        return view('super/preparing/gaining_ratingAdd', compact('session', 'examinee'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Session $session)
    {
        $request->validate([
            'examinee' => 'required'
        ]);

        Gain_rating::create([
            'user_id' => $request->examinee,
            'branch_id' => Auth::user()->branch_id,
            'session_id' => $session->id
        ]);

        return redirect()->route('sessions.gain_ratingss.index', $session)->with('status', 'Examinee added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gain_rating  $gain_rating
     * @return \Illuminate\Http\Response
     */
    public function show(Gain_rating $gain_rating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gain_rating  $gain_rating
     * @return \Illuminate\Http\Response
     */
    public function edit(Session $session, Gain_rating $gain_rating)
    {
        $all_user = UserModel::where('branch_id', Auth::user()->branch_id)->orderBy('name', 'asc')->get();
        $examinee = $all_user->whereIn('remark_id', [3, 4])->whereNotIn('id', $gain_rating->user_id);

        return view('super/preparing/gaining_ratingEdit', compact('session', 'gain_rating', 'examinee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gain_rating  $gain_rating
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Session $session, Gain_rating $gain_rating)
    {
        $request->validate([
            'examinee' => 'required'
        ]);

        Gain_rating::where('id', $gain_rating->id)
            ->update([
                'user_id' => $request->examinee,
            ]);

        return redirect()->route('sessions.gain_ratingss.index', $session)->with('status', 'Examinee Edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gain_rating  $gain_rating
     * @return \Illuminate\Http\Response
     */
    public function destroy(Session $session, Gain_rating $gain_rating)
    {
        Gain_rating::destroy($gain_rating->id);
        return redirect()->route('sessions.gain_ratingss.index', $session)->with('status', 'Examinee deleted successfully');
    }

    public function print(Session $session)
    {
        $gain_rating = Gain_rating::where('session_id', $session->id)->get();
        foreach ($gain_rating as $gain_rating) {
            $gain_id[] = $gain_rating->id;
            $gain_name[] = $gain_rating->user->name;
        }

        for ($i = 0; $i < count($gain_id); $i++) {
            $checker_gain[] = Checker_gain::with('user')->where('gain_rating_id', $gain_id[$i])->get();
        }

        $ceil = ceil(count($gain_name) / 4);
        $count = count($gain_name);

        $pdf = PDF::loadview('super.print.gainTable', compact(
            'checker_gain',
            'gain_name',
            'ceil',
            'count'
        ))->setPaper('A4', 'Landscape');

        return $pdf->stream('printGain' . $session->year . '-' . $session->period . '.pdf');
    }
}
