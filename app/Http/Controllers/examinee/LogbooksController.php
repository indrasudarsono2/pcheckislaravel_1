<?php

namespace App\Http\Controllers\examinee;

use App\Aplication_file;
use App\Http\Controllers\Controller;
use App\Log_book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LogbooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logbook = Log_book::where('user_id', Auth::id())->orderBy('id', 'desc')->get();
        return view('examinee.completeness_files.logbook.logbook', compact('logbook'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('examinee.completeness_files.logbook.addLogbook');
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
            'comment' => 'required',
            'logbook' => 'required|file|mimes:pdf|max:5000',
        ]);

        Log_book::create([
            'user_id' => Auth::id(),
            'comment' => $request->comment,
            'fileUrl' => Storage::put('public/logbooks', $request->file('logbook'))
        ]);

        return redirect()->route('logbookss.index')->with('status', 'Log Book ' . $request->comment . ' added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Log_book  $log_book
     * @return \Illuminate\Http\Response
     */
    public function show(Log_book $logbook)
    {
        return view('examinee.completeness_files.logbook.viewLogbook', compact('logbook'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Log_book  $log_book
     * @return \Illuminate\Http\Response
     */
    public function edit(Log_book $logbook)
    {
        return view('examinee.completeness_files.logbook.editLogbook', compact('logbook'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Log_book  $log_book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Log_book $logbook)
    {
        if ($request->logbook_file == null) {
            $request->validate([
                'comment' => 'required'
            ]);

            Log_book::where('id', $logbook->id)
                ->update([
                    'comment' => $request->comment
                ]);
        } else {
            $request->validate([
                'comment' => 'required',
                'logbook_file' => 'required|file|mimes:pdf|max:5000'
            ]);

            Storage::delete($logbook->fileUrl);

            Log_book::where('id', $logbook->id)
                ->update([
                    'comment' => $request->comment,
                    'fileUrl' => Storage::put('public/logbooks', $request->file('logbook_file'))
                ]);
        }

        return redirect()->route('logbookss.index')->with('status', 'Log Book edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Log_book  $log_book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Log_book $logbook)
    {
        $aplication_file = Aplication_file::where('logbook_id', $logbook->id)->get();

        if ($aplication_file->isEmpty()) {
            Storage::delete($logbook->fileUrl);

            Log_book::destroy($logbook->id);

            return redirect()->route('logbookss.index')->with('status', 'Log Book deleted successfully');
        } else {
            return redirect()->route('logbookss.index')->with('alert', 'Log Book "' . $logbook->comment . '" is being used by Application File and couldn`t be deleted !!!');
        }
    }
}
