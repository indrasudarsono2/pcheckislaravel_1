<?php

namespace App\Http\Controllers\examinee;

use App\Aplication_file;
use App\Biodata;
use App\Http\Controllers\Controller;
use App\Medex;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medex = Medex::where('user_id', Auth::id())->orderBy('id', 'desc')->get();

        return view('examinee.completeness_files.medex', compact('medex'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $now = Carbon::now();
        $b_day = Biodata::where('user_id', Auth::id())->first();
        if ($b_day == null) {
            return redirect('af')->with('alert', 'Complete your profile please !');
        } else {
            $years = Carbon::parse($b_day->date_of_birth);

            $age = $years->diffInYears($now);
            return view('examinee.completeness_files.medexAdd', compact('age', 'b_day'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'medexExpired' => 'required',
                'medex_date' => 'required',
                'examiner' => 'required|regex:/^.*(?=.*[A-Z]).*$/'
            ],
            [
                'examiner.regex' => 'Must be uppercase letter'
            ]
        );

        Medex::create([
            'confirm' => 'ya',
            'user_id' => Auth::id(),
            'released' => $request->medex_date,
            'expired' => date('Y-m-d', strtotime($request->medexExpired)),
            'examiner' => $request->examiner
        ]);

        return redirect('/med')->with('status', 'Medex added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Medex  $medex
     * @return \Illuminate\Http\Response
     */
    public function show(Medex $medex)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Medex  $medex
     * @return \Illuminate\Http\Response
     */
    public function edit(Medex $medex)
    {
        $now = Carbon::now();
        $b_day = Biodata::where('user_id', Auth::id())->first();
        $years = Carbon::parse($b_day->date_of_birth);

        $age = $years->diffInYears($now);


        return view('examinee.completeness_files.medexEdit', compact('medex', 'age', 'b_day'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Medex  $medex
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Medex $medex)
    {
        $request->validate(
            [
                'medexExpired' => 'required',
                'medex_date' => 'required',
                'examiner' => 'required|regex:/^.*(?=.*[A-Z]).*$/'
            ],
            [
                'examiner.regex' => 'Must be uppercase letter'
            ]
        );

        $aplication_file = Aplication_file::where('medex_id', $medex->id)->get();
        if ($aplication_file->isEmpty()) {
            Medex::where('id', $request->medex->id)
                ->update([
                    'released' => $request->medex_date,
                    'expired' => date('Y-m-d', strtotime($request->medexExpired)),
                    'examiner' => $request->examiner
                ]);
            return redirect('/med')->with('status', 'Medex edited successfully');
        } else {
            return redirect('/med')->with('alert', 'Can not be updated, this Medex is being integrated with aplication form !!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Medex  $medex
     * @return \Illuminate\Http\Response
     */
    public function destroy(Medex $medex)
    {
        $aplication_file = Aplication_file::where('medex_id', $medex->id)->get();
        if ($aplication_file->isEmpty()) {
            Medex::destroy($medex->id);
            return redirect('/med')->with('status', 'Medex deleted successfully');
        } else {
            return redirect('/med')->with('alert', 'Can not be deleted, this Medex is being integrated with aplication form !!!');
        }
    }
}
