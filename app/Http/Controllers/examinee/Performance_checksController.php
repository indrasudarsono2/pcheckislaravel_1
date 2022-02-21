<?php

namespace App\Http\Controllers\examinee;

use App\Aplication_rating;
use App\Form_rating;
use App\Http\Controllers\Controller;
use App\Performance_check;
use App\Score;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Performance_checksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Form_rating $form_rating)
    {
        $aplication_rating = Aplication_rating::where('branch_id', Auth::user()->branch_id)
            ->where('rating_id', $form_rating->rating_id)->first();
        $performance_check = Performance_check::where('aplication_rating_id', $aplication_rating->id)->orderBy('question_varian_id', 'asc')->get();
        $count_pc = count($performance_check);
        $score = Score::where('form_rating_id', $form_rating->id)->orderBy('id', 'desc')->first();

        return view('examinee/performance_check/performance_check', compact('form_rating', 'performance_check', 'aplication_rating', 'score', 'count_pc'));
    }

    public function review(Form_rating $form_rating)
    {
        return ("coba");
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
     * @param  \App\Performance_check  $performance_check
     * @return \Illuminate\Http\Response
     */
    public function show(Performance_check $performance_check)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Performance_check  $performance_check
     * @return \Illuminate\Http\Response
     */
    public function edit(Performance_check $performance_check)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Performance_check  $performance_check
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Performance_check $performance_check)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Performance_check  $performance_check
     * @return \Illuminate\Http\Response
     */
    public function destroy(Performance_check $performance_check)
    {
        //
    }
}
