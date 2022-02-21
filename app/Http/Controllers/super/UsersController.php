<?php

namespace App\Http\Controllers\super;

use App\Branch;
use App\Http\Controllers\Controller;
use App\Remark;
use App\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = UserModel::with('Branch')->where('branch_id', Auth::user()->branch_id)->orderBy('name', 'asc')->paginate(20);
        return view('super.manageParticipants.showParticipants', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $remark = Remark::all();

        return view('super.manageParticipants.addParticipant', compact('remark'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'license_id' => 'required',
                'name' => 'required|regex:/^.*(?=.*[A-Z]).*$/',
                'password' => 'required',
                'remark_id' => 'required'
            ],
            [
                'name.regex' => 'Must be uppercase letter'
            ]
        );

        $user = UserModel::where('id', $request->license_id)->first();
        if ($user == null) {
            UserModel::create([
                'id' => $request->license_id,
                'branch_id' => Auth::user()->branch_id,
                'name' => $request->name,
                'password' => bcrypt($request->password),
                'remark_id' => $request->remark_id,
            ]);
            return redirect('/users')->with('status', 'Participant added successfully');
        } else {
            return redirect('/users')->with('alert', 'License Number occupied by another');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserModel  $userModel
     * @return \Illuminate\Http\Response
     */
    public function show(UserModel $userModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserModel  $userModel
     * @return \Illuminate\Http\Response
     */
    public function edit(UserModel $user)
    {
        $remark = Remark::all();
        $branch = Branch::all();

        return view('super.manageParticipants.editParticipant', compact('user', 'remark', 'branch'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserModel  $userModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserModel $user)
    {
        $request->validate(
            [
                'license_id' => 'required',
                'name' => 'required|regex:/^.*(?=.*[A-Z]).*$/',
                'branch_id' => 'required',
                'remark_id' => 'required'
            ],
            [
                'name.regex' => 'Must uppercase letter'
            ]
        );

        UserModel::where('id', $user->id)
            ->update([
                'name' => $request->name,
                'remark_id' => $request->remark_id,
                'branch_id' => $request->branch_id
            ]);

        return redirect('/users')->with('status', 'Participant upadated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserModel  $userModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserModel $user)
    {
        UserModel::destroy($user->id);
        return redirect('/users')->with('status', 'Participant deleted successfully');
    }

    public function search(Request $request)
    {
        $search = $request->keyword;
        $user = UserModel::with('Branch')->where('branch_id', Auth::user()->branch_id)->where('name', 'like', "%{$search}%")->get();

        return view('super/ajax/findParticipant', compact('user'));
    }

    public function user_scores()
    {
        $user = UserModel::with('Branch')->where('branch_id', Auth::user()->branch_id)
            ->whereIn('remark_id', [3, 4])->orderBy('name', 'asc')->get();
        return view('super.score.participant.users', compact('user'));
    }

    public function searching_score(Request $request)
    {
        $search = $request->keyword;
        $user = UserModel::with('Branch')->where('branch_id', Auth::user()->branch_id)->where('name', 'like', "%{$search}%")
            ->whereIn('remark_id', [3, 4])->orderBy('name', 'asc')->get();

        return view('super.ajax.findScores', compact('user'));
    }
}
