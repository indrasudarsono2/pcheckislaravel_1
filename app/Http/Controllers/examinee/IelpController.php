<?php

namespace App\Http\Controllers\examinee;

use App\Aplication_file;
use App\Http\Controllers\Controller;
use App\Ielp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IelpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ielp = Ielp::where('user_id', Auth::id())->orderBy('id', 'desc')->get();

        return view('examinee.completeness_files.ielp', compact('ielp'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('examinee.completeness_files.ielpAdd');
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
                'rater' => 'required|regex:/^.*(?=.*[A-Z]).*$/',
                'institution' => 'required',
                'ielp_date' => 'required',
                'levell' => 'required',
                'ielpExpired' => 'required'
            ],
            [
                'rater.regex' => 'Must be uppercase letter'
            ]
        );


        Ielp::create([
            'confirm' => 'ya',
            'user_id' => Auth::id(),
            'rater' => $request->rater,
            'institution' => $request->institution,
            'released' => date('Y-m-d', strtotime($request->ielp_date)),
            'level' => $request->levell,
            'expired' => date('Y-m-d', strtotime($request->ielpExpired))
        ]);

        return redirect('/ielpp')->with('status', 'IELP added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ielp  $ielp
     * @return \Illuminate\Http\Response
     */
    public function show(Ielp $ielp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ielp  $ielp
     * @return \Illuminate\Http\Response
     */
    public function edit(Ielp $ielp)
    {
        return view('examinee.completeness_files.ielpEdit', compact('ielp'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ielp  $ielp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ielp $ielp)
    {
        $request->validate(
            [
                'rater' => 'required|regex:/^.*(?=.*[A-Z]).*$/',
                'institution' => 'required',
                'ielp_date' => 'required',
                'levell' => 'required',
                'ielpExpired' => 'required'
            ],
            [
                'rater.regex' => 'Must be uppercase letter'
            ]
        );

        Ielp::where('id', $request->ielp->id)
            ->update([
                'rater' => $request->rater,
                'institution' => $request->institution,
                'released' => date('Y-m-d', strtotime($request->ielp_date)),
                'level' => $request->levell,
                'expired' => date('Y-m-d', strtotime($request->ielpExpired))
            ]);


        return redirect('/ielpp')->with('status', 'IELP updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ielp  $ielp
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ielp $ielp)
    {
        $aplication_file = Aplication_file::where('ielp_id', $ielp->id)->get();
        if ($aplication_file->isEmpty()) {
            Ielp::destroy($ielp->id);
            return redirect('/ielpp')->with('status', 'IELP deleted successfully');
        } else {
            return redirect('/ielpp')->with('alert', 'Can not be deleted, this IELP is being integrated with aplication form !!!');
        }
    }
}
