<?php

namespace App\Http\Controllers\examinee;

use App\Aplication_file;
use App\Aplication_rating;
use App\Form_rating;
use App\Group;
use App\Group_member;
use App\Http\Controllers\Controller;
use App\Performance_check;
use App\Practical_exam;
use App\Score;
use Barryvdh\DomPDF\Facade as PDF;
use App\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Return_;

class Group_membersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Session $sessionss)
    {
        if (Auth::user()->branch_id != 2) {
            $aplication_rating = Aplication_rating::where('branch_id', Auth::user()->branch_id)->get();
            foreach ($aplication_rating as $ar) {
                $a_rating[] = $ar->id;
            }

            $performance_check = Performance_check::where('question_varian_id', 1)
                ->whereIn('aplication_rating_id', $a_rating)->get();
            foreach ($performance_check as $pc) {
                $pc_rating_id[] = $pc->aplication_rating->rating_id;
            }

            $group = Group::where('user_id', Auth::id())->where('session_id', $sessionss->id)->orderBy('id', 'desc')->first();
            if ($group == null) {
                return redirect('/examinee')->with('alert', 'No member available');
            } else {
                $group_member2 = Group_member::with('user')->where('group_id', $group->id)->get();
                if ($group_member2->isEmpty()) {
                    return redirect('/examinee')->with('alert', 'No member available');
                }
                foreach ($group_member2 as $group_member) {
                    $usr_id[] = $group_member->user_id;
                }

                for ($i = 0; $i < count($usr_id); $i++) {
                    $aplication_file[] = Aplication_file::where('user_id', $usr_id[$i])->where('remark_ap_file_id', 2)
                        ->where('session_id', $sessionss->id)->orderBy('id', 'desc')->first();
                    if ($aplication_file[$i] == null) {
                        unset($aplication_file[$i]);
                    }
                }

                if ($aplication_file == null) {
                    $gm_id = 0;
                    $pe_usr[] = 0000;
                    $frm_userid = 0000;
                    $af = 0000;
                    $group_member = Group_member::with('user')->where('group_id', $group->id)->get();
                    return view('examinee/checker_menu/group_member', compact('sessionss', 'group_member', 'gm_id', 'pe_usr', 'frm_userid', 'af'));
                } else {
                    $af = array_values($aplication_file);

                    for ($j = 0; $j < count($af); $j++) {
                        $form_rating[] = Form_rating::where('aplication_file_id', $af[$j]->id)
                            ->whereIn('rating_id', $pc_rating_id)->get();
                        for ($k = 0; $k < count($form_rating[$j]); $k++) {
                            $fr_id[] = $form_rating[$j][$k]->id;
                        }
                    }

                    for ($l = 0; $l < count($af); $l++) {
                        $form_rat[] = Form_rating::where('aplication_file_id', $af[$l]->id)
                            ->whereIn('rating_id', $pc_rating_id)->get();
                        $form_rat_success[] = Form_rating::where('aplication_file_id', $af[$l]->id)
                            ->whereIn('rating_id', $pc_rating_id)->where('status_id', 3)->get();

                        if (count($form_rat[$l]) == count($form_rat_success[$l])) {
                            for ($m = 0; $m < count($form_rat[$l]); $m++) {
                                $frm_userid[] = $form_rat[$l][$m]->aplication_file->user_id;
                                break;
                            }
                        } else {
                            $frm_userid[] = [0];
                        }
                    }

                    // return $frm_userid;

                    $score = Score::where('remark_score_id', 1)->whereIn('form_rating_id', $fr_id)->get();
                    if ($score->isEmpty()) {
                        $group_member = Group_member::with('user')->where('group_id', $group->id)->get();
                        foreach ($group_member as $gm) {
                            $gmp_id[] = $gm->id;
                        }

                        $practical_exam = Practical_exam::whereIn('group_member_id', $gmp_id)->where('score', null)->get();
                        if ($practical_exam->isEmpty()) {
                            $gm_id[] = 0;
                            $pe_usr[] = 0000;
                            return view('examinee/checker_menu/group_member', compact('sessionss', 'group_member', 'gm_id', 'pe_usr', 'frm_userid', 'af'));
                        }
                        foreach ($practical_exam as $pe) {
                            $pe_usr[] = $pe->form_rating->aplication_file->user_id;
                        }

                        $gm_id = 0;
                        return view('examinee/checker_menu/group_member', compact('sessionss', 'group_member', 'gm_id', 'pe_usr', 'frm_userid', 'af'));
                    } else {
                        foreach ($score as $score) {
                            $user_id[] = $score->form_rating->aplication_file->user_id;
                        }

                        for ($k = 0; $k < count($user_id); $k++) {
                            $gm[] = Group_member::where('user_id', $user_id[$k])->orderBy('id', 'desc')->get();
                        }

                        foreach ($gm as $gm) {
                            $gm_id[] = $gm[0]->id;
                        }
                        $group_member = Group_member::where('group_id', $group->id)->get();

                        foreach ($group_member as $gm) {
                            $gmp_id[] = $gm->id;
                        }

                        $practical_exam = Practical_exam::whereIn('group_member_id', $gmp_id)->where('score', null)->get();
                        if ($practical_exam->isEmpty()) {
                            $pe_usr[] = 0000;
                            return view('examinee/checker_menu/group_member', compact('sessionss', 'group_member', 'gm_id', 'pe_usr', 'frm_userid', 'af'));
                        }
                        foreach ($practical_exam as $pe) {
                            $pe_usr[] = $pe->form_rating->aplication_file->user_id;
                        }

                        return view('examinee/checker_menu/group_member', compact('sessionss', 'group_member', 'gm_id', 'pe_usr', 'frm_userid', 'af'));
                    }
                }
            }
        } elseif (Auth::user()->branch_id == 2) {
            $group = Group::where('user_id', Auth::id())->where('session_id', $sessionss->id)->orderBy('id', 'desc')->first();
            if ($group == null) {
                return redirect('/examinee')->with('alert', 'No member available');
            } elseif ($group->name == "TWR") {
                $aplication_rating = Aplication_rating::where('branch_id', Auth::user()->branch_id)->where('rating_id', 1)->get();
            } else {
                $aplication_rating = Aplication_rating::where('branch_id', Auth::user()->branch_id)->whereIn('rating_id', [2, 3])->get();
            }
            foreach ($aplication_rating as $ar) {
                $a_rating[] = $ar->id;
            }

            $performance_check = Performance_check::where('question_varian_id', 1)
                ->whereIn('aplication_rating_id', $a_rating)->get();
            foreach ($performance_check as $pc) {
                $pc_rating_id[] = $pc->aplication_rating->rating_id;
            }


            if ($group == null) {
                return redirect('/examinee')->with('alert', 'No member available');
            } else {
                $group_member2 = Group_member::with('user')->where('group_id', $group->id)->get();
                if ($group_member2->isEmpty()) {
                    return redirect('/examinee')->with('alert', 'No member available');
                }
                foreach ($group_member2 as $group_member) {
                    $usr_id[] = $group_member->user_id;
                }

                for ($i = 0; $i < count($usr_id); $i++) {
                    $aplication_file[] = Aplication_file::where('user_id', $usr_id[$i])
                        ->where('remark_ap_file_id', 2)->where('session_id', $sessionss->id)->orderBy('id', 'desc')->first();
                    if ($aplication_file[$i] == null) {
                        unset($aplication_file[$i]);
                    }
                }

                if ($aplication_file == null) {
                    $gm_id = 0;
                    $pe_usr[] = 0000;
                    $frm_userid = 0000;
                    $af = 0000;
                    $group_member = Group_member::with('user')->where('group_id', $group->id)->get();
                    return view('examinee/checker_menu/group_member', compact('sessionss', 'group_member', 'gm_id', 'pe_usr', 'frm_userid', 'af'));
                } else {
                    $af = array_values($aplication_file);

                    for ($j = 0; $j < count($af); $j++) {
                        $form_rating[] = Form_rating::where('aplication_file_id', $af[$j]->id)
                            ->whereIn('rating_id', $pc_rating_id)->get();
                        for ($k = 0; $k < count($form_rating[$j]); $k++) {
                            $fr_id[] = $form_rating[$j][$k]->id;
                        }
                    }

                    for ($l = 0; $l < count($af); $l++) {
                        $form_rat[] = Form_rating::where('aplication_file_id', $af[$l]->id)
                            ->get();
                        $form_rat_success[] = Form_rating::where('aplication_file_id', $af[$l]->id)
                            ->where('status_id', 3)->get();

                        if (count($form_rat[$l]) == count($form_rat_success[$l])) {
                            for ($m = 0; $m < count($form_rat[$l]); $m++) {
                                $frm_userid[] = $form_rat[$l][$m]->aplication_file->user_id;
                                break;
                            }
                        } else {
                            $frm_userid[] = [0];
                        }
                    }

                    $score = Score::where('remark_score_id', 1)->whereIn('form_rating_id', $fr_id)->get();
                    if ($score->isEmpty()) {
                        $group_member = Group_member::with('user')->where('group_id', $group->id)->get();
                        foreach ($group_member as $gm) {
                            $gmp_id[] = $gm->id;
                        }

                        $practical_exam = Practical_exam::whereIn('group_member_id', $gmp_id)->where('score', null)->get();
                        if ($practical_exam->isEmpty()) {
                            $gm_id[] = 0;
                            $pe_usr[] = 0000;
                            return view('examinee/checker_menu/group_member', compact('sessionss', 'group_member', 'gm_id', 'pe_usr', 'frm_userid', 'af'));
                        }
                        foreach ($practical_exam as $pe) {
                            $pe_usr[] = $pe->form_rating->aplication_file->user_id;
                        }

                        $gm_id = 0;
                        return view('examinee/checker_menu/group_member', compact('sessionss', 'group_member', 'gm_id', 'pe_usr', 'frm_userid', 'af'));
                    } else {
                        foreach ($score as $score) {
                            $user_id[] = $score->form_rating->aplication_file->user_id;
                        }

                        for ($k = 0; $k < count($user_id); $k++) {
                            $gm[] = Group_member::where('user_id', $user_id[$k])->where('group_id', $group->id)->orderBy('id', 'desc')->get();
                        }

                        foreach ($gm as $gm) {
                            $gm_id[] = $gm[0]->id;
                        }
                        $group_member = Group_member::where('group_id', $group->id)->get();

                        foreach ($group_member as $gm) {
                            $gmp_id[] = $gm->id;
                        }

                        $practical_exam = Practical_exam::whereIn('group_member_id', $gmp_id)->where('score', null)->get();
                        if ($practical_exam->isEmpty()) {
                            $pe_usr[] = 0000;
                            return view('examinee/checker_menu/group_member', compact('sessionss', 'group_member', 'gm_id', 'pe_usr', 'frm_userid', 'af'));
                        }

                        foreach ($practical_exam as $pe) {
                            $pe_usr[] = $pe->form_rating->aplication_file->user_id;
                        }

                        return view('examinee/checker_menu/group_member', compact('sessionss', 'group_member', 'gm_id', 'pe_usr', 'frm_userid', 'af'));
                    }
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
     * @param  \App\Group_member  $group_member
     * @return \Illuminate\Http\Response
     */
    public function show(Session $sessionss, Group_member $group_member)
    {
        $aplication_file = Aplication_file::where('user_id', $group_member->user_id)
            ->where('session_id', $sessionss->id)->orderBy('id', 'desc')->first();
        if ($aplication_file == null) {
            return redirect('/examinee')->with('alert', 'No files!');
        }

        if (Auth::user()->branch_id == 2) {
            if ($group_member->group->name == "TWR") {
                $rating_id = 1;
                $form_rating = Form_rating::where('aplication_file_id', $aplication_file->id)
                    ->where('rating_id', $rating_id)->get();
            } else {
                $rating_id = [2, 3];
                $form_rating = Form_rating::where('aplication_file_id', $aplication_file->id)
                    ->whereIn('rating_id', $rating_id)->get();
            }
        } else {
            $form_rating = Form_rating::where('aplication_file_id', $aplication_file->id)->get();
        }
        $count = count($form_rating);

        $no = 1;
        return view('examinee.checker_menu.score_examinee', compact('sessionss', 'group_member', 'no', 'form_rating', 'count'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Group_member  $group_member
     * @return \Illuminate\Http\Response
     */
    public function edit(Session $sessionss, Group_member $group_member, Score $score)
    {
        $name = $score->form_rating->aplication_file->user->name;
        $aplication_file = $score->form_rating->aplication_file->number;
        $pdf = PDF::loadview('examinee.print.scoreExaminee', compact('sessionss', 'group_member', 'score'))->setPaper('A4', 'portrait');
        return $pdf->stream($name . '_' . $aplication_file . '.pdf');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Group_member  $group_member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group_member $group_member)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Group_member  $group_member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group_member $group_member)
    {
        //
    }
}
