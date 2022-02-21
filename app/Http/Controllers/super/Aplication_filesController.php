<?php

namespace App\Http\Controllers\super;

use App\Aplication_file;
use App\Biodata;
use App\Education_owner;
use App\Form_rating;
use App\Http\Controllers\Controller;
use App\Rating;
use App\Rating_confirm;
use App\Remark_ap_file;
use App\Sertificate_owner;
use App\Session;
use App\UserModel;
use App\Verification_data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;

class Aplication_filesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Session $session, Remark_ap_file $remark_ap_file)
    {
        $aplication_file = Aplication_file::with('remark_ap_file', 'medex', 'ielp')
            ->where('remark_ap_file_id', $remark_ap_file->id)
            ->where('session_id', $session->id)
            ->orderBy('provision_date', 'asc')
            ->orderBy('id', 'asc')
            ->paginate(50);
        if ($aplication_file->isEmpty()) {
            return redirect()->route('sessions.remark_ap_files.create', $session)->with('alert', 'No data available!!!');
        }
        foreach ($aplication_file as $af) {
            $af_id[] = $af->id;
        }

        $count = count($af_id);
        for ($i = 0; $i < $count; $i++) {
            $verification_data[] = Verification_data::where('aplication_file_id', $af_id[$i])->limit(1)->get();
            if ($verification_data[$i]->isEmpty()) {
                unset($verification_data[$i]);
            }
        }
        $verification_data = array_values($verification_data);

        // $aplication_file = Aplication_file::with('remark_ap_file', 'medex', 'ielp')
        //     ->where('session_id', $session->id)
        //     ->orderBy('id', 'asc')
        //     ->limit(62)
        //     ->get();

        //   return $aplication_file[61];
        //     if ($aplication_file->isEmpty()) {
        //         return redirect('/sessions_history')->with('alert', 'No data !!!');
        //     }

        return view('super.history.aplication_file', compact('session', 'remark_ap_file', 'aplication_file', 'verification_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Session $session, Remark_ap_file $remark_ap_file)
    {
        $aplication_file = Aplication_file::with('remark_ap_file', 'medex', 'ielp')
            ->where('session_id', $session->id)
            ->where('remark_ap_file_id', $remark_ap_file->id)
            ->orderBy('provision_date', 'asc')
            ->orderBy('id', 'asc')
            ->get();
        if ($aplication_file->isEmpty()) {
            return redirect('/sessions_history')->with('alert', 'No data !!!');
        }

        $pdf = PDF::loadView('super.print.aplication_file_absensi_Print', compact(
            'session',
            'aplication_file'
        ))->setPaper('A4', 'landscape');
        return $pdf->stream($session->year . '_' . $session->period . '.pdf');
    }

    public function printAll(Request $request, Session $session, Remark_ap_file $remark_ap_file)
    {
        if ($request->start == null || $request->end == null) {
            $aplication_file = Aplication_file::orderBy(UserModel::select('name')->whereColumn('users.id', 'aplication_files.user_id'))
                ->with('user', 'remark_ap_file', 'medex', 'ielp')
                ->where('session_id', $session->id)
                ->where('remark_ap_file_id', $remark_ap_file->id)
                ->get();
        } else {
            $aplication_file = Aplication_file::orderBy(UserModel::select('name')->whereColumn('users.id', 'aplication_files.user_id'))
                ->with('user', 'remark_ap_file', 'medex', 'ielp')
                ->where('session_id', $session->id)
                ->where('remark_ap_file_id', $remark_ap_file->id)
                ->whereBetween('created_at', [$request->start, $request->end])
                ->get();
        }
        if ($aplication_file->isEmpty()) {
            return redirect('/sessions_history')->with('alert', 'No data !!!');
        }

        $no = 1;
        $pdf = PDF::loadview('super.print.scoreAll', compact('session', 'remark_ap_file', 'aplication_file', 'no'))->setPaper('A4', 'landscape');
        return $pdf->stream($session->year . '_' . $session->period . '_scoreAll.pdf');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Session $session, Remark_ap_file $remark_ap_file)
    {
        if ($request->start == null || $request->end == null) {
            $aplication_file = Aplication_file::with('remark_ap_file', 'medex', 'ielp')
                ->where('session_id', $session->id)
                ->where('remark_ap_file_id', $remark_ap_file->id)
                ->orderBy('provision_date', 'asc')
                ->orderBy('id', 'asc')
                ->get();
        } else {
            $aplication_file = Aplication_file::with('remark_ap_file', 'medex', 'ielp')
                ->where('session_id', $session->id)
                ->where('remark_ap_file_id', $remark_ap_file->id)
                ->whereBetween('created_at', [$request->start, $request->end])
                ->orderBy('provision_date', 'asc')
                ->orderBy('id', 'asc')
                ->get();
        }
        if ($aplication_file->isEmpty()) {
            return redirect('/sessions_history')->with('alert', 'No data !!!');
        }

        $pdf = PDF::loadView('super.print.aplication_file_absensi_Print', compact(
            'session',
            'aplication_file'
        ))->setPaper('A4', 'landscape');
        return $pdf->stream($session->year . '_' . $session->period . '.pdf');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Aplication_file  $aplication_file
     * @return \Illuminate\Http\Response
     */
    public function show(Aplication_file $aplication_file)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Aplication_file  $aplication_file
     * @return \Illuminate\Http\Response
     */
    public function edit(Session $session, Remark_ap_file $remark_ap_file, Aplication_file $aplication_file)
    {
        $name = $aplication_file->user->name;
        $form_rating = Form_rating::where('aplication_file_id', $aplication_file->id)->get();
        $biodata = Biodata::where('user_id', $aplication_file->user_id)->first();
        $rating_confirm = Rating_confirm::where('aplication_file_id', $aplication_file->id)->first();
        $rating_confirm2 = Rating_confirm::Select('rating_id')->where('aplication_file_id', $aplication_file->id)->first();
        // Str::of($rating_confirm->rating_id)->explode(",");
        $remark_rating = explode(" ", $rating_confirm->remark);
        $rating = explode(",", $rating_confirm->rating_id);
        $rat_collection = Rating::all();
        $rat = $rat_collection->whereIn('id', $rating)->all();
        $education = Education_owner::where('user_id', $aplication_file->user_id)->get();
        $sertificate = Sertificate_owner::where('user_id', $aplication_file->user_id)->get();

        $pdf = PDF::loadView('super.print.aplication_filePrint', compact(
            'aplication_file',
            'form_rating',
            'biodata',
            'rating_confirm',
            'rating_confirm2',
            'remark_rating',
            'rat',
            'education',
            'sertificate'
        ))->setPaper('A4', 'portrait');
        return $pdf->stream($name . '_' . $aplication_file->number . '.pdf');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Aplication_file  $aplication_file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aplication_file $aplication_file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Aplication_file  $aplication_file
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aplication_file $aplication_file)
    {
        //
    }

    public function search(Session $session, Remark_ap_file $remark_ap_file, Request $request)
    {
        $search = $request->keyword;

        $user = UserModel::with('Branch')->where('branch_id', Auth::user()->branch_id)->where('name', 'like', "%{$search}%")
            ->where('remark_id', '!=', [1, 2])->orderBy('name', 'asc')->get();

        foreach ($user as $user) {
            $usr_id[] = $user->id;
        }

        $aplication_file = Aplication_file::with('medex', 'ielp')
            ->whereIn('user_id', $usr_id)
            ->where('session_id', $session->id)
            ->where('remark_ap_file_id', $remark_ap_file->id)
            ->orderBy('provision_date', 'asc')
            ->orderBy('id', 'asc')
            ->get();

        foreach ($aplication_file as $af) {
            $af_id[] = $af->id;
        }

        $count = count($af_id);
        for ($i = 0; $i < $count; $i++) {
            $verification_data[] = Verification_data::where('aplication_file_id', $af_id[$i])->limit(1)->get();
            if ($verification_data[$i]->isEmpty()) {
                unset($verification_data[$i]);
            }
        }
        $verification_data = array_values($verification_data);

        return view('super.ajax.findAf', compact('session', 'remark_ap_file', 'aplication_file', 'verification_data'));
    }

    public function viewDocument(Session $session, Remark_ap_file $remark_ap_file, Aplication_file $aplication_file)
    {
        $name = $aplication_file->user->name;
        $form_rating = Form_rating::where('aplication_file_id', $aplication_file->id)->get();
        $biodata = Biodata::where('user_id', $aplication_file->user_id)->first();
        $rating_confirm = Rating_confirm::where('aplication_file_id', $aplication_file->id)->first();
        $rating_confirm2 = Rating_confirm::Select('rating_id')->where('aplication_file_id', $aplication_file->id)->first();
        $remark_rating = explode(" ", $rating_confirm->remark);
        $rating = explode(",", $rating_confirm->rating_id);
        $rat_collection = Rating::all();
        $rat = $rat_collection->whereIn('id', $rating)->all();
        $education = Education_owner::where('user_id', $aplication_file->user_id)->get();
        $sertificate = Sertificate_owner::where('user_id', $aplication_file->user_id)->get();

        return view('super.history.viewDocument', compact(
            'aplication_file',
            'form_rating',
            'biodata',
            'rating_confirm',
            'rating_confirm2',
            'remark_rating',
            'rat',
            'education',
            'sertificate',
        ));
    }

    public function print_checklist(Session $session, Remark_ap_file $remark_ap_file, Aplication_file $aplication_file)
    {
        $verification_data = Verification_data::where('aplication_file_id', $aplication_file->id)->get();
        if ($verification_data->isEmpty()) {
            return redirect()->route('sessions.remark_ap_files.aplication_files.index', [$session, $remark_ap_file])->with('alert', 'No checklist recorded!!!');
        }

        $pdf = PDF::loadView('super.print.checklistPrint', compact(
            'remark_ap_file',
            'aplication_file',
            'verification_data',
        ))->setPaper('A4', 'portrait');
        return $pdf->stream($aplication_file->user->name . '_' . $aplication_file->number . '.pdf');
    }
}
