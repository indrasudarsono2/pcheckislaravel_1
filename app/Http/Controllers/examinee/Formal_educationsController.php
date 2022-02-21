<?php

namespace App\Http\Controllers\examinee;

use App\Education_owner;
use App\Formal_education;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Formal_educationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $education_owner = Education_owner::where('user_id', Auth::id())->get();
        return view('examinee.completeness_files.formalEducations', compact('education_owner'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $education = Education_owner::where('user_id', Auth::id())->get();
        if ($education->isEMpty()) {
            $formal_education = Formal_education::all();
        } else {
            foreach ($education as $education) {
                $ed[] = $education->formal_education_id;
            }

            $collection = Formal_education::all();
            $formal_education = $collection->whereNotIn('id', $ed)->all();
        }

        return view('examinee.completeness_files.formalEducationsAdd', compact('formal_education'));
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
            'formal_education_id' => 'required',
            'year' => 'required'
        ]);

        Education_owner::create([
            'user_id' => Auth::id(),
            'formal_education_id' => $request->formal_education_id,
            'year' => $request->year
        ]);

        return redirect('/formal_educations')->with('status', 'Formal Education added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Education_owner  $education_owner
     * @return \Illuminate\Http\Response
     */
    public function show(Education_owner $education_owner)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Education_owner  $education_owner
     * @return \Illuminate\Http\Response
     */
    public function edit(Education_owner $formal_education)
    {
        $education = Education_owner::where('user_id', Auth::id())->get();
        foreach ($education as $education) {
            $ed[] = $education->formal_education_id;
        }

        $collection = Formal_education::all();
        $fe = $collection->whereNotIn('id', $ed)->all();

        return view('examinee.completeness_files.formalEducationsEdit', compact('fe', 'formal_education'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Education_owner  $education_owner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Education_owner $formal_education)
    {
        $request->validate([
            'formal_education_id' => 'required',
            'year' => 'required'
        ]);

        Education_owner::where('id', $formal_education->id)
            ->update([
                'formal_education_id' => $request->formal_education_id,
                'year' => $request->year
            ]);

        return redirect('/formal_educations')->with('status', 'Formal Education edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Education_owner  $education_owner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Education_owner $formal_education)
    {
        Education_owner::destroy($formal_education->id);
        return redirect('/formal_educations')->with('status', 'Formal Education deleted successfully');
    }
}
