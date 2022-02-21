<?php

namespace App\Http\Controllers\examinee;

use App\Biodata;
use App\Gender;
use App\Http\Controllers\Controller;
use App\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Empty_;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gender = Gender::all();
        $biodata = Biodata::where('user_id', Auth::id())->first();

        return view('examinee.profil.index', compact('biodata', 'gender'));
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
        $request->validate([
            'height' => 'required',
            'weight' => 'required',
            'alamat' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'rambut' => 'required',
            'mata' => 'required',
            'gender_id' => 'required',
            'kebangsaan' => 'required',
            'email' => 'required'
        ]);

        Biodata::create([
            'user_id' => Auth::id(),
            'place_of_birth' => $request->tempat_lahir,
            'date_of_birth' => $request->tanggal_lahir,
            'address_user' => $request->alamat,
            'nationality' => $request->kebangsaan,
            'english_confirm' => "",
            'height' => $request->height,
            'weight' => $request->weight,
            'hair' => $request->rambut,
            'eyes' => $request->mata,
            'gender_id' => $request->gender_id
        ]);

        UserModel::where('id', Auth::id())
            ->update([
                'email' => $request->email
            ]);


        return redirect('profil')->with('status', 'Profil added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Biodata  $biodata
     * @return \Illuminate\Http\Response
     */
    public function show(Biodata $biodata)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Biodata  $biodata
     * @return \Illuminate\Http\Response
     */
    public function edit(Biodata $biodata)
    {
        $gender = Gender::all();
        $biodata = Biodata::where('user_id', Auth::id())->first();
        return view('examinee.profil.edit', compact('biodata', 'gender'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Biodata  $biodata
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Biodata $biodata)
    {
        $request->validate(
            [
                'name' => 'required|regex:/^.*(?=.*[A-Z]).*$/',
                'height' => 'required',
                'weight' => 'required',
                'alamat' => 'required',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required',
                'rambut' => 'required',
                'mata' => 'required',
                'gender_id' => 'required',
                'kebangsaan' => 'required',
                'email' => 'required'
            ],
            [
                'name.regex' => 'Must be uppercase letter'
            ]
        );

        Biodata::where('user_id', Auth::id())
            ->update([
                'place_of_birth' => $request->tempat_lahir,
                'date_of_birth' => $request->tanggal_lahir,
                'address_user' => $request->alamat,
                'nationality' => $request->kebangsaan,
                'english_confirm' => "",
                'height' => $request->height,
                'weight' => $request->weight,
                'hair' => $request->rambut,
                'eyes' => $request->mata,
                'gender_id' => $request->gender_id
            ]);

        UserModel::where('id', Auth::id())
            ->update([
                'name' => $request->name,
                'email' => $request->email
            ]);

        return redirect('profil')->with('status', 'Profil updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Biodata  $biodata
     * @return \Illuminate\Http\Response
     */
    public function destroy(Biodata $biodata)
    {
        //
    }
}
