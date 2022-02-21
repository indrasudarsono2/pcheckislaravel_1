<?php

namespace App\Http\Controllers\super;

use App\Acs_question;
use App\Http\Controllers\Controller;
use App\Rating;
use Illuminate\Http\Request;

class Acs_questionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $acs_question = Acs_question::where('rating_id', 1)->get();
        return view('super.manageQuestions.acs.showQuestions', compact('acs_question'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rating = Rating::where('id', 1)->get();
        return view('super.manageQuestions.acs.addQuestion', compact('rating'));
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
            'group' => 'required|size:1',
            'question' => 'required',
            'a' => 'required',
            'b' => 'required',
            'c' => 'required',
            'd' => 'required',
            'key' => 'required|size:1'
        ]);

        Acs_question::create($request->all());

        return redirect('acs_questions')->with('status', 'Question added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Acs_question  $acs_question
     * @return \Illuminate\Http\Response
     */
    public function show(Acs_question $acs_question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Acs_question  $acs_question
     * @return \Illuminate\Http\Response
     */
    public function edit(Acs_question $acs_question)
    {
        $rating = Rating::where('id', 1)->get();
        return view('super.manageQuestions.acs.editQuestion', compact('rating', 'acs_question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Acs_question  $acs_question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Acs_question $acs_question)
    {
        $request->validate([
            'group' => 'required|size:1',
            'question' => 'required',
            'a' => 'required',
            'b' => 'required',
            'c' => 'required',
            'd' => 'required',
            'key' => 'required|size:1'
        ]);

        Acs_question::where('id', $request->acs_question->id)
            ->update([
                'rating_id' => $request->rating_id,
                'group' => $request->group,
                'question' => $request->question,
                'a' => $request->a,
                'b' => $request->b,
                'c' => $request->c,
                'd' => $request->d,
                'key' => $request->key
            ]);

        return redirect('acs_questions')->with('status', 'Question updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Acs_question  $acs_question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Acs_question $acs_question)
    {
        Acs_question::destroy('id', $acs_question->id);
        return redirect('acs_questions')->with('status', 'Question deleted successfully');
    }

    public function search(Request $request)
    {
        $search = $request->keyword;
        $acs_question = Acs_question::where('rating_id', 1)
            ->where(function ($query) use ($search) {
                return $query->where('question', 'like', "%{$search}%")
                    ->orWhere('a', 'like', "%{$search}%")
                    ->orWhere('b', 'like', "%{$search}%")
                    ->orWhere('c', 'like', "%{$search}%")
                    ->orWhere('d', 'like', "%{$search}%");
            })
            ->get();


        return view('super.ajax.findAcsQuestion', compact('acs_question'));
    }
}
