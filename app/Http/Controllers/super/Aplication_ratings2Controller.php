<?php

namespace App\Http\Controllers\super;

use App\Activity;
use App\Aplication_file;
use App\Aplication_rating;
use App\Aplication_rating2;
use App\Form_rating;
use App\Http\Controllers\Controller;
use App\Mc_correction;
use App\Mc_question;
use App\Practical_exam;
use App\Remark_ap_file;
use App\Score;
use App\Session;
use App\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;


class Aplication_ratings2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Session $session, Activity $activity, Remark_ap_file $remark_ap_file)
    {
        $aplication_rating = Aplication_rating::where('branch_id', Auth::user()->branch_id)->get();
        return view('super/score/aplication_rating', compact('session', 'activity', 'remark_ap_file', 'aplication_rating'));
    }

    public function index_session(Session $session, Remark_ap_file $remark_ap_file)
    {
        $aplication_rating = Aplication_rating::with('rating')->where('branch_id', Auth::user()->branch_id)->get();
        return view('super/monitor/aplication_rating', compact('session', 'remark_ap_file', 'aplication_rating'));
    }

    public function index_statistic(Session $session)
    {
        $aplication_rating = Aplication_rating::with('rating')->where('branch_id', Auth::user()->branch_id)->get();
        return view('super.statistic.aplication_rating', compact('session', 'aplication_rating'));
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
     * @param  \App\Aplication_rating  $aplication_rating
     * @return \Illuminate\Http\Response
     */
    public function show(Session $session, Remark_ap_file $remark_ap_file, Aplication_rating $aplication_rating)
    {
        if ($remark_ap_file->id == 1) {
            $aplication_file = Aplication_file::with('session')
                ->where('session_id', $session->id)
                ->where('remark_ap_file_id', $remark_ap_file->id)
                ->get();
            if ($aplication_file->isEmpty()) {
                return redirect()->route('sessions.remark_ap_files.index_session', $session)->with('alert', 'No data for ' . $remark_ap_file->remark . ' Rating ' . $aplication_rating->rating->rating);
            }
            foreach ($aplication_file as $aplication_file) {
                $apf_id[] = $aplication_file->id;
            }

            $form_rating = Form_rating::whereIn('aplication_file_id', $apf_id)
                ->where('rating_id', $aplication_rating->rating_id)
                ->orderBy('id', 'desc')
                ->get();
        } else {
            $user = UserModel::with('branch')->where('branch_id', Auth::user()->branch_id)->orderBy('name', 'asc')->get();
            foreach ($user as $user) {
                $usr_id[] = $user->id;
            }

            $aplication_file = Aplication_file::with('session')
                ->whereIn('user_id', $usr_id)
                ->where('session_id', $session->id)
                ->where('remark_ap_file_id', $remark_ap_file->id)
                ->get();
            if ($aplication_file->isEmpty()) {
                return redirect()->route('sessions.remark_ap_files.index_session', $session)->with('alert', 'No data for ' . $remark_ap_file->remark . ' Rating ' . $aplication_rating->rating->rating);
            }
            foreach ($aplication_file as $aplication_file) {
                $apf_id[] = $aplication_file->id;
            }

            $form_rating = Form_rating::with('aplication_file.user')->whereIn('aplication_file_id', $apf_id)
                ->where('rating_id', $aplication_rating->rating_id)
                ->orderBy('updated_at', 'asc')
                ->orderBy('status_id', 'asc')
                ->get();
        }

        return view('super.monitor.monitor', compact('session', 'remark_ap_file', 'aplication_rating', 'form_rating'));
    }
    public function editPracticalExam(Session $session, Remark_ap_file $remark_ap_file, Aplication_rating $aplication_rating, Form_rating $form_rating)
    {
        $practical_exam = Practical_exam::where('form_rating_id', $form_rating->id)->get();

        return view('super.monitor.editPracticalExam', compact('session', 'remark_ap_file', 'aplication_rating', 'form_rating', 'practical_exam'));
    }

    public function updatePracticalExam(Session $session, Remark_ap_file $remark_ap_file, Aplication_rating $aplication_rating, Form_rating $form_rating, Request $request)
    {
        $practical_exam = Practical_exam::where('form_rating_id', $form_rating->id)->get();
        foreach ($practical_exam as $pe) {
            $prac_id[] = $pe->id;
        }

        for ($i = 0; $i < count($prac_id); $i++) {
            Practical_exam::where('id', $prac_id[$i])
                ->update([
                    'score' => $request->score[$prac_id[$i]]
                ]);
        }
        return redirect()->route('sessions.remark_ap_files.aplication_ratings.show', [$session, $remark_ap_file, $aplication_rating])
            ->with('status', 'Practical Exam for ' . $form_rating->aplication_file->user->name . ' edited successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Aplication_rating  $aplication_rating
     * @return \Illuminate\Http\Response
     */
    public function edit(Session $session, Remark_ap_file $remark_ap_file, Aplication_rating $aplication_rating)
    {
        if ($remark_ap_file->id == 1) {
            $aplication_file = Aplication_file::with('session')
                ->where('session_id', $session->id)
                ->where('remark_ap_file_id', $remark_ap_file->id)
                ->get();
            if ($aplication_file->isEmpty()) {
                return redirect()->route('sessions.remark_ap_files.index_session', $session)->with('alert', 'No data for ' . $remark_ap_file->remark . ' Rating ' . $aplication_rating->rating->rating);
            }
            foreach ($aplication_file as $aplication_file) {
                $apf_id[] = $aplication_file->id;
            }

            $form_rating = Form_rating::whereIn('aplication_file_id', $apf_id)
                ->where('rating_id', $aplication_rating->rating_id)
                ->orderBy('id', 'desc')
                ->get();
        } else {
            $user = UserModel::with('branch')->where('branch_id', Auth::user()->branch_id)->orderBy('name', 'asc')->get();
            foreach ($user as $user) {
                $usr_id[] = $user->id;
            }

            $aplication_file = Aplication_file::with('session')
                ->whereIn('user_id', $usr_id)
                ->where('session_id', $session->id)
                ->where('remark_ap_file_id', $remark_ap_file->id)
                ->get();
            if ($aplication_file->isEmpty()) {
                return redirect()->route('sessions.remark_ap_files.index_session', $session)->with('alert', 'No data for ' . $remark_ap_file->remark . ' Rating ' . $aplication_rating->rating->rating);
            }
            foreach ($aplication_file as $aplication_file) {
                $apf_id[] = $aplication_file->id;
            }

            $form_rating = Form_rating::with('aplication_file.user')->whereIn('aplication_file_id', $apf_id)
                ->where('rating_id', $aplication_rating->rating_id)
                ->orderBy('updated_at', 'asc')
                ->get();
        }
        $no = 1;
        $pdf = PDF::loadview('super.print.scoreAll', compact('session', 'remark_ap_file', 'aplication_rating', 'form_rating', 'no'))->setPaper('A4', 'landscape');
        return $pdf->stream($session->year . '_' . $session->period . '_' . $aplication_rating->rating->rating . '_scoreAll.pdf');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Aplication_rating  $aplication_rating
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aplication_rating $aplication_rating)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Aplication_rating  $aplication_rating
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aplication_rating $aplication_rating)
    {
        //
    }
}
