<?php

namespace App\Http\Controllers\super;

use App\Activity;
use App\Aplication_file;
use App\Aplication_rating;
use App\Aplication_rating2;
use App\Essay_correction;
use App\Form_rating;
use App\Http\Controllers\Controller;
use App\Mc_correction;
use App\Practical_exam;
use App\Remark_ap_file;
use App\Score;
use App\Session;
use App\UserModel;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ScoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Session $session, Activity $activity, Remark_ap_file $remark_ap_file, Aplication_rating $aplication_rating)
    {
        $aplication_file = Aplication_file::where('session_id', $session->id)
            ->where('activity_id', $activity->id)
            ->where('remark_ap_file_id', $remark_ap_file->id)
            ->get();

        if ($aplication_file->isEmpty()) {
            return redirect()->route('sessions.activities.remark_ap_files.aplication_ratings2.index', [$session, $activity, $remark_ap_file])->with('alert', 'No aplication file saved !');
        }
        foreach ($aplication_file as $af) {
            $ap_file_id[] = $af->id;
        }

        $form_rating = Form_rating::whereIn('aplication_file_id', $ap_file_id)
            ->where('rating_id', $aplication_rating->rating_id)->get();
        if ($form_rating->isEmpty()) {
            return redirect()->route('sessions.activities.remark_ap_files.aplication_ratings2.index', [$session, $activity, $remark_ap_file])->with('alert', 'No aplication file saved !');
        }
        foreach ($form_rating as $form_rating) {
            $fr_id[] = $form_rating->id;
        }

        $score = Score::whereIn('form_rating_id', $fr_id)->orderBy('updated_at', 'asc')->get();

        return view('super.score.score', compact('session', 'activity', 'remark_ap_file', 'aplication_rating', 'score'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Session $session, Activity $activity, Remark_ap_file $remark_ap_file, Aplication_rating $aplication_rating)
    {
        $score = DB::select(DB::raw("SELECT a.score, a.remark_score_id, a.form_rating_id, 
                            a.updated_at, b.id, b.remark, c.id, c.aplication_file_id, c.rating_id, 
                            d.name, d.id, e.user_id, e.id, e.session_id, e.remark_ap_file_id, e.activity_id
                            FROM scores AS a, remark_scores AS b, form_ratings AS c, users AS d, aplication_files AS e
                            WHERE e.user_id=d.id AND a.form_rating_id=c.id AND a.remark_score_id 
                            IN (2,4,5) AND a.remark_score_id = b.id AND e.id=c.aplication_file_id 
                            AND e.session_id=$session->id AND c.rating_id=$aplication_rating->rating_id AND 
                            e.remark_ap_file_id=$remark_ap_file->id AND e.activity_id=$activity->id
                            ORDER BY d.name ASC"));

        $no = 1;
        $pdf = PDF::loadview('super.print.score_recapitulation', compact('score', 'aplication_rating', 'session', 'remark_ap_file', 'no'))->setPaper('A4', 'landscape');
        return $pdf->stream($session->year . '_' . $session->period . '_' . $remark_ap_file->remark . '_' . $aplication_rating->rating->rating . '_score.pdf');
    }

    public function attendance(Request $request, Session $session, Activity $activity, Remark_ap_file $remark_ap_file, Aplication_rating $aplication_rating)
    {
        if ($request->start == null || $request->end == null) {
            $aplication_file = Aplication_file::where('session_id', $session->id)
                ->where('activity_id', $activity->id)
                ->where('remark_ap_file_id', $remark_ap_file->id)
                ->get();
        } else {
            $aplication_file = Aplication_file::where('session_id', $session->id)
                ->where('activity_id', $activity->id)
                ->where('remark_ap_file_id', $remark_ap_file->id)
                ->whereBetween('created_at', [$request->start, $request->end])
                ->get();
        }

        if ($aplication_file->isEmpty()) {
            return redirect()->route('sessions.activities.remark_ap_files.aplication_ratings2.index', [$session, $activity, $remark_ap_file])->with('alert', 'No aplication file saved !');
        }
        foreach ($aplication_file as $af) {
            $ap_file_id[] = $af->id;
        }

        $form_rating = Form_rating::whereIn('aplication_file_id', $ap_file_id)
            ->where('rating_id', $aplication_rating->rating_id)->get();
        foreach ($form_rating as $form_rating) {
            $fr_id[] = $form_rating->id;
        }

        $score = Score::with('form_rating.aplication_file.user', 'remark_score')->whereIn('form_rating_id', $fr_id)->whereIn('remark_score_id', [4, 5])
            ->orderBy('updated_at', 'asc')->get();

        $pdf = PDF::loadview('super.print.score_attendance', compact('score', 'aplication_rating', 'session', 'remark_ap_file'))->setPaper('A4', 'landscape');
        return $pdf->stream($session->year . '_' . $session->period . '_' . $aplication_rating->rating->rating . '_score.pdf');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Session $session, Activity $activity, Remark_ap_file $remark_ap_file, Aplication_rating $aplication_rating)
    {
        if ($request->start == null || $request->end == null) {
            $score = DB::select(DB::raw("SELECT a.score, a.remark_score_id, a.form_rating_id, 
                    a.updated_at, b.id, b.remark, c.id, c.aplication_file_id, c.rating_id, 
                    d.name, d.id, e.user_id, e.id, e.session_id, e.remark_ap_file_id, e.activity_id, e.created_at
                    FROM scores AS a, remark_scores AS b, form_ratings AS c, users AS d, aplication_files AS e
                    WHERE e.user_id=d.id AND a.form_rating_id=c.id AND a.remark_score_id 
                    IN (2,4,5) AND a.remark_score_id = b.id AND e.id=c.aplication_file_id 
                    AND e.session_id=$session->id AND c.rating_id=$aplication_rating->rating_id AND 
                    e.remark_ap_file_id=$remark_ap_file->id AND e.activity_id=$activity->id
                    ORDER BY d.name ASC"));
        } else {
            $score = DB::select(DB::raw("SELECT a.score, a.remark_score_id, a.form_rating_id, 
                    a.updated_at, b.id, b.remark, c.id, c.aplication_file_id, c.rating_id, 
                    d.name, d.id, e.user_id, e.id, e.session_id, e.remark_ap_file_id, e.activity_id, e.created_at
                    FROM scores AS a, remark_scores AS b, form_ratings AS c, users AS d, aplication_files AS e
                    WHERE e.user_id=d.id AND a.form_rating_id=c.id AND a.remark_score_id 
                    IN (2,4,5) AND a.remark_score_id = b.id AND e.id=c.aplication_file_id 
                    AND e.session_id=$session->id AND c.rating_id=$aplication_rating->rating_id AND 
                    e.remark_ap_file_id=$remark_ap_file->id AND e.activity_id=$activity->id AND e.created_at BETWEEN '$request->start' AND '$request->end'
                    ORDER BY d.name ASC"));
        }

        $no = 1;
        $pdf = PDF::loadview('super.print.score_recapitulation', compact('score', 'aplication_rating', 'session', 'remark_ap_file', 'no'))->setPaper('A4', 'landscape');
        return $pdf->stream($session->year . '_' . $session->period . '_' . $remark_ap_file->remark . '_' . $aplication_rating->rating->rating . '_score.pdf');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function show(Session $session, Activity $activity, Remark_ap_file $remark_ap_file, Aplication_rating $aplication_rating, Score $score)
    {
        $name = $score->form_rating->aplication_file->user->name;
        $aplication_file = $score->form_rating->aplication_file->number;

        $pdf = PDF::loadview('super.print.score', compact('score'))->setPaper('A4', 'portrait');
        return $pdf->stream($name . '_' . $aplication_file . '_score.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function edit(Session $session, Activity $activity, Remark_ap_file $remark_ap_file, Aplication_rating $aplication_rating, Score $score)
    {
        $name = $score->form_rating->aplication_file->user->name;
        $aplication_file = $score->form_rating->aplication_file->number;
        $mc_correction = Mc_correction::where('score_id', $score->id)->get();
        $count_mcc = count($mc_correction);
        $essay_correction = Essay_correction::where('score_id', $score->id)->get();
        $count_ec = count($essay_correction);
        $no = 1;

        $pdf = PDF::loadview(
            'super.print.result',
            compact('score', 'mc_correction', 'essay_correction', 'count_mcc', 'count_ec', 'no')
        )->setPaper('A4', 'portrait');
        return $pdf->download($name . '_' . $aplication_file . '_result.pdf');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Score $score)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function destroy(Score $score)
    {
        //
    }

    public function search(Session $session, Activity $activity, Remark_ap_file $remark_ap_file, Aplication_rating $aplication_rating, Score $score, Request $request)
    {
        $search = $request->keyword;


        // if ($search == null) {
        //     $user = UserModel::with('Branch')->where('branch_id', Auth::user()->branch_id)->get();
        //     foreach ($user as $user) {
        //         $usr_id[] = $user->id;
        //     }
        //     if ($user == null) {
        //         $score = Score::All();
        //         dd($score);
        //     }
        // } else {
        //     $user = UserModel::with('Branch')->where('branch_id', Auth::user()->branch_id)->where('name', 'like', "%{$search}%")->get();
        //     foreach ($user as $user) {
        //         $usr_id[] = $user->id;
        //     }
        // }

        // $aplication_file = Aplication_file::whereIn('user_id', $usr_id)->orderBy('id', 'desc')->get();
        // foreach ($aplication_file as $aplication_file) {
        //     $af_id[] = $aplication_file->id;
        // }

        // $form_rating = Form_rating::whereIn('aplication_file_id', $af_id)->get();
        // foreach ($form_rating as $form_rating) {
        //     $fr_id[] = $form_rating->id;
        // }

        $score = Score::where('id', 'like', "%{$search}%")->get();;

        return view('super.ajax.findScores', compact('score'));
    }

    public function index_participant(UserModel $user, Aplication_file $aplication_file)
    {
        $form_rating = Form_rating::with('aplication_file')->where('aplication_file_id', $aplication_file->id)->get();
        if ($form_rating->isEmpty()) {
            return redirect()->route('user.session.user_sesion', $user)->with('alert', 'No aplication file saved !!!');
        }
        foreach ($form_rating as $form_rating) {
            $fr_id[] = $form_rating->id;
        }

        $score = Score::with('form_rating')->whereIn('form_rating_id', $fr_id)->orderBy('id', 'desc')->get();
        if ($score == null) {
            return redirect()->route('user.session.user_sesion', $user)->with('alert', 'No score yet !!!');
        }
        return view('super.score.participant.score', compact('user', 'aplication_file', 'score'));
    }

    public function print_score(UserModel $user, Aplication_file $aplication_file, Score $score)
    {
        $name = $score->form_rating->aplication_file->user->name;
        $aplication_file = $score->form_rating->aplication_file->number;

        $pdf = PDF::loadview('super.print.score', compact('score'))->setPaper('A4', 'portrait');
        return $pdf->stream($name . '_' . $aplication_file . '_score.pdf');
    }

    public function print_result(UserModel $user, Aplication_file $aplication_file, Score $score)
    {
        $name = $score->form_rating->aplication_file->user->name;
        $aplication_file = $aplication_file->number;
        $mc_correction = Mc_correction::where('score_id', $score->id)->get();
        $count_mcc = count($mc_correction);
        $essay_correction = Essay_correction::where('score_id', $score->id)->get();
        $count_ec = count($essay_correction);
        $no = 1;
        return $essay_correction[0]->essay;
        $pdf = PDF::loadview(
            'super.print.result',
            compact('score', 'mc_correction', 'essay_correction', 'count_mcc', 'count_ec', 'no')
        )->setPaper('A4', 'portrait');
        return $pdf->download($name . '_' . $aplication_file . '_result.pdf');
    }
}
