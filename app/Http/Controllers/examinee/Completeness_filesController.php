<?php

namespace App\Http\Controllers\examinee;

use App\Completeness_file;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Completeness_filesController extends Controller
{
    public function show()
    {
        $completeness_file = Completeness_file::where('user_id', Auth::id())->orderBy('id', 'desc')->get();
        return view('examinee.completeness_files.completenessFile', compact('completeness_file'));
    }
}
