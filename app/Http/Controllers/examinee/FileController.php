<?php

namespace App\Http\Controllers\examinee;

use App\Aplication_file;
use App\Form_rating;
use App\Http\Controllers\Controller;
use App\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FileController extends Controller
{
    public function index()
    {
        $session = Session::where('branch_id', Auth::user()->branch_id)->orderBy('id', 'desc')->first();

        $ap = Aplication_file::where('user_id', Auth::id())->orderBy('id', 'desc')->where('session_id', $session->id)->get();
        $aplication_file = $ap->whereNotIn('status_id', [3, 5])->first();

        if ($aplication_file == null) {
            return redirect()->route('af.index')->with('alert', 'No check available !');
        } else {
            $fr = Form_rating::where('aplication_file_id', $aplication_file->id)->get();
            $form_rating = $fr->whereNotIn('status_id', [3, 5])->all();
            return view('examinee.performance_check.index', compact('form_rating'));
        }
        // return $form_rating;
    }
}
