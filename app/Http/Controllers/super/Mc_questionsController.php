<?php

namespace App\Http\Controllers\super;

use App\Aplication_file;
use App\Aplication_rating;
use App\Http\Controllers\Controller;
use App\Mc_question;
use App\Question_group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Mc_questionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Aplication_rating $aplication_rating)
    {
        $mc_question = Mc_question::with('Aplication_rating')->where('aplication_rating_id', $aplication_rating->id)
            ->orderBy('question_group_id', 'asc')->paginate(20);

        return view('super/manageQuestions/questions/mc_questions', compact('aplication_rating', 'mc_question'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Aplication_rating $aplication_rating)
    {
        $group = Question_group::where('aplication_rating_id', $aplication_rating->id)->get();
        return view('super/manageQuestions/questions/mc_questionsAdd', compact('aplication_rating', 'group'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Aplication_rating $aplication_rating, Request $request)
    {
        $request->validate(
            [
                'group_id' => 'required',
                'question' => 'required',
                'a' => 'required',
                'b' => 'required',
                'c' => 'required',
                'd' => 'required',
                'key' => 'required|size:1|regex:/^.*(?=.*[A-Z]).*$/'
            ],
            [
                'key.regex' => 'Must be uppercase letter'
            ]
        );

        Mc_question::create([
            'aplication_rating_id' => $aplication_rating->id,
            'question_group_id' => $request->group_id,
            'question' => $request->question,
            'a' => $request->a,
            'b' => $request->b,
            'c' => $request->c,
            'd' => $request->d,
            'key' => $request->key
        ]);

        return redirect()->route('aplication_ratings.mc_questions.index', $aplication_rating)->with('status', $aplication_rating->rating->rating . ' question added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mc_question  $mc_question
     * @return \Illuminate\Http\Response
     */
    public function show(Mc_question $mc_question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mc_question  $mc_question
     * @return \Illuminate\Http\Response
     */
    public function edit(Aplication_rating $aplication_rating, Mc_question $mc_question)
    {
        $group = Question_group::where('aplication_rating_id', $aplication_rating->id)->get();
        return view('super/manageQuestions/questions/mc_questionsEdit', compact('aplication_rating', 'mc_question', 'group'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mc_question  $mc_question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aplication_rating $aplication_rating, Mc_question $mc_question)
    {
        $request->validate(
            [
                'group_id' => 'required',
                'question' => 'required',
                'a' => 'required',
                'b' => 'required',
                'c' => 'required',
                'd' => 'required',
                'key' => 'required|size:1|regex:/^.*(?=.*[A-Z]).*$/'
            ],
            [
                'key.regex' => 'Must be uppercase letter'
            ]
        );

        Mc_question::where('id', $mc_question->id)
            ->update([
                'question_group_id' => $request->group_id,
                'question' => $request->question,
                'a' => $request->a,
                'b' => $request->b,
                'c' => $request->c,
                'd' => $request->d,
                'key' => $request->key
            ]);

        return redirect()->route('aplication_ratings.mc_questions.index', $aplication_rating)->with('status', $aplication_rating->rating->rating . ' question edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mc_question  $mc_question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aplication_rating $aplication_rating, Mc_question $mc_question)
    {
        Mc_question::destroy($mc_question->id);
        return redirect()->route('aplication_ratings.mc_questions.index', $aplication_rating)->with('status', $aplication_rating->rating->rating . ' question deleted successfully');
    }

    public function search(Request $request, Aplication_rating $aplication_rating)
    {
        $search = $request->keyword;
        $mc_question = Mc_question::with('Aplication_rating')->where('aplication_rating_id', $aplication_rating->id)
            ->where(function ($query) use ($search) {
                return $query->where('question', 'like', "%{$search}%")
                    ->orWhere('a', 'like', "%{$search}%")
                    ->orWhere('b', 'like', "%{$search}%")
                    ->orWhere('c', 'like', "%{$search}%")
                    ->orWhere('d', 'like', "%{$search}%");
            })
            ->get();


        return view('super.ajax.findQuestion', compact('mc_question', 'aplication_rating'));
    }
}
