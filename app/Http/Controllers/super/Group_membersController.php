<?php

namespace App\Http\Controllers\super;

use App\Aplication_file;
use App\Aplication_rating;
use App\Checker_gain;
use App\Essay_correction;
use App\Form_rating;
use App\Gain_rating;
use App\Group;
use App\Group_history;
use App\Group_member;
use App\Http\Controllers\Controller;
use App\Performance_check;
use App\Practical_exam;
use App\Score;
use App\Session;
use App\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class Group_membersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Group $group)
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

            $group_member2 = Group_member::with('user')->where('group_id', $group->id)->get();

            if ($group_member2->isEmpty()) {
                return view('super/preparing/g_member', ['group_member' => $group_member2, 'group' => $group]);
            } else {
                foreach ($group_member2 as $group_member) {
                    $usr_id[] = $group_member->user_id;
                }

                for ($i = 0; $i < count($usr_id); $i++) {
                    $aplication_file[] = Aplication_file::where('user_id', $usr_id[$i])->where('remark_ap_file_id', 2)->orderBy('id', 'desc')->first();
                    if ($aplication_file[$i] == null) {
                        unset($aplication_file[$i]);
                    }
                }
                if ($aplication_file == null) {
                    $gm_id = 0;
                    $group_member = Group_member::with('user')->where('group_id', $group->id)->get();
                    return view('super/preparing/g_member', compact('group_member', 'group', 'gm_id'));
                } else {
                    $af = array_values($aplication_file);

                    for ($j = 0; $j < count($af); $j++) {
                        $form_rating[] = Form_rating::where('aplication_file_id', $af[$j]->id)
                            ->whereIn('rating_id', $pc_rating_id)->get();
                        for ($k = 0; $k < count($form_rating[$j]); $k++) {
                            $fr_id[] = $form_rating[$j][$k]->id;
                        }
                    }
                    $score = Score::where('remark_score_id', 1)->whereIn('form_rating_id', $fr_id)->get();
                    if ($score->isEmpty()) {
                        $gm_id = 0;
                        $group_member = Group_member::with('user')->where('group_id', $group->id)->get();
                        return view('super/preparing/g_member', compact('group_member', 'group', 'gm_id'));
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
                        $group_member = Group_member::with('user')->where('group_id', $group->id)->get();
                        return view('super/preparing/g_member', compact('group_member', 'group', 'gm_id'));
                    }
                }
            }
        } else {
            if ($group->name == "TWR") {
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

            $group_member2 = Group_member::with('user')->where('group_id', $group->id)->get();

            if ($group_member2->isEmpty()) {
                return view('super/preparing/g_member', ['group_member' => $group_member2, 'group' => $group]);
            } else {
                foreach ($group_member2 as $group_member) {
                    $usr_id[] = $group_member->user_id;
                }

                for ($i = 0; $i < count($usr_id); $i++) {
                    $aplication_file[] = Aplication_file::where('user_id', $usr_id[$i])->where('remark_ap_file_id', 2)->orderBy('id', 'desc')->first();
                    if ($aplication_file[$i] == null) {
                        unset($aplication_file[$i]);
                    }
                }
                if ($aplication_file == null) {
                    $gm_id = 0;
                    $group_member = Group_member::with('user')->where('group_id', $group->id)->get();
                    return view('super/preparing/g_member', compact('group_member', 'group', 'gm_id'));
                } else {
                    $af = array_values($aplication_file);

                    for ($j = 0; $j < count($af); $j++) {
                        $form_rating[] = Form_rating::where('aplication_file_id', $af[$j]->id)
                            ->whereIn('rating_id', $pc_rating_id)->get();
                        for ($k = 0; $k < count($form_rating[$j]); $k++) {
                            $fr_id[] = $form_rating[$j][$k]->id;
                        }
                    }

                    $score = Score::where('remark_score_id', 1)->whereIn('form_rating_id', $fr_id)->get();
                    if ($score->isEmpty()) {
                        $gm_id = 0;
                        $group_member = Group_member::with('user')->where('group_id', $group->id)->get();
                        return view('super/preparing/g_member', compact('group_member', 'group', 'gm_id'));
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
                        $group_member = Group_member::with('user')->where('group_id', $group->id)->get();
                        return view('super/preparing/g_member', compact('group_member', 'group', 'gm_id'));
                    }
                }
            }
        }
    }

    public function history(Group_history $group_history)
    {
        $group_member_history = Group_member::where('group_id', $group_history->id)->get();
        return view('super/preparing/history_g_member', compact('group_member_history', 'group_history'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Group $group)
    {
        $session = Session::where('branch_id', Auth::user()->branch_id)->orderBy('id', 'desc')->first();
        $group_no_delete = Group::where('session_id', $session->id)->where('deleted_at', null)->get();
        foreach ($group_no_delete as $group_no_delete) {
            $gnd[] = $group_no_delete->id;
        }

        $group_member = Group_member::where('group_id', $group->id)->get();
        $group_member2 = Group_member::all();
        $group_member1 = $group_member2->whereIn('group_id', $gnd);

        $all_user = UserModel::where('branch_id', Auth::user()->branch_id)->where('id', '!=', $group->user_id)->orderBy('name', 'asc')->get();

        if ($group_member1->isEmpty()) {
            $member = $all_user->whereIn('remark_id', [3, 4])->all();
        } else {
            if ($group_member->isEmpty() || $group_member->isNotEmpty()) {
                if (Auth::user()->branch_id != 2) {
                    foreach ($group_member1 as $group_member1) {
                        $gm[] = $group_member1->user_id;
                    }
                    $member = $all_user->whereIn('remark_id', [3, 4])->whereNotIn('id', $gm)->all();
                } else {
                    $group_name = Group::where('name', $group->name)->where('session_id', $session->id)->get();
                    foreach ($group_name as $group_name) {
                        $group_id[] = $group_name->id;
                    }

                    $group_member_app = Group_member::whereIn('group_id', $group_id)->get();
                    if ($group_member_app->isEmpty()) {
                        $member = $all_user->whereIn('remark_id', [3, 4])->all();
                    } else {
                        foreach ($group_member_app as $group_member_app) {
                            $gm_app[] = $group_member_app->user_id;
                        }
                        $member = $all_user->whereIn('remark_id', [3, 4])->whereNotIn('id', $gm_app)->all();
                    }
                }
            }
        }
        return view('super/preparing/g_memberAdd', compact('group', 'member'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Group $group, Request $request)
    {
        $request->validate([
            'member' => 'required'
        ]);
        $user = UserModel::where('id', $request->member)->first();

        $session = Session::where('branch_id', Auth::user()->branch_id)->orderBy('id', 'desc')->first();
        $aplication_file = Aplication_file::where('user_id', $request->member)
            ->where('remark_ap_file_id', 2)
            ->where('session_id', $session->id)
            ->orderBy('id', 'desc')->first();
        function group_member($aplication_file, $request, $group)
        {
            if ($aplication_file == null) {
                Group_member::create([
                    'user_id' => $request->member,
                    'group_id' => $group->id,
                ]);
            } else {
                Group_member::create([
                    'user_id' => $request->member,
                    'group_id' => $group->id
                ]);
                $group_member =  Group_member::where('user_id', $request->member)->where('group_id', $group->id)
                    ->orderBy('id', 'desc')->first();
                if (Auth::user()->branch_id != 2) {
                    $form_rating = Form_rating::where('aplication_file_id', $aplication_file->id)->get();
                    foreach ($form_rating as $form_rating) {
                        $fr_id[] = $form_rating->id;
                    }

                    $count = count($fr_id);
                    for ($i = 0; $i < $count; $i++) {
                        Practical_exam::create([
                            'form_rating_id' => $fr_id[$i],
                            'checker_id' => $group->user_id,
                            'group_id' => $group->id,
                            'group_member_id' => $group_member->id
                        ]);
                    }
                } else {
                    $form_rating = Form_rating::where('aplication_file_id', $aplication_file->id)->get();
                    foreach ($form_rating as $form_rating) {
                        $fr_id[] = $form_rating->id;
                        $fr_rating_id[] = $form_rating->rating_id;
                    }
                    $count = count($fr_id);
                    if ($group->name == "TWR") {
                        if ($fr_rating_id[0] == 1) {
                            Practical_exam::create([
                                'form_rating_id' => $fr_id[0],
                                'checker_id' => $group->user_id,
                                'group_id' => $group->id,
                                'group_member_id' => $group_member->id
                            ]);
                        } else {
                            return redirect()->route('groups.group_members.index', $group)->with('alert', $group_member->user->name . 'didn`t apply for TWR Rating');
                        }
                    } else {
                        if ($fr_rating_id[0] == 1) {
                            for ($i = 1; $i < $count; $i++) {
                                Practical_exam::create([
                                    'form_rating_id' => $fr_id[$i],
                                    'checker_id' => $group->user_id,
                                    'group_id' => $group->id,
                                    'group_member_id' => $group_member->id
                                ]);
                            }
                        } else {
                            for ($i = 0; $i < $count; $i++) {
                                Practical_exam::create([
                                    'form_rating_id' => $fr_id[$i],
                                    'checker_id' => $group->user_id,
                                    'group_id' => $group->id,
                                    'group_member_id' => $group_member->id
                                ]);
                            }
                        }
                    }
                }
            }
            return redirect()->route('groups.group_members.index', $group)->with('status', 'Member added successfully');
        }

        $gain_rating = Gain_rating::where('user_id', $request->member)->where('session_id', $session->id)->orderBy('id', 'desc')->first();
        if ($gain_rating == null) {
            return group_member($aplication_file, $request, $group);
        } else {
            $checker_gain = Checker_gain::where('gain_rating_id', $gain_rating->id)->get();
            foreach ($checker_gain as $checker_gain) {
                $checker_gain_id[] = $checker_gain->id;
            }

            $practical_exam = Practical_exam::whereIn('checker_gain_id', $checker_gain_id)->where('score', null)->get();
            if ($practical_exam->isEmpty()) {
                return group_member($aplication_file, $request, $group);
            } else {
                $user = UserModel::where('id', $request->member)->first();
                foreach ($practical_exam as $practical_exam) {
                    $checker_nm[] = $practical_exam->checker_gain->user->name;
                }
                $checker_name = implode(", ", $checker_nm);
                return redirect()->route('groups.group_members.index', $group)->with('alert', $checker_name . ' had not completed ' . $user->name . ' `s score yet');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Group_member  $group_member
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group, Group_member $group_member)
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

            $aplication_file = Aplication_file::where('user_id', $group_member->user_id)->orderBy('id', 'desc')->first();
            if ($aplication_file == null) {
                return redirect()->route('group_members.index')->with('alert', 'No data available');
            }
            $fr = Form_rating::where('aplication_file_id', $aplication_file->id)
                ->whereIn('rating_id', $pc_rating_id)->get();
            foreach ($fr as $fr) {
                $fr_id[] = $fr->id;
            }
            $score = Score::whereIn('form_rating_id', $fr_id)->where('remark_score_id', 1)->get();
            if ($score->isEmpty()) {
                return redirect()->route('group_members.index')->with('status', 'Essay`s score added successfully');
            }
            foreach ($score as $score) {
                $fr_sc_id[] = $score->form_rating_id;
            }

            $form_rating = Form_rating::whereIn('id', $fr_sc_id)->get();

            return view('super/preparing/essay', compact('group', 'group_member', 'form_rating'));
        } else {
            if ($group->name == "TWR") {
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

            $aplication_file = Aplication_file::where('user_id', $group_member->user_id)->orderBy('id', 'desc')->first();
            if ($aplication_file == null) {
                return redirect()->route('group_members.index')->with('alert', 'No data available');
            }
            $fr = Form_rating::where('aplication_file_id', $aplication_file->id)
                ->whereIn('rating_id', $pc_rating_id)->get();
            foreach ($fr as $fr) {
                $fr_id[] = $fr->id;
            }
            $score = Score::whereIn('form_rating_id', $fr_id)->where('remark_score_id', 1)->get();
            if ($score->isEmpty()) {
                return redirect()->route('group_members.index')->with('status', 'Essay`s score added successfully');
            }
            foreach ($score as $score) {
                $fr_sc_id[] = $score->form_rating_id;
            }

            $form_rating = Form_rating::whereIn('id', $fr_sc_id)->get();

            return view('super/preparing/essay', compact('group', 'group_member', 'form_rating'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Group_member  $group_member
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group, Group_member $group_member)
    {
        $group_member2 = Group_member::all();
        $all_user = UserModel::where('branch_id', Auth::user()->branch_id)->where('id', '!=', $group->user_id)->orderBy('name', 'asc')->get();

        foreach ($group_member2 as $group_member2) {
            $gm2[] = $group_member2->user_id;
        }
        $member = $all_user->whereIn('remark_id', [3, 4])->whereNotIn('id', $gm2)->all();
        return view('super/preparing/g_memberEdit', compact('group', 'member', 'group_member'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Group_member  $group_member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group, Group_member $group_member)
    {
        $request->validate([
            'member' => 'required'
        ]);
        $user = UserModel::where('id', $request->member)->first();

        $session = Session::where('branch_id', Auth::user()->branch_id)->orderBy('id', 'desc')->first();
        $aplication_file = Aplication_file::where('user_id', $request->member)
            ->where('remark_ap_file_id', 2)
            ->where('session_id', $session->id)
            ->orderBy('id', 'desc')->first();

        if ($aplication_file == null) {
            return redirect('groupss')->with('alert', $user->name . '`s aplication file has not completed yet');
        } else {
            $form_rating = Form_rating::where('aplication_file_id', $aplication_file->id)->get();
            foreach ($form_rating as $form_rating) {
                $fr_id[] = $form_rating->id;
            }
            //fr_id->baru

            $pe_all = Practical_exam::where('group_id', $group->id)->get();
            $practical_exam = $pe_all->whereIn('form_rating_id', $fr_id)->all();
            foreach ($practical_exam as $practical_exam) {
                $pe_id[] = $practical_exam->id;
            }
            $count = count($pe_id);

            Group_member::where('id', $group_member->id)
                ->update([
                    'user_id' => $request->member,
                ]);
            for ($i = 0; $i < $count; $i++) {
                Practical_exam::where('id', $pe_id[$i])
                    ->update([
                        'form_rating_id' => $fr_id[$i]
                    ]);
            }
            return redirect()->route('groups.group_members.index', $group)->with('status', 'Member edited successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Group_member  $group_member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group, Group_member $group_member)
    {
        Group_member::destroy($group_member->id);
        return redirect()->route('groups.group_members.index', $group)->with('status', 'Member deleted successfully');
    }

    public function essay(Group $group, Group_member $group_member, Form_rating $form_rating)
    {
        $score = Score::where('form_rating_id', $form_rating->id)
            ->where('remark_score_id', 1)->orderBy('id', 'desc')->first();
        if ($score == null) {
            return redirect()->route('groups.group_members.index', $group)->with('alert', 'No answer yet from ' . $form_rating->aplication_file->user->name . ' or ' . $form_rating->aplication_file->user->name . '`s essay has already been checked !');
        } else {
            $essay_correction = Essay_correction::where('score_id', $score->id)->get();
            return view('super/preparing/form_rating_gmEssay', compact('group', 'group_member', 'form_rating', 'essay_correction'));
        }
    }
}
