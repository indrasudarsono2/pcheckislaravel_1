<?php

namespace App\Http\Controllers\super;

use App\Aplication_rating;
use App\Essay;
use App\Essay_correction;
use App\Essay_group;
use App\Form_rating;
use App\Group;
use App\Group_member;
use App\Http\Controllers\Controller;
use App\Performance_check;
use App\Score;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EssaysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Aplication_rating $aplication_rating)
    {
        $essay = Essay::with('aplication_rating.rating')
            ->where('branch_id', Auth::user()->branch_id)
            ->where('aplication_rating_id', $aplication_rating->id)
            ->orderBy('essay_group_id', 'asc')->paginate(20);

        return view('super/manageQuestions/essay/essays', compact('aplication_rating', 'essay'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Aplication_rating $aplication_rating)
    {
        $essay_group = Essay_group::where('aplication_rating_id', $aplication_rating->id)->get();
        if ($essay_group->isEmpty()) {
            return redirect()->route('aplication_ratings.essays.index', $aplication_rating)->with('alert', 'No group defined !!!');
        }
        return view('super/manageQuestions/essay/essaysAdd', compact('aplication_rating', 'essay_group'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Aplication_rating $aplication_rating)
    {
        $request->validate([
            'essay_group_id' => 'required',
            'essay' => 'required',
            'answer' => 'required',
            'score' => 'required|numeric|max:10'
        ]);

        Essay::create([
            'branch_id' => Auth::user()->branch_id,
            'essay_group_id' => $request->essay_group_id,
            'aplication_rating_id' => $aplication_rating->id,
            'essay' => $request->essay,
            'answer' => $request->answer,
            'score' => $request->score
        ]);

        return redirect()->route('aplication_ratings.essays.index', $aplication_rating)->with('status', 'Essay added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Essay  $essay
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Group $group, Group_member $group_member, Form_rating $form_rating)
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
                if ($score_essay >= 70) {
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
            $message->from('admin@pcheckis.my.id', 'Admin');
            $message->sender('admin@pcheckis.my.id', 'Admin');
            $message->to($form_rating->aplication_file->user->email);
            $message->subject('(No reply !!!) Essay`s score');
        });

        return redirect()->route('groupss.index')->with('status', 'Essay`s score has already been sent !');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Essay  $essay
     * @return \Illuminate\Http\Response
     */
    public function edit(Aplication_rating $aplication_rating, Essay $essay)
    {
        $essay_group = Essay_group::where('aplication_rating_id', $aplication_rating->id)->get();
        if ($essay_group->isEmpty()) {
            return redirect()->route('aplication_ratings.essays.index', $aplication_rating)->with('alert', 'No group defined !!!');
        }
        return view('super/manageQuestions/essay/essaysEdit', compact('aplication_rating', 'essay', 'essay_group'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Essay  $essay
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aplication_rating $aplication_rating, Essay $essay)
    {
        $request->validate([
            'essay_group_id' => 'required',
            'essay' => 'required',
            'answer' => 'required',
            'score' => 'required|numeric|max:10'
        ]);

        Essay::where('id', $essay->id)
            ->update([
                'aplication_rating_id' => $aplication_rating->id,
                'essay_group_id' => $request->essay_group_id,
                'essay' => $request->essay,
                'answer' => $request->answer,
                'score' => $request->score
            ]);

        return redirect()->route('aplication_ratings.essays.index', $aplication_rating)->with('status', 'Essay edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Essay  $essay
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aplication_rating $aplication_rating, Essay $essay)
    {
        Essay::destroy($essay->id);
        return redirect()->route('aplication_ratings.essays.index', $aplication_rating)->with('status', 'Essay deleted successfully');
    }

    public function search(Request $request, Aplication_rating $aplication_rating)
    {
        $search = $request->keyword;

        $essay = Essay::with('Branch')->where('aplication_rating_id', $aplication_rating->id)
            ->where(function ($query) use ($search) {
                return $query->Where('essay', 'like', "%{$search}%")
                    ->orWhere('answer', 'like', "%{$search}%");
            })
            ->get();

        return view('super.ajax.findEssay', compact('aplication_rating', 'essay'));
    }
}
