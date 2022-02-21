<?php

namespace App\Http\Controllers\examinee;

use App\Aplication_file;
use App\Form_rating;
use App\Http\Controllers\Controller;
use App\Score;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aplication_file = Aplication_file::where('user_id', Auth::id())->orderBy('id', 'desc')->get();
        if ($aplication_file->isEmpty()) {
            return redirect('/examinee')->with('alert', 'No files!');
        }
        foreach ($aplication_file as $af) {
            $af_id[] = $af->id;
        }
        $count = count($af_id);

        for ($i = 0; $i < $count; $i++) {
            $form_rating[] = Form_rating::where('aplication_file_id', $af_id[$i])->get();

            $count_fr[] = count($form_rating[$i]);
        }
        $count = count($form_rating);
        $no = 1;
        return view('examinee/score_files/score', compact('no', 'form_rating', 'count', 'count_fr'));
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
     * @param  \App\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function show(Score $score)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function edit(Score $score)
    {
        $name = $score->form_rating->aplication_file->user->name;
        $aplication_file = $score->form_rating->aplication_file->number;
        $pdf = PDF::loadview('examinee.print.score', compact('score'))->setPaper('A4', 'portrait');
        return $pdf->download($name . '_' . $aplication_file . '.pdf');
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
}
