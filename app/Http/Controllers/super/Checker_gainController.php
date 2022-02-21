<?php

namespace App\Http\Controllers\super;

use App\Aplication_file;
use App\Checker_gain;
use App\Form_rating;
use App\Gain_rating;
use App\Http\Controllers\Controller;
use App\Practical_exam;
use App\Session;
use App\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Checker_gainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Session $session, Gain_rating $gain_rating)
    {
        $checker_gain = Checker_gain::with('user')->where('gain_rating_id', $gain_rating->id)->get();
        // $practical_exam = Practical_exam::where('checker_gain_id', $checker_gain->id)
        //     ->where('score', '!=', null)->get();
        return view('super/preparing/checker_gain', compact('session', 'gain_rating', 'checker_gain'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Session $session, Gain_rating $gain_rating)
    {
        $checker_gain = Checker_gain::where('gain_rating_id', $gain_rating->id)->get();
        $checker_gain1 = Checker_gain::all();

        $all_user = UserModel::where('branch_id', Auth::user()->branch_id)->where('id', '!=', $gain_rating->user_id)->orderBy('name', 'asc')->get();
        if ($checker_gain1->isEmpty()) {
            $checker = $all_user->whereIn('remark_id', [4])->all();
        } else {
            if ($checker_gain->isEmpty()) {
                foreach ($checker_gain1 as $checker_gain1) {
                    $cg[] = $checker_gain1->user_id;
                }
                $checker = $all_user->whereIn('remark_id', [4])->all();
            } else {
                foreach ($checker_gain as $checker_gain) {
                    $c_gain[] = $checker_gain->user_id;
                }
                $checker = $all_user->whereIn('remark_id', [4])->whereNotIn('id', $c_gain)->all();
            }
        }
        return view('super/preparing/checker_gainAdd', compact('session', 'gain_rating', 'checker'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Session $session, Gain_rating $gain_rating, Request $request)
    {
        $request->validate([
            'checker' => 'required'
        ]);

        $aplication_file = Aplication_file::where('user_id', $gain_rating->user_id)
            ->where('remark_ap_file_id', 1)
            ->where('session_id', $session->id)
            ->orderBy('id', 'desc')->first();

        if ($aplication_file == null) {
            Checker_gain::create([
                'user_id' => $request->checker,
                'gain_rating_id' => $gain_rating->id,
            ]);
        } else {
            Checker_gain::create([
                'user_id' => $request->checker,
                'gain_rating_id' => $gain_rating->id,
            ]);
            $checker_gain = Checker_gain::where('gain_rating_id', $gain_rating->id)->where('user_id', $request->checker)->first();
            $form_rating = Form_rating::where('aplication_file_id', $aplication_file->id)->get();
            foreach ($form_rating as $form_rating) {
                $fr_id[] = $form_rating->id;
            }
            $count = count($fr_id);
            for ($i = 0; $i < $count; $i++) {
                Practical_exam::create([
                    'form_rating_id' => $fr_id[$i],
                    'checker_id' => $request->checker,
                    'checker_gain_id' => $checker_gain->id
                ]);
            }
        }
        return redirect()->route('sessions.gain_ratings.checker_gains.index', [$session, $gain_rating])->with('status', 'Checker added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Checker_gain  $checker_gain
     * @return \Illuminate\Http\Response
     */
    public function show(Checker_gain $checker_gain)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Checker_gain  $checker_gain
     * @return \Illuminate\Http\Response
     */
    public function edit(Session $session, Gain_rating $gain_rating, Checker_gain $checker_gain)
    {
        $checker_gain = Checker_gain::where('id', $checker_gain->id)->get();
        foreach ($checker_gain as $checker_gain) {
            $checker_id[] = $checker_gain->user_id;
        }

        $all_checker = UserModel::where('branch_id', Auth::user()->branch_id)
            ->where('remark_id', 4)
            ->orderBy('name', 'asc')->get();

        $checker = $all_checker->whereNotIn('id', $checker_id)->all();

        return view('super/preparing/checker_gainEdit', compact('session', 'gain_rating', 'checker', 'checker_gain'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Checker_gain  $checker_gain
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Session $session, Gain_rating $gain_rating, Checker_gain $checker_gain)
    {
        $request->validate([
            'checker' => 'required'
        ]);

        $aplication_file = Aplication_file::where('user_id', $gain_rating->user_id)
            ->where('remark_ap_file_id', 1)
            ->where('session_id', $session->id)
            ->orderBy('id', 'desc')->first();

        if ($aplication_file == null) {
            Checker_gain::where('id', $checker_gain->id)
                ->update([
                    'user_id' => $request->checker,
                ]);
        } else {
            $form_rating = Form_rating::where('aplication_file_id', $aplication_file->id)->get();
            foreach ($form_rating as $form_rating) {
                $fr_id[] = $form_rating->id;
            }

            $pe_all = Practical_exam::where('checker_gain_id', $checker_gain->id)->get();
            $practical_exam = $pe_all->whereIn('form_rating_id', $fr_id)->all();
            foreach ($practical_exam as $practical_exam) {
                $pe_id[] = $practical_exam->id;
            }
            $count = count($pe_id);

            Checker_gain::where('id', $checker_gain->id)
                ->update([
                    'user_id' => $request->checker,
                ]);

            for ($i = 0; $i < $count; $i++) {
                Practical_exam::where('id', $pe_id[$i])
                    ->update([
                        'checker_gain_id' => $checker_gain->id,
                        'checker_id' => $request->checker
                    ]);
            }
        }
        return redirect()->route('sessions.gain_ratings.checker_gains.index', [$session, $gain_rating])->with('status', 'Checker edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Checker_gain  $checker_gain
     * @return \Illuminate\Http\Response
     */
    public function destroy(Session $session, Gain_rating $gain_rating, Checker_gain $checker_gain)
    {
        Checker_gain::destroy($checker_gain->id);
        return redirect()->route('sessions.gain_ratings.checker_gains.index', [$session, $gain_rating])->with('status', 'Checker deleted successfully');
    }
}
