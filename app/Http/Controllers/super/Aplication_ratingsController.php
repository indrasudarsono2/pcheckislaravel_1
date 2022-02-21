<?php

namespace App\Http\Controllers\super;

use App\Aplication_rating;
use App\Http\Controllers\Controller;
use App\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Aplication_ratingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aplication_rating = Aplication_rating::where('branch_id', Auth::user()->branch_id)->get();
        return view('super/manageQuestions/questions/aplication_rating', compact('aplication_rating'));
    }

    public function index_qg()
    {
        $aplication_rating = Aplication_rating::where('branch_id', Auth::user()->branch_id)->get();
        return view('super/manageQuestions/questions/aplication_rating', compact('aplication_rating'));
    }

    public function index_pc()
    {
        $aplication_rating = Aplication_rating::where('branch_id', Auth::user()->branch_id)->get();
        return view('super/manageQuestions/performance_check/aplication_rating', compact('aplication_rating'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $aplication_rating = Aplication_rating::where('branch_id', Auth::user()->branch_id)->get();
        return view('super/manageQuestions/essay/aplication_rating', compact('aplication_rating'));
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
    public function show(Aplication_rating $aplication_rating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Aplication_rating  $aplication_rating
     * @return \Illuminate\Http\Response
     */
    public function edit(Aplication_rating $aplication_rating)
    {
        //
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
