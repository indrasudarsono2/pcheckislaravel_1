<?php

namespace App\Http\Controllers\examinee;

use App\Aplication_file;
use App\Aplication_rating;
use App\Checker_gain;
use App\Essay_correction;
use App\Form_rating;
use App\Group;
use App\Group_member;
use App\Http\Controllers\Controller;
use App\Performance_check;
use App\Practical_exam;
use App\Score;
use App\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Form_ratingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Session $sessionss, Checker_gain $checker_gain)
    {
        $aplication_rating = Aplication_rating::where('branch_id', Auth::user()->branch_id)->get();
        foreach ($aplication_rating as $ar) {
            $a_rating[] = $ar->id;
        }
        $performance_check = Performance_check::where('question_varian_id', 1)
            ->whereIn('aplication_rating_id', $a_rating)->get();
        foreach ($performance_check as $pc) {
            $pc_rating_id[] = $pc->aplication_rating->rating_id;
        }

        $aplication_file = Aplication_file::where('user_id', $checker_gain->gain_rating->user_id)->orderBy('id', 'desc')->first();
        $form_rating = Form_rating::where('aplication_file_id', $aplication_file->id)
            ->whereIn('rating_id', $pc_rating_id)->get();

        return view('examinee/checker_menu/form_rating', compact('sessionss', 'checker_gain', 'form_rating'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Session $sessionss, Group_member $group_member)
    {
        if (Auth::user()->branch_id != 2) {
            $aplication_rating = Aplication_rating::where('branch_id', Auth::user()->branch_id)->get();
            foreach ($aplication_rating as $ar) {
                $a_rating[] = $ar->id;
            }

            $performance_check = Performance_check::where('question_varian_id', 1)
                ->whereIn('aplication_rating_id', $a_rating)->get();
            foreach ($performance_check as $pc) {
                $pc_rating_id[] = $pc->aplication_rating->rating_id;
            }

            $aplication_file = Aplication_file::where('user_id', $group_member->user_id)->orderBy('id', 'desc')->first();
            if ($aplication_file == null) {
                return redirect()->route('sessionss.group_members.index', $sessionss)->with('alert', 'No data available');
            }
            $fr = Form_rating::where('aplication_file_id', $aplication_file->id)
                ->whereIn('rating_id', $pc_rating_id)->get();
            foreach ($fr as $fr) {
                $fr_id[] = $fr->id;
            }
            $score = Score::whereIn('form_rating_id', $fr_id)->where('remark_score_id', 1)->get();
            if ($score->isEmpty()) {
                return redirect()->route('sessionss.group_members.index', $sessionss)->with('status', 'Essay`s score added successfully');
            }
            foreach ($score as $score) {
                $fr_sc_id[] = $score->form_rating_id;
            }

            $form_rating = Form_rating::whereIn('id', $fr_sc_id)->get();
            return view('examinee/checker_menu/form_rating_gm', compact('sessionss', 'group_member', 'form_rating'));
        } else {
            $group = Group::where('user_id', Auth::id())->orderBy('id', 'desc')->first();
            if ($group->name == "TWR") {
                $aplication_rating = Aplication_rating::where('branch_id', Auth::user()->branch_id)->where('rating_id', 1)->get();
            } else {
                $aplication_rating = Aplication_rating::where('branch_id', Auth::user()->branch_id)->whereIn('rating_id', [2, 3])->get();
            }
            foreach ($aplication_rating as $ar) {
                $a_rating[] = $ar->id;
            }

            $performance_check = Performance_check::where('question_varian_id', 1)
                ->whereIn('aplication_rating_id', $a_rating)->get();
            foreach ($performance_check as $pc) {
                $pc_rating_id[] = $pc->aplication_rating->rating_id;
            }

            $aplication_file = Aplication_file::where('user_id', $group_member->user_id)->orderBy('id', 'desc')->first();
            if ($aplication_file == null) {
                return redirect()->route('sessionss.group_members.index', $sessionss)->with('alert', 'No data available');
            }
            $fr = Form_rating::where('aplication_file_id', $aplication_file->id)
                ->whereIn('rating_id', $pc_rating_id)->get();
            foreach ($fr as $fr) {
                $fr_id[] = $fr->id;
            }
            $score = Score::whereIn('form_rating_id', $fr_id)->where('remark_score_id', 1)->get();
            if ($score->isEmpty()) {
                return redirect()->route('sessionss.group_members.index', $sessionss)->with('status', 'Essay`s score already sent');
            }
            foreach ($score as $score) {
                $fr_sc_id[] = $score->form_rating_id;
            }

            $form_rating = Form_rating::whereIn('id', $fr_sc_id)->get();
            return view('examinee/checker_menu/form_rating_gm', compact('sessionss', 'group_member', 'form_rating'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Checker_gain $checker_gain, Form_rating $form_rating)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Form_rating  $form_rating
     * @return \Illuminate\Http\Response
     */
    public function show(Checker_gain $checker_gain, Form_rating $form_rating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Form_rating  $form_rating
     * @return \Illuminate\Http\Response
     */
    public function edit(Session $sessionss, Checker_gain $checker_gain, Form_rating $form_rating)
    {
        $score = Score::where('form_rating_id', $form_rating->id)
            ->where('remark_score_id', 1)->first();
        if ($score == null) {
            return redirect()->route('sessionss.checker_gains.form_ratings.index', [$sessionss, $checker_gain])->with('alert', 'No Answer yet or Essay already checked !');
        } else {
            $essay_correction = Essay_correction::where('score_id', $score->id)->get();
            return view('examinee/checker_menu/form_ratingEssay', compact('sessionss', 'checker_gain', 'form_rating', 'essay_correction'));
        }
    }

    public function edit_gm(Session $sessionss, Group_member $group_member, Form_rating $form_rating)
    {
        $score = Score::where('form_rating_id', $form_rating->id)
            ->where('remark_score_id', 1)->first();
        if ($score == null) {
            return redirect()->route('sessionss.group_members.index', $sessionss)->with('alert', 'No answer yet from ' . $form_rating->aplication_file->user->name . ' or ' . $form_rating->aplication_file->user->name . '`s essay has already been checked !');
        } else {
            $essay_correction = Essay_correction::where('score_id', $score->id)->get();
            return view('examinee/checker_menu/form_rating_gmEssay', compact('sessionss', 'group_member', 'form_rating', 'essay_correction'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Form_rating  $form_rating
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Checker_gain $checker_gain, Form_rating $form_rating)
    {
        // $count = count($request->score);
        // for ($i = 0; $i < $count; $i++) {
        //     Essay_correction::where('id',);
        // }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Form_rating  $form_rating
     * @return \Illuminate\Http\Response
     */
    public function destroy(Form_rating $form_rating)
    {
        //
    }
}
