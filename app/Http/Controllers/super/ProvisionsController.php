<?php

namespace App\Http\Controllers\super;

use App\Http\Controllers\Controller;
use App\Provision;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProvisionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provision =  Provision::where('branch_id', Auth::user()->branch_id)->get();

        return view('super.preparing.provision', compact('provision'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('super.preparing.provisionAdd');
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
            'token' => 'required',
            'validity' => 'required'
        ]);

        Provision::create([
            'token' => $request->token,
            'validity' => $request->validity,
            'branch_id' => Auth::user()->branch_id
        ]);

        return redirect()->route('provisions.index')->with('status', 'Provision added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Provision  $provision
     * @return \Illuminate\Http\Response
     */
    public function show(Provision $provision)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Provision  $provision
     * @return \Illuminate\Http\Response
     */
    public function edit(Provision $provision)
    {
        return view('super.preparing.provisionEdit', compact('provision'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Provision  $provision
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Provision $provision)
    {
        $request->validate([
            'token' => 'required',
            'validity' => 'required'
        ]);

        Provision::where('id', $provision->id)
            ->update([
                'token' => $request->token,
                'validity' => $request->validity,
            ]);

        return redirect()->route('provisions.index')->with('status', 'Provision edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Provision  $provision
     * @return \Illuminate\Http\Response
     */
    public function destroy(Provision $provision)
    {
        //
    }
}
