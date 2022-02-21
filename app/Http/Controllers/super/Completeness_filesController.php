<?php

namespace App\Http\Controllers\super;

use App\Activity;
use App\Aplication_file;
use App\Completeness_file;
use App\Http\Controllers\Controller;
use App\Provision;
use App\Session;
use App\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Completeness_filesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserModel $user)
    {
        $user_id = $user->id;

        $completeness_file = Completeness_file::where('user_id', $user_id)
            ->where('activity_id', '1')
            ->orderBy('id', 'desc')->get();
        return view('super.preparing.completenessFile', compact('completeness_file'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $aplication_file = Aplication_file::all();
        $provision = Provision::all();
        $activity = Activity::all();
        $session = Session::all();
        return view(
            'super.preparing.addCompleteness',
            compact('aplication_file', 'provision', 'activity', 'session')
        );
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
            'license_id' => 'required',
            'aplication_file_id' => 'required',
            'provision_id' => 'required',
            'activity_id' => 'required',
            'ielp' => 'required',
            'medex' => 'required',
            'control_hours' => 'required',
            'session_id' => 'required'
        ]);

        Completeness_file::create([
            'user_id' => $request->license_id,
            'aplication_file_id' => $request->aplication_file_id,
            'provision_id' => $request->provision_id,
            'activity_id' => $request->activity_id,
            'ielp' => $request->ielp,
            'medex' => $request->medex,
            'control_hours' => $request->control_hours,
            'session_id' => $request->session_id
        ]);

        return redirect('completeness_files')->with('status', 'Completeness file added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Completeness_file  $completeness_file
     * @return \Illuminate\Http\Response
     */
    public function show(UserModel $user)
    {
        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Completeness_file  $completeness_file
     * @return \Illuminate\Http\Response
     */
    public function edit(Completeness_file $completeness_file)
    {
        $aplication_file = Aplication_file::all();
        $provision = Provision::all();
        $activity = Activity::all();
        $session = Session::all();
        return view(
            'super.preparing.editCompleteness',
            compact('completeness_file', 'aplication_file', 'provision', 'activity', 'session')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Completeness_file  $completeness_file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Completeness_file $completeness_file)
    {
        $request->validate([
            'ielp' => 'required',
            'medex' => 'required'
        ]);

        Completeness_file::where('id', $request->completeness_file->id)
            ->update([
                'provision_id' => $request->provision_id,
                'activity_id' => $request->activity_id,
                'ielp' => $request->ielp,
                'medex' => $request->medex,
                'control_hours' => $request->control_hours,
                'session_id' => $request->session_id

            ]);

        return redirect('/find_files')->with('status', 'Completeness file upadated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Completeness_file  $completeness_file
     * @return \Illuminate\Http\Response
     */
    public function destroy(Completeness_file $completeness_file)
    {
        Completeness_file::destroy($completeness_file->id);
        return redirect('completeness_files')->with('status', 'Completeness file deleted successfully');
    }
}
