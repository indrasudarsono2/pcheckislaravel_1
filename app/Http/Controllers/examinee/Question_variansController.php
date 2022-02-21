<?php

namespace App\Http\Controllers\examinee;

use App\Essay;
use App\Essay_correction;
use App\Essay_group;
use App\Form_rating;
use App\Http\Controllers\Controller;
use App\Mc_correction;
use App\Mc_question;
use App\Performance_check;
use App\Question_group;
use App\Question_varian;
use App\Score;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Question_variansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Form_rating $form_rating, Performance_check $performance_check)
    {
        if ($performance_check->minute < 60) {
            $minute = $performance_check->minute;
            $hour = 0;
        } else {
            $minute = $performance_check->minute % 60;
            $hour = (int) ($performance_check->minute / 60);
        }

        if ($performance_check->question_varian_id == 1) {
            $score = Score::where('form_rating_id', $form_rating->id)->orderBy('id', 'desc')->first();
            if ($score == null || $score->remark_score_id == 3) {
                $essay_group = Essay_group::where('aplication_rating_id', $performance_check->aplication_rating_id)->get();

                foreach ($essay_group as $essay_group) {
                    $essay_group_id[] = $essay_group->id;
                    $essay_group_quantity[] = $essay_group->quantity;
                }
                $count = count($essay_group_id);
                for ($i = 0; $i < $count; $i++) {
                    $essay[] = Essay::with('Aplication_rating')->where('branch_id', Auth::user()->branch_id)
                        ->where('aplication_rating_id', $performance_check->aplication_rating_id)
                        ->where('essay_group_id', $essay_group_id[$i])
                        ->limit($essay_group_quantity[$i])
                        ->inRandomOrder()->get();
                    if ($essay[$i]->isEmpty() || $essay_group_quantity[$i] > count($essay[$i])) {
                        return redirect()->route('form_ratings.performance_checks.index', [$form_rating, $performance_check])
                            ->with('alert', 'There is a violation when defining performance check or managing question group, inform your checker cordinatior !!!');
                    }
                }
                $no = 1;

                return view('examinee/performance_check/essay/essay', compact(
                    'form_rating',
                    'performance_check',
                    'essay',
                    'essay_group_quantity',
                    'count',
                    'no',
                    'minute',
                    'hour'
                ));
            } else {
                return redirect()->route('form_ratings.performance_checks.index', $form_rating)->with('alert', 'Essay`s answer on progress');
            }
        } else {
            $pc = Performance_check::where('aplication_rating_id', $performance_check->aplication_rating_id)->get();
            $count_pc = count($pc);
            if ($count_pc == 1) {
                $question_group = Question_group::where('aplication_rating_id', $performance_check->aplication_rating_id)->get();
                foreach ($question_group as $question_group) {
                    $question_group_id[] = $question_group->id;
                    $question_group_quantity[] = $question_group->quantity;
                }
                $count = count($question_group_id);

                for ($i = 0; $i < $count; $i++) {
                    $mc_question[] = Mc_question::with('Aplication_rating')->where('aplication_rating_id', $performance_check->aplication_rating_id)
                        ->where('question_group_id', $question_group_id[$i])
                        ->limit($question_group_quantity[$i])
                        ->inRandomOrder()->get();
                    if ($mc_question[$i]->isEmpty() || $question_group_quantity[$i] > count($mc_question[$i])) {
                        return redirect()->route('form_ratings.performance_checks.index', [$form_rating, $performance_check])
                            ->with('alert', 'There is a violation when defining performance check or managing question group, inform your checker cordinatior !!!');
                    }
                }
                $no = 1;
                return view('examinee/performance_check/multiple_choice/multiple_choice', compact(
                    'form_rating',
                    'performance_check',
                    'mc_question',
                    'question_group_quantity',
                    'count',
                    'no',
                    'minute',
                    'hour'
                ));;
            } else {
                $score = Score::where('form_rating_id', $form_rating->id)->orderBy('id', 'desc')->first();
                if ($score == null || $score->remark_score_id != 2) {
                    return redirect()->route('form_ratings.performance_checks.index', $form_rating)->with('alert', 'Access denied !');
                } else if ($score->remark_score_id == 2) {
                    $question_group = Question_group::where('aplication_rating_id', $performance_check->aplication_rating_id)->get();
                    foreach ($question_group as $question_group) {
                        $question_group_id[] = $question_group->id;
                        $question_group_quantity[] = $question_group->quantity;
                    }
                    $count = count($question_group_id);


                    for ($i = 0; $i < $count; $i++) {
                        $mc_question[] = Mc_question::with('Aplication_rating')->where('aplication_rating_id', $performance_check->aplication_rating_id)
                            ->where('question_group_id', $question_group_id[$i])
                            ->limit($question_group_quantity[$i])
                            ->inRandomOrder()->get();
                        if ($mc_question[$i]->isEmpty() || $question_group_quantity[$i] > count($mc_question[$i])) {
                            return redirect()->route('form_ratings.performance_checks.index', [$form_rating, $performance_check])
                                ->with('alert', 'There is a violation when defining performance check or managing question group, inform your checker cordinatior !!!');
                        }
                    }
                    $no = 1;

                    return view('examinee/performance_check/multiple_choice/multiple_choice', compact(
                        'form_rating',
                        'performance_check',
                        'mc_question',
                        'question_group_quantity',
                        'count',
                        'no',
                        'minute',
                        'hour'
                    ));
                }
            }
        }
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
    public function store(Request $request, Form_rating $form_rating, Performance_check $performance_check)
    {
        $pc = Performance_check::where('aplication_rating_id', $performance_check->aplication_rating_id)->get();
        $count_pc = count($pc);
        $persentage = $performance_check->persentage;
        $pc_quantity = $performance_check->quantity;

        $score = Score::where('form_rating_id', $form_rating->id)->orderBy('id', 'desc')->get();
        $count_score = count($score);

        $true = 0;
        $false = 0;
        $no = 1;

        if ($count_pc == 1) {
            if ($performance_check->question_varian_id == 1) {
                $score = Score::where('form_rating_id', $form_rating->id)
                    ->where('remark_score_id', 1)->first();

                if ($score == null) {
                    Score::create([
                        'form_rating_id' => $form_rating->id,
                        'remark_score_id' => 1,
                        'score' => 0
                    ]);

                    $score = Score::where('form_rating_id', $form_rating->id)->where('remark_score_id', 1)->first();

                    for ($i = 0; $i < $pc_quantity; $i++) {
                        Essay_correction::Create(
                            [
                                'score_id' => $score->id,
                                'form_rating_id' => $form_rating->id,
                                'essay_id' => $request->essay_id[$i],
                                'essay_answer' => $request->answer[$request->essay_id[$i]],
                                'remark_essay_id' => 1
                            ]
                        );
                    }

                    return redirect()->route('form_ratings.performance_checks.index', $form_rating)->with('status', $performance_check->question_varian->varian . '`s answer added successfully');
                } else {
                    $essay_correction = Essay_correction::where('score_id', $score->id)->get();
                    foreach ($essay_correction as $essay_correction) {
                        $id_essay_correction[] = $essay_correction->id;
                    }

                    for ($i = 0; $i < $pc_quantity; $i++) {
                        Essay_correction::where('id', $id_essay_correction[$i])
                            ->update([
                                'essay_answer' => $request->answer[$request->essay_id[$i]],
                            ]);
                    }
                    return redirect()->route('form_ratings.performance_checks.index', $form_rating)->with('status', $performance_check->question_varian->varian . '`s answer added successfully');
                }
            } else if ($performance_check->question_varian_id == 2) {
                for ($i = 0; $i < $pc_quantity; $i++) {

                    $check[] = Mc_question::with('Aplication_rating')->where('id', $request->mc_question_id[$i])
                        ->where('key', $request->option[$request->mc_question_id[$i]])->get();

                    if ($check[$i]->isNotEmpty()) {
                        $true++;
                    } else {
                        $review[] = Mc_question::with('Aplication_rating')->where('id', $request->mc_question_id[$i])
                            ->where('key', '!=', $request->option[$request->mc_question_id[$i]])->get();
                        $option[] = $request->option[$request->mc_question_id[$i]];
                        $false++;
                    }
                }
                $mc_score = round(($true / $pc_quantity * 100 * $persentage), 2);
                if ($mc_score > 100) {
                    return redirect()->route('logout')->with('alert', 'More than 100, Score is rejected');
                }

                if ($score->isEmpty()) {

                    if ($mc_score >= 70) {
                        Score::create([
                            'form_rating_id' => $form_rating->id,
                            'remark_score_id' => 5,
                            'score' => $mc_score
                        ]);
                        Form_rating::where('id', $form_rating->id)
                            ->update([
                                'status_id' => 3
                            ]);
                    } else {
                        Score::create([
                            'form_rating_id' => $form_rating->id,
                            'remark_score_id' => 3,
                            'score' => $mc_score
                        ]);
                    }
                } else {
                    if ($mc_score >= 70 && $score[0]->remark_score_id == 3) {
                        Score::create([
                            'form_rating_id' => $form_rating->id,
                            'remark_score_id' => 4,
                            'score' => $mc_score
                        ]);
                        Form_rating::where('id', $form_rating->id)
                            ->update([
                                'status_id' => 3
                            ]);
                    } else if ($mc_score < 70) {
                        Score::create([
                            'form_rating_id' => $form_rating->id,
                            'remark_score_id' => 3,
                            'score' => $mc_score
                        ]);
                    }
                }
                $score = Score::where('form_rating_id', $form_rating->id)->orderBy('id', 'desc')->get();
                Mc_correction::Create(
                    [
                        'score_id' => $score[0]->id,
                        'mc_question_id' => $request->mc_question_id[$i],
                        'answer' => $request->option[$request->mc_question_id[$i]]
                    ]
                );
                return view('examinee.performance_check.review.review', compact('form_rating', 'performance_check', 'review', 'false', 'option', 'no', 'mc_score'));
            } else {
                return abort(404);
            }
        } else if ($count_pc == 2) {
            if ($performance_check->question_varian_id == 1) {
                $score = Score::where('form_rating_id', $form_rating->id)
                    ->where('remark_score_id', 1)->first();

                if ($score == null) {
                    Score::create([
                        'form_rating_id' => $form_rating->id,
                        'remark_score_id' => 1,
                        'score' => 0
                    ]);

                    $score = Score::where('form_rating_id', $form_rating->id)->where('remark_score_id', 1)->first();

                    for ($i = 0; $i < $pc_quantity; $i++) {
                        Essay_correction::Create(
                            [
                                'score_id' => $score->id,
                                'form_rating_id' => $form_rating->id,
                                'essay_id' => $request->essay_id[$i],
                                'essay_answer' => $request->answer[$request->essay_id[$i]],
                                'remark_essay_id' => 1
                            ]
                        );
                    }

                    return redirect()->route('form_ratings.performance_checks.index', $form_rating)->with('status', $performance_check->question_varian->varian . '`s answer added successfully');
                } else {
                    $essay_correction = Essay_correction::where('score_id', $score->id)->get();
                    foreach ($essay_correction as $essay_correction) {
                        $id_essay_correction[] = $essay_correction->id;
                    }

                    for ($i = 0; $i < $pc_quantity; $i++) {
                        Essay_correction::where('id', $id_essay_correction[$i])
                            ->update([
                                'essay_answer' => $request->answer[$request->essay_id[$i]],
                            ]);
                    }
                    return redirect()->route('form_ratings.performance_checks.index', $form_rating)->with('status', $performance_check->question_varian->varian . '`s answer added successfully');
                }
            } else if ($performance_check->question_varian_id == 2) {
                for ($i = 0; $i < $pc_quantity; $i++) {

                    $check[] = Mc_question::with('Aplication_rating')->where('id', $request->mc_question_id[$i])
                        ->where('key', $request->option[$request->mc_question_id[$i]])->get();

                    if ($check[$i]->isNotEmpty()) {
                        $true++;
                    } else {
                        $review[] = Mc_question::with('Aplication_rating')->where('id', $request->mc_question_id[$i])
                            ->where('key', '!=', $request->option[$request->mc_question_id[$i]])->get();
                        $option[] = $request->option[$request->mc_question_id[$i]];
                        $false++;
                    }

                    Mc_correction::Create(
                        [
                            'score_id' => $score[0]->id,
                            'mc_question_id' => $request->mc_question_id[$i],
                            'answer' => $request->option[$request->mc_question_id[$i]]
                        ]
                    );
                }

                $score_tmp = $score[0]->score;
                $mc_score = round((($true / $pc_quantity * 100 * $persentage) + $score_tmp), 2);
                if ($mc_score > 100) {
                    return redirect()->route('logout')->with('alert', 'More than 100, Score is rejected');
                }

                if ($count_score > 1) {
                    if ($mc_score >= 70 && $score[1]->remark_score_id == 3) {
                        Score::where('id', $score[0]->id)
                            ->update([
                                'score' => $mc_score,
                                'remark_score_id' => 4
                            ]);
                        Form_rating::where('id', $form_rating->id)
                            ->update([
                                'status_id' => 3
                            ]);
                    } else if ($mc_score < 70) {
                        Score::where('id', $score[0]->id)
                            ->update([
                                'score' => $mc_score,
                                'remark_score_id' => 3
                            ]);
                    }
                } else if ($count_score == 1) {
                    if ($mc_score >= 70) {
                        Score::where('id', $score[0]->id)
                            ->update([
                                'score' => $mc_score,
                                'remark_score_id' => 5
                            ]);
                        Form_rating::where('id', $form_rating->id)
                            ->update([
                                'status_id' => 3
                            ]);
                    } else {
                        Score::where('id', $score[0]->id)
                            ->update([
                                'score' => $mc_score,
                                'remark_score_id' => 3
                            ]);
                    }
                } else {
                    return abort(404);
                }

                $essay = Essay_correction::with('Score')->where('score_id', $score[0]->id)->get();

                if (isset($review)) {
                    return view('examinee.performance_check.review.mc_essay', compact('form_rating', 'performance_check', 'review', 'false', 'option', 'no', 'mc_score', 'essay'));
                } else {
                    $review = "Great...";
                    $option = "Perfect...";
                    return view('examinee.performance_check.review.mc_essay', compact('form_rating', 'performance_check', 'review', 'false', 'option', 'no', 'mc_score', 'essay'));
                }
            } else {
                return abort(404);
            }
        } else {
            return abort(404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question_varian  $question_varian
     * @return \Illuminate\Http\Response
     */
    public function show(Question_varian $question_varian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question_varian  $question_varian
     * @return \Illuminate\Http\Response
     */
    public function edit(Question_varian $question_varian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question_varian  $question_varian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question_varian $question_varian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question_varian  $question_varian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question_varian $question_varian)
    {
        //
    }
}
