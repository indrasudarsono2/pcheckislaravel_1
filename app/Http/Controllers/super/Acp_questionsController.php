<?php

namespace App\Http\Controllers\super;

use App\Acp_question;
use App\Http\Controllers\Controller;
use App\Rating;
use Illuminate\Http\Request;

class Acp_questionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $acp_question = Acp_question::where('rating_id', 2)->get();
        return view('super.manageQuestions.acp.showQuestions', compact('acp_question'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rating = Rating::where('id', 2)->get();
        return view('super.manageQuestions.acp.addQuestion', compact('rating'));
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

        Acp_question::create($request->all());

        return redirect('acp_questions')->with('status', 'Question added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Acp_question  $acp_question
     * @return \Illuminate\Http\Response
     */
    public function show(Acp_question $acp_question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Acp_question  $acp_question
     * @return \Illuminate\Http\Response
     */
    public function edit(Acp_question $acp_question)
    {
        $rating = Rating::where('id', 2)->get();

        return view('super.manageQuestions.acp.editQuestion', compact('acp_question', 'rating'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Acp_question  $acp_question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Acp_question $acp_question)
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

        Acp_question::where('id', $request->acp_question->id)
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

        return redirect('acp_questions')->with('status', 'Question updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Acp_question  $acp_question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Acp_question $acp_question)
    {
        Acp_question::destroy('id', $acp_question->id);
        return redirect('acp_questions')->with('status', 'Question deleted successfully');
    }

    public function search(Request $request)
    {
        $search = $request->keyword;
        $acp_question = Acp_question::where('rating_id', 2)
            ->where(function ($query) use ($search) {
                return $query->where('question', 'like', "%{$search}%")
                    ->orWhere('a', 'like', "%{$search}%")
                    ->orWhere('b', 'like', "%{$search}%")
                    ->orWhere('c', 'like', "%{$search}%")
                    ->orWhere('d', 'like', "%{$search}%");
            })
            ->get();

        return view('super/ajax/findAcpQuestion', compact('acp_question'));
    }
}
