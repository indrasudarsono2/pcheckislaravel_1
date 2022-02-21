<?php

namespace App\Http\Controllers\super;

use App\Aplication_rating;
use App\Http\Controllers\Controller;
use App\Mc_question;
use App\Performance_check;
use App\Question_group;
use Illuminate\Http\Request;

class Question_groupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Aplication_rating $aplication_rating)
    {
        $question_group = Question_group::where('aplication_rating_id', $aplication_rating->id)->get();
        $quantity = $question_group->sum('quantity');

        $qg = Question_group::where('aplication_rating_id', $aplication_rating->id)->get();
        if ($qg->isEmpty()) {
            return view('super/manageQuestions/questions/question_group', compact('aplication_rating', 'question_group', 'quantity'));
        }
        foreach ($qg as $qg) {
            $qg_id[] = $qg->id;
        }

        for ($i = 0; $i < count($qg_id); $i++) {
            $mc_question[] = Mc_question::where('question_group_id', $qg_id[$i])->get();
            $count[] = count($mc_question[$i]);
        }
        $no = 1;
        return view('super/manageQuestions/questions/question_group', compact('aplication_rating', 'question_group', 'quantity', 'count', 'no'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Aplication_rating $aplication_rating)
    {
        return view('super/manageQuestions/questions/question_groupAdd', compact('aplication_rating'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Aplication_rating $aplication_rating, Request $request)
    {
        $request->validate([
            'quantity' => 'required|numeric|min:1',
            'group' => 'required|max:100',
        ]);

        Question_group::create([
            'quantity' => $request->quantity,
            'group' => $request->group,
            'aplication_rating_id' => $aplication_rating->id
        ]);
        $performance_check = Performance_check::where('aplication_rating_id', $aplication_rating->id)
            ->where('question_varian_id', 2)->first();
        if ($performance_check == null) {
            return redirect()->route('aplication_ratings.question_groups.index', $aplication_rating)
                ->with('status', $aplication_rating->rating->rating . 'Multiple choice group added successfully, next set performance check menu');
        } else {
            $question_group = Question_group::where('aplication_rating_id', $aplication_rating->id)->get();
            $quantity = $question_group->sum('quantity');
            Performance_check::where('id', $performance_check->id)
                ->update([
                    'quantity' => $quantity
                ]);
            return redirect()->route('aplication_ratings.question_groups.index', $aplication_rating)
                ->with('status', $aplication_rating->rating->rating . ' Multiple choice group successfully, and performance check updated automatically');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question_group  $question_group
     * @return \Illuminate\Http\Response
     */
    public function show(Question_group $question_group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question_group  $question_group
     * @return \Illuminate\Http\Response
     */
    public function edit(Aplication_rating $aplication_rating, Question_group $question_group)
    {
        return view('super/manageQuestions/questions/question_groupEdit', compact('aplication_rating', 'question_group'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question_group  $question_group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aplication_rating $aplication_rating, Question_group $question_group)
    {
        $request->validate([
            'quantity' => 'required|numeric|min:1',
            'group' => 'required|max:100',
        ]);

        Question_group::where('id', $question_group->id)
            ->update([
                'quantity' => $request->quantity,
                'group' => $request->group
            ]);

        $performance_check = Performance_check::where('aplication_rating_id', $aplication_rating->id)
            ->where('question_varian_id', 2)->first();
        if ($performance_check == null) {
            return redirect()->route('aplication_ratings.question_groups.index', $aplication_rating)
                ->with('status', $aplication_rating->rating->rating . 'Multiple choice group edited successfully, next set performance check menu');
        } else {
            $question_group = Question_group::where('aplication_rating_id', $aplication_rating->id)->get();
            $quantity = $question_group->sum('quantity');
            Performance_check::where('id', $performance_check->id)
                ->update([
                    'quantity' => $quantity
                ]);
            return redirect()->route('aplication_ratings.question_groups.index', $aplication_rating)
                ->with('status', $aplication_rating->rating->rating . ' Multiple choice group edited successfully and performance check updated automatically');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question_group  $question_group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aplication_rating $aplication_rating, Question_group $question_group)
    {
        $mc_question = Mc_question::where('question_group_id', $question_group->id)->get();
        $performance_check = Performance_check::where('aplication_rating_id', $aplication_rating->id)
            ->where('question_varian_id', 2)->first();

        if ($mc_question->isEmpty()) {
            Question_group::destroy($question_group->id);
        } else {
            foreach ($mc_question as $mc_question) {
                $mc_id[] = $mc_question->id;
            }
            for ($i = 0; $i < count($mc_id); $i++) {
                Mc_question::where('id', $mc_id[$i])
                    ->update([
                        'question_group_id' => ""
                    ]);
            }

            Question_group::destroy($question_group->id);
        }

        $question_group = Question_group::where('aplication_rating_id', $aplication_rating->id)->get();
        if ($question_group->isEmpty()) {
            Performance_check::where('id', $performance_check->id)
                ->update([
                    'quantity' => 0
                ]);
        } else {
            $quantity = $question_group->sum('quantity');
            Performance_check::where('id', $performance_check->id)
                ->update([
                    'quantity' => $quantity
                ]);
        }

        return redirect()->route('aplication_ratings.question_groups.index', $aplication_rating)->with('status', $aplication_rating->rating->rating . ' question deleted successfully');
    }
}
