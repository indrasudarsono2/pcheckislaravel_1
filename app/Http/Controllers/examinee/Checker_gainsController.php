<?php

namespace App\Http\Controllers\examinee;

use App\Aplication_file;
use App\Aplication_rating;
use App\Checker_gain;
use App\Form_rating;
use App\Gain_rating;
use App\Http\Controllers\Controller;
use App\Performance_check;
use App\Practical_exam;
use App\Score;
use App\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;;

class Checker_gainsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Session $sessionss)
    {
        $gain_rating = Gain_rating::where('session_id', $sessionss->id)->get();
        if ($gain_rating->isEmpty()) {
            return redirect('/examinee')->with('alert', 'No data available');
        }
        foreach ($gain_rating as $gr) {
            $gain_id[] = $gr->id;
        }

        $checker_gain2 = Checker_gain::where('user_id', Auth::id())
            ->whereIn('gain_rating_id', $gain_id)->get();

        if ($checker_gain2->isEmpty()) {
            return redirect('/examinee')->with('alert', 'No data available');
        }
        foreach ($checker_gain2 as $cg) {
            $usr_id[] = $cg->gain_rating->user_id;
        }

        $aplication_rating = Aplication_rating::where('branch_id', Auth::user()->branch_id)->get();
        foreach ($aplication_rating as $ar) {
            $a_rating[] = $ar->id;
        }

        $performance_check = Performance_check::where('question_varian_id', 1)
            ->whereIn('aplication_rating_id', $a_rating)->get();
        foreach ($performance_check as $pc) {
            $pc_rating_id[] = $pc->aplication_rating->rating_id;
        }

        for ($i = 0; $i < count($usr_id); $i++) {
            $aplication_file[] = Aplication_file::where('user_id', $usr_id[$i])->where('remark_ap_file_id', 1)->orderBy('id', 'desc')->first();
            if ($aplication_file[$i] == null) {
                unset($aplication_file[$i]);
            }
        }

        if ($aplication_file == null) {
            $checker_gain = Checker_gain::with('gain_rating.user')->where('user_id', Auth::id())
                ->whereIn('gain_rating_id', $gain_id)->get();
            $gr_id = 0;
            $pe_usr[] = 0000;
            return view('examinee/checker_menu/checker_gain', compact('sessionss', 'checker_gain', 'gr_id', 'pe_usr'));
        } else {
            $af = array_values($aplication_file);

            for ($j = 0; $j < count($af); $j++) {
                $form_rating[] = Form_rating::where('aplication_file_id', $af[$j]->id)
                    ->whereIn('rating_id', $pc_rating_id)->get();
                for ($k = 0; $k < count($form_rating[$j]); $k++) {
                    $fr_id[] = $form_rating[$j][$k]->id;
                }
            }

            $score = Score::where('remark_score_id', 1)->whereIn('form_rating_id', $fr_id)->get();

            if ($score->isEmpty()) {
                $checker_gain = Checker_gain::with('gain_rating.user')->where('user_id', Auth::id())
                    ->whereIn('gain_rating_id', $gain_id)->get();
                foreach ($checker_gain as $cg) {
                    $cg_id[] = $cg->id;
                }

                $practical_exam = Practical_exam::whereIn('checker_gain_id', $cg_id)->where('score', null)->get();
                if ($practical_exam->isEmpty()) {
                    $gr_id[] = 0;
                    $pe_usr[] = 0000;
                    return view('examinee/checker_menu/checker_gain', compact('sessionss', 'checker_gain', 'gr_id', 'pe_usr'));
                }
                foreach ($practical_exam as $pe) {
                    $pe_usr[] = $pe->form_rating->aplication_file->user_id;
                }

                $gr_id = 0;

                return view('examinee/checker_menu/checker_gain', compact('sessionss', 'checker_gain', 'gr_id', 'pe_usr'));
            } else {
                foreach ($score as $score) {
                    $user_id[] = $score->form_rating->aplication_file->user_id;
                }

                $gain_rating = Gain_rating::where('session_id', $sessionss->id)->whereIn('user_id', $user_id)->orderBy('id', 'desc')->get();

                foreach ($gain_rating as $gain_rating) {
                    $gr_id[] = $gain_rating->id;
                }

                $checker_gain = Checker_gain::with('gain_rating.user')->where('user_id', Auth::id())
                    ->whereIn('gain_rating_id', $gain_id)->get();
                foreach ($checker_gain as $cg) {
                    $cg_id[] = $cg->id;
                }

                $practical_exam = Practical_exam::whereIn('checker_gain_id', $cg_id)->where('score', null)->get();

                if ($practical_exam->isEmpty()) {

                    $pe_usr[] = 0000;
                    return view('examinee/checker_menu/checker_gain', compact('sessionss', 'checker_gain', 'gr_id', 'pe_usr'));
                }
                foreach ($practical_exam as $pe) {
                    $pe_usr[] = $pe->form_rating->aplication_file->user_id;
                }

                return view('examinee/checker_menu/checker_gain', compact('sessionss', 'checker_gain', 'gr_id', 'pe_usr'));
            }
        }
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
    public function edit(Checker_gain $checker_gain)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Checker_gain  $checker_gain
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Checker_gain $checker_gain)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Checker_gain  $checker_gain
     * @return \Illuminate\Http\Response
     */
    public function destroy(Checker_gain $checker_gain)
    {
        //
    }
}
