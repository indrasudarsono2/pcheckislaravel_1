<?php

namespace App\Http\Controllers\examinee;

use App\Http\Controllers\Controller;
use App\Sertificate;
use App\Sertificate_owner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Competence_sertificatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sertificate_owner = Sertificate_owner::where('user_id', Auth::id())->get();
        return view('examinee.completeness_files.competenceSertificates', compact('sertificate_owner'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sertificate = Sertificate_owner::where('user_id', Auth::id())->get();
        if ($sertificate->isEmpty()) {
            $sertificate_owner = Sertificate::all();
        } else {
            foreach ($sertificate as $sertificate) {
                $ser[] = $sertificate->sertificate_id;
            }

            $collection = Sertificate::all();
            $sertificate_owner = $collection->whereNotIn('id', $ser)->all();
        }

        return view('examinee.completeness_files.competenceSertificatesAdd', compact('sertificate_owner'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'sertificate_id' => 'required',
            'released' => 'required',
            'institution' => 'required'
        ]);

        Sertificate_owner::create([
            'user_id' => Auth::id(),
            'sertificate_id' => $request->sertificate_id,
            'institution' => $request->institution,
            'released' => date('Y-m-d', strtotime($request->released)),
        ]);

        return redirect('/competence_sertificates')->with('status', 'Sertificate added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sertificate_owner  $sertificate_owner
     * @return \Illuminate\Http\Response
     */
    public function show(Sertificate_owner $sertificate_owner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sertificate_owner  $sertificate_owner
     * @return \Illuminate\Http\Response
     */
    public function edit(Sertificate_owner $competence_sertificate)
    {
        $sertificate = Sertificate_owner::where('user_id', Auth::id())->get();
        foreach ($sertificate as $sertificate) {
            $ser[] = $sertificate->sertificate_id;
        }

        $collection = Sertificate::all();
        $so = $collection->whereNotIn('id', $ser)->all();

        return view('examinee.completeness_files.competenceSertificatesEdit', compact('competence_sertificate', 'so'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sertificate_owner  $sertificate_owner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sertificate_owner $competence_sertificate)
    {
        $request->validate([
            'sertificate_id' => 'required',
            'released' => 'required',
            'institution' => 'required'
        ]);

        Sertificate_owner::where('id', $competence_sertificate->id)
            ->update([
                'sertificate_id' => $request->sertificate_id,
                'institution' => $request->institution,
                'released' => date('Y-m-d', strtotime($request->released)),
            ]);

        return redirect('/competence_sertificates')->with('status', 'Competence Sertificate edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sertificate_owner  $sertificate_owner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sertificate_owner $competence_sertificate)
    {
        Sertificate_owner::destroy($competence_sertificate->id);
        return redirect('/competence_sertificates')->with('status', 'Competence Sertificate deleted successfully');
    }
}
