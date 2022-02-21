<?php

namespace App\Http\Controllers\examinee;

use App\Aplication_file;
use App\Http\Controllers\Controller;
use App\License;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Mockery\Undefined;

class LicensesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $license = License::where('user_id', Auth::id())->orderBy('id', 'desc')->get();

        return view('examinee.completeness_files.license.license', compact('license'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('examinee.completeness_files.license.addLicense');
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
            'license' => 'required|file|mimes:pdf,jpg,jpeg,png,svg|max:5000',
            'comment' => 'required'
        ]);

        License::create([
            'user_id' => Auth::id(),
            'comment' => $request->comment,
            'fileUrl' => Storage::put('public/licenses', $request->file('license'))
        ]);

        return redirect()->route('licensess.index')->with('status', 'License ' . $request->comment . ' added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\License  $license
     * @return \Illuminate\Http\Response
     */
    public function show(License $license)
    {
        $extension = explode('.', $license->fileUrl);
        return view('examinee.completeness_files.license.viewLicense', compact('license', 'extension'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\License  $license
     * @return \Illuminate\Http\Response
     */
    public function edit(License $license)
    {
        return view('examinee.completeness_files.license.editLicense', compact('license'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\License  $license
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, License $license)
    {
        if ($request->license_file == null) {
            $request->validate([
                'comment' => 'required',
            ]);

            License::where('id', $license->id)
                ->update([
                    'comment' => $request->comment
                ]);
        } else {

            $request->validate([
                'comment' => 'required',
                'license_file' => 'required|file|mimes:pdf,jpg,jpeg,png,svg|max:5000',
            ]);

            Storage::delete($license->fileUrl);

            License::where('id', $license->id)
                ->update([
                    'comment' => $request->comment,
                    'fileUrl' => Storage::put('public/licenses', $request->file('license_file'))
                ]);
        }

        return redirect()->route('licensess.index')->with('status', 'License ' . $request->comment . ' updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\License  $license
     * @return \Illuminate\Http\Response
     */
    public function destroy(License $license)
    {
        $aplication_file = Aplication_file::where('license_id', $license->id)->get();

        if ($aplication_file->isEmpty()) {
            Storage::delete($license->fileUrl);

            License::destroy($license->id);

            return redirect()->route('licensess.index')->with('status', 'License deleted successfully');
        } else {
            return redirect()->route('licensess.index')->with('alert', 'License "' . $license->comment . '" is being used by Application File and couldn`t be deleted !!!');
        }
    }
}
