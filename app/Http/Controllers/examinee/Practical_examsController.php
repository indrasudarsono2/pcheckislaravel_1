<?php

namespace App\Http\Controllers\examinee;

use App\Aplication_file;
use App\Checker_gain;
use App\Form_rating;
use App\Group_member;
use App\Http\Controllers\Controller;
use App\Ielp;
use App\Medex;
use App\Practical_exam;
use App\Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Psy\VersionUpdater\Checker;

class Practical_examsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Session $sessionss)
    {
        $aplication_file2 = Aplication_file::where('user_id', Auth::id())->orderBy('id', 'desc')->get();
        if ($aplication_file2->isEmpty()) {
            return redirect('/examinee')->with('alert', 'No files!');
        }
        foreach ($aplication_file2 as $af) {
            $af_id[] = $af->id;
        }
        $count = count($af_id);
        for ($i = 0; $i < $count; $i++) {
            $form_rating[] = Form_rating::where('aplication_file_id', $af_id[$i])->get();

            $count_fr[] = count($form_rating[$i]);
        }
        $count = count($form_rating);
        $no = 1;

        return view('examinee/score_files/practical_exam', compact('sessionss', 'no', 'form_rating', 'count', 'count_fr'));
    }

    public function index_rate_gain(Session $sessionss, Checker_gain $checker_gain)
    {
        $aplication_file = Aplication_file::where('user_id', $checker_gain->gain_rating->user_id)
            ->where('remark_ap_file_id', 1)
            ->orderBy('id', 'desc')->first();

        if ($aplication_file == null) {
            return redirect()->route('sessionss.checker_gains', $sessionss)->with('alert', 'Application file has not been completed yet');
        } else {
            $form_rating = Form_rating::where('aplication_file_id', $aplication_file->id)->get();
            foreach ($form_rating as $form_rating) {
                $fr_id[] = $form_rating->id;
            }

            $pe_all = Practical_exam::where('checker_gain_id', $checker_gain->id)->get();

            $practical_exam = $pe_all->whereIn('form_rating_id', $fr_id)->all();
            $count = count($practical_exam);
            return view('examinee/checker_menu/checker_gainRate', compact('sessionss', 'checker_gain', 'practical_exam', 'count'));
        }
    }

    public function index_rate_member(Session $sessionss, Group_member $group_member)
    {
        $aplication_file = Aplication_file::where('user_id', $group_member->user_id)
            ->where('session_id', $sessionss->id)
            ->where('remark_ap_file_id', 2)
            ->orderBy('id', 'desc')->first();

        if ($aplication_file == null) {
            return redirect()->route('sessionss.group_members.index', $sessionss)->with('alert', 'Application file has not been completed yet');
        } else {
            $form_rating = Form_rating::where('aplication_file_id', $aplication_file->id)->get();
            foreach ($form_rating as $form_rating) {
                $fr_id[] = $form_rating->id;
            }

            $pe_all = Practical_exam::where('group_id', $group_member->group->id)->get();

            $practical_exam = $pe_all->whereIn('form_rating_id', $fr_id)->all();
            return view('examinee/checker_menu/group_memberRate', compact('sessionss', 'group_member', 'practical_exam'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Checker_gain $checker_gain, Practical_exam $practical_exam)
    {
        return view('examinee/checker_menu/checker_gainRateCreate', compact('checker_gain', 'form_rating'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Checker_gain $checker_gain, Form_rating $form_rating)
    {
        $request->validate([
            'rate' => 'required|numeric'
        ]);

        Practical_exam::create([
            'form_rating_id' => $form_rating->id,
            'score' => $request->rate,
            'checker_id' => Auth::id()
        ]);

        return redirect()->route('checker_gains.form_ratings.index', $checker_gain)->with('status', 'Score added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Practical_exam  $practical_exam
     * @return \Illuminate\Http\Response
     */
    public function show(Session $sessionss, Checker_gain $checker_gain, Practical_exam $practical_exam)
    {
        Practical_exam::create([
            'form_rating_id' => $practical_exam->form_rating_id,
            'checker_gain_id' => $practical_exam->checker_gain_id,
            'checker_id' => $practical_exam->checker_id
        ]);
        return redirect()->route('checker_gains.practical_exams.index_rate_gain', [$sessionss, $checker_gain])->with('status', 'Added successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Practical_exam  $practical_exam
     * @return \Illuminate\Http\Response
     */
    public function edit(Session $sessionss, Checker_gain $checker_gain, Practical_exam $practical_exam)
    {
        return view('examinee/checker_menu/checker_gainRateCreate', compact('sessionss', 'checker_gain', 'practical_exam'));
    }

    public function edit_group_member(Session $sessionss, Group_member $group_member, Practical_exam $practical_exam)
    {
        return view('examinee/checker_menu/group_memberRateCreate', compact('sessionss', 'group_member', 'practical_exam'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Practical_exam  $practical_exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Session $sessionss, Checker_gain $checker_gain, Practical_exam $practical_exam)
    {

        $request->validate([
            'rate' => 'required|numeric|max:100'
        ]);
        $examinee = $checker_gain->gain_rating->user_id;
        $ielp = Ielp::where('user_id', $examinee)->orderBy('id', 'desc')->first();
        $medex = Medex::where('user_id', $examinee)->orderBy('id', 'desc')->first();
        $now = Carbon::now();

        if ($ielp->expired->format('Y-m-d') <= $now || $medex->expired->format('Y-m-d') <= $now) {
            return redirect()->route('checker_gains.practical_exams.index_rate_gain', [$sessionss, $checker_gain])->with('alert', $checker_gain->gain_rating->user->name . '`s IELP or Medex is expired');
        } else {
            Practical_exam::where('id', $practical_exam->id)
                ->update([
                    'score' => $request->rate
                ]);

            return redirect()->route('checker_gains.practical_exams.index_rate_gain', [$sessionss, $checker_gain])->with('status', 'Score updated successfully');
        }
    }

    public function update_group_member(Request $request, Session $sessionss, Group_member $group_member, Practical_exam $practical_exam)
    {
        $request->validate([
            'rate' => 'required|numeric|max:100'
        ]);

        $examinee = $group_member->user_id;
        $ielp = Ielp::where('user_id', $examinee)->orderBy('id', 'desc')->first();
        $medex = Medex::where('user_id', $examinee)->orderBy('id', 'desc')->first();
        $now = Carbon::now();
        if ($ielp->expired->format('Y-m-d') <= $now || $medex->expired->format('Y-m-d') <= $now) {
            return redirect()->route('group_members.practical_exams.index_rate_member', [$sessionss, $group_member])->with('alert', $group_member->user->name . '`s IELP or Medex is expired');
        } else {
            Practical_exam::where('id', $practical_exam->id)
                ->update([
                    'score' => $request->rate
                ]);

            return redirect()->route('group_members.practical_exams.index_rate_member', [$sessionss, $group_member])->with('status', 'Score updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Practical_exam  $practical_exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Session $sessionss, Checker_gain $checker_gain, Practical_exam $practical_exam)
    {
        Practical_exam::destroy($practical_exam->id);

        return redirect()->route('checker_gains.practical_exams.index_rate_gain', [$sessionss, $checker_gain])->with('status', 'Deleted successfully');
    }
}
