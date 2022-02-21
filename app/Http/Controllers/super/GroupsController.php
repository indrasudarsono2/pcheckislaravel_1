<?php

namespace App\Http\Controllers\super;

use App\Group;
use App\Group_history;
use App\Group_member;
use App\Http\Controllers\Controller;
use App\Session;
use App\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;

class GroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $session = Session::where('branch_id', Auth::user()->branch_id)->orderBy('id', 'desc')->first();
        $group = Group::where('branch_id', Auth::user()->branch_id)->where('session_id', $session->id)->get();
        return view('super/preparing/group', compact('group'));
    }

    public function history()
    {
        $group_history = Group::where('branch_id', Auth::user()->branch_id)->onlyTrashed()->get();
        return view('super/preparing/history_group', compact('group_history'));
    }

    public function table()
    {
        $session = Session::where('branch_id', Auth::user()->branch_id)->orderBy('id', 'desc')->first();
        $group = Group::where('session_id', $session->id)->get();
        foreach ($group as $group) {
            $group_id[] = $group->id;
            $group_checker[] = $group->user->name;
        }
        for ($i = 0; $i < count($group_id); $i++) {
            $group_member[] = Group_member::with('user')->where('group_id', $group_id[$i])->get();
        }
        $ceil = ceil(count($group_checker) / 5);
        $count = count($group_checker);

        return view('super.preparing.groupTable', compact('group_member', 'group_checker', 'ceil', 'count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $session = Session::where('branch_id', Auth::user()->branch_id)->orderBy('id', 'desc')->first();
        $group = Group::where('branch_id', Auth::user()->branch_id)->where('session_id', $session->id)->get();
        if ($group->isEMpty()) {
            $checker = UserModel::where('remark_id', 4)
                ->where('branch_id', Auth::user()->branch_id)->orderBy('name', 'asc')->get();
        } else {
            foreach ($group as $group) {
                $gr[] = $group->user_id;
            }
            $user = UserModel::where('remark_id', 4)->where('branch_id', Auth::user()->branch_id)->orderBy('name', 'asc')->get();
            $checker = $user->whereNotIn('id', $gr)->all();
        }
        return view('super/preparing/groupAdd', compact('checker'));
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
            'name' => 'required',
            'checker' => 'required',
        ]);
        $group = $request->name;
        if ($request->name == "TOWER") {
            $group = "TWR";
        }
        $session = Session::where('branch_id', Auth::user()->branch_id)->orderBy('id', 'desc')->first();
        Group::create([
            'name' => $group,
            'user_id' => $request->checker,
            'branch_id' => Auth::user()->branch_id,
            'session_id' => $session->id
        ]);

        return redirect('groupss')->with('status', 'Group added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        $group1 = Group::where('branch_id', Auth::user()->branch_id)->get();
        foreach ($group1 as $group1) {
            $gr[] = $group1->user_id;
        }
        $user = UserModel::where('remark_id', 4)->where('branch_id', Auth::user()->branch_id)->orderBy('name', 'asc')->get();
        $checker = $user->whereNotIn('id', $gr)->all();

        return view('super/preparing/groupEdit', compact('group', 'checker'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        $request->validate([
            'name' => 'required',
            'checker' => 'required'
        ]);

        $group_input = $request->name;
        if ($request->name == "TOWER") {
            $group_input = "TWR";
        }
        Group::where('id', $group->id)
            ->update([
                'name' => $group_input,
            ]);

        return redirect('groupss')->with('status', 'Group edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        Group::destroy($group->id);
        return redirect('groupss')->with('status', 'Group deleted successfully');
    }

    public function delete(Group $group)
    {
        Group_history::destroy($group->id);
        return redirect('groupss')->with('status', 'Group deleted permanently');
    }

    public function print()
    {
        $session = Session::where('branch_id', Auth::user()->branch_id)->orderBy('id', 'desc')->first();
        $group = Group::where('session_id', $session->id)->get();
        foreach ($group as $group) {
            $group_id[] = $group->id;
            $group_checker[] = $group->user->name;
        }
        for ($i = 0; $i < count($group_id); $i++) {
            $group_member[] = Group_member::with('user')->where('group_id', $group_id[$i])->get();
        }
        $ceil = ceil(count($group_checker) / 4);
        $count = count($group_checker);

        $pdf = PDF::loadView('super.print.groupTable', compact(
            'group_member',
            'group_checker',
            'ceil',
            'count'
        ))->setPaper('A4', 'landscape');
        return $pdf->stream('printGroup' . $session->year . '-' . $session->period . '.pdf');
    }
}
