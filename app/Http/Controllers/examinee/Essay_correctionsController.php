<?php

namespace App\Http\Controllers\examinee;

use App\Aplication_rating;
use App\Checker_gain;
use App\Essay;
use App\Essay_correction;
use App\Form_rating;
use App\Group_member;
use App\Http\Controllers\Controller;
use App\Performance_check;
use App\Score;
use App\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Psy\VersionUpdater\Checker;

class Essay_correctionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Group_member $group_member, Form_rating $form_rating, Essay_correction $essay_correction)
    {
        return ("store");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Essay_correction  $essay_correction
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Group_member $group_member, Form_rating $form_rating, Essay_correction $essay_correction)
    {
        return ("show");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Essay_correction  $essay_correction
     * @return \Illuminate\Http\Response
     */
    public function edit(Checker_gain $checker_gain, Form_rating $form_rating, Essay_correction $essay_correction)
    {
        return ("coba");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Essay_correction  $essay_correction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Session $sessionss, Checker_gain $checker_gain, Form_rating $form_rating, Essay_correction $essay_correction)
    {
        $aplication_rating = Aplication_rating::where('branch_id', Auth::user()->branch_id)
            ->where('rating_id', $form_rating->rating_id)->orderBy('id', 'desc')->first();
        $performance_check = Performance_check::where('question_varian_id', 1)
            ->where('aplication_rating_id', $aplication_rating->id)->first();
        $pc = Performance_check::where('aplication_rating_id', $aplication_rating->id)->get();
        $score = Score::where('form_rating_id', $form_rating->id)->orderBy('id', 'desc')->get();

        $essay_correction = Essay_correction::where('score_id', $score[0]->id)->get();
        foreach ($essay_correction as $ec) {
            $essay_c[] = $ec->id;
            $essay_id[] = $ec->essay_id;
        }
        $count = count($essay_c);

        for ($i = 0; $i < $count; $i++) {
            Essay_correction::where('id', $essay_c[$i])
                ->update([
                    'essay_score' => $request->score[$essay_c[$i]],
                    'checker_id' => Auth::id(),
                    'remark_essay_id' => 2
                ]);
        }
        $essay = Essay::whereIn('id', $essay_id)->get();
        $sum_essay = $essay->sum('score');
        $ess_c = Essay_correction::where('score_id', $score[0]->id)->get();
        $sum_score = $ess_c->sum('essay_score');
        $persentage = $performance_check->persentage;
        $score_essay = round(($sum_score / $sum_essay * $persentage * 100), 2);

        if (count($pc) == 1) {
            if (count($score) > 1) {
                if ($score_essay >= 70 && $score[1]->remark_score_id == 3) {
                    Score::where('id', $score[0]->id)
                        ->update([
                            'remark_score_id' => 4,
                            'score' => $score_essay
                        ]);
                    Form_rating::where('id', $form_rating->id)
                        ->update([
                            'status_id' => 3
                        ]);
                } else if ($score_essay < 70) {
                    Score::where('id', $score[0]->id)
                        ->update([
                            'remark_score_id' => 3,
                            'score' => $score_essay
                        ]);
                }
            } else if (count($score) == 1) {
                if ($score_essay > 70) {
                    Score::where('id', $score[0]->id)
                        ->update([
                            'remark_score_id' => 5,
                            'score' => $score_essay
                        ]);
                    Form_rating::where('id', $form_rating->id)
                        ->update([
                            'status_id' => 3
                        ]);
                } else {
                    Score::where('id', $score[0]->id)
                        ->update([
                            'remark_score_id' => 3,
                            'score' => $score_essay
                        ]);
                }
            } else {
                return abort(404);
            }
        } else {
            Score::where('id', $score[0]->id)
                ->update([
                    'remark_score_id' => 2,
                    'score' => $score_essay
                ]);
        }

        Mail::send('otentikasi.email_essay', compact('score_essay'), function ($message) use ($form_rating) {
            $message->from('admin@proton.iatca-jakarta.or.id', 'Admin');
            $message->sender('admin@proton.iatca-jakarta.or.id', 'Admin');
            $message->to($form_rating->aplication_file->user->email);
            $message->subject('(No reply !!!) Essay`s score');
        });

        return redirect()->route('sessionss.checker_gains.form_ratings.index', [$sessionss, $checker_gain])->with('status', 'Essay`s score has already been sent !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Essay_correction  $essay_correction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Session $sessionss, Group_member $group_member, Form_rating $form_rating, Essay_correction $essay_correction)
    {
        $aplication_rating = Aplication_rating::where('branch_id', Auth::user()->branch_id)
            ->where('rating_id', $form_rating->rating_id)->orderBy('id', 'desc')->first();
        $performance_check = Performance_check::where('question_varian_id', 1)
            ->where('aplication_rating_id', $aplication_rating->id)->first();
        $pc = Performance_check::where('aplication_rating_id', $aplication_rating->id)->get();
        $score = Score::where('form_rating_id', $form_rating->id)->orderBy('id', 'desc')->get();

        $essay_correction = Essay_correction::where('score_id', $score[0]->id)->get();
        foreach ($essay_correction as $ec) {
            $essay_c[] = $ec->id;
            $essay_id[] = $ec->essay_id;
        }
        $count = count($essay_c);

        for ($i = 0; $i < $count; $i++) {
            Essay_correction::where('id', $essay_c[$i])
                ->update([
                    'essay_score' => $request->score[$essay_c[$i]],
                    'checker_id' => Auth::id(),
                    'remark_essay_id' => 2
                ]);
        }
        $essay = Essay::whereIn('id', $essay_id)->get();
        $sum_essay = $essay->sum('score');
        $ess_c = Essay_correction::where('score_id', $score[0]->id)->get();
        $sum_score = $ess_c->sum('essay_score');
        $persentage = $performance_check->persentage;
        $score_essay = round(($sum_score / $sum_essay * $persentage * 100), 2);

        if (count($pc) == 1) {
            if (count($score) > 1) {
                if ($score_essay >= 70 && $score[1]->remark_score_id == 3) {
                    Score::where('id', $score[0]->id)
                        ->update([
                            'remark_score_id' => 4,
                            'score' => $score_essay
                        ]);
                    Form_rating::where('id', $form_rating->id)
                        ->update([
                            'status_id' => 3
                        ]);
                } else if ($score_essay < 70) {
                    Score::where('id', $score[0]->id)
                        ->update([
                            'remark_score_id' => 3,
                            'score' => $score_essay
                        ]);
                }
            } else if (count($score) == 1) {
                if ($score_essay > 70) {
                    Score::where('id', $score[0]->id)
                        ->update([
                            'remark_score_id' => 5,
                            'score' => $score_essay
                        ]);
                    Form_rating::where('id', $form_rating->id)
                        ->update([
                            'status_id' => 3
                        ]);
                } else {
                    Score::where('id', $score[0]->id)
                        ->update([
                            'remark_score_id' => 3,
                            'score' => $score_essay
                        ]);
                }
            } else {
                return abort(404);
            }
        } else {
            Score::where('id', $score[0]->id)
                ->update([
                    'remark_score_id' => 2,
                    'score' => $score_essay
                ]);
        }

        Mail::send('otentikasi.email_essay', compact('score_essay'), function ($message) use ($form_rating) {
            $message->from('admin@proton.iatca-jakarta.or.id', 'Admin');
            $message->sender('admin@proton.iatca-jakarta.or.id', 'Admin');
            $message->to($form_rating->aplication_file->user->email);
            $message->subject('(No reply !!!) Essay`s score');
        });

        return redirect()->route('sessionss.group_members.form_ratings.create', [$sessionss, $group_member])->with('status', 'Essay`s score has already been sent !');
    }
}
