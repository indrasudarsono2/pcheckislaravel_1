<?php

namespace App\Http\Controllers\examinee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Acs_checkController extends Controller
{
    public function index()
    {
        return view('examinee.acsCheck.index');
    }

    public function validation(Request $request)
    {
        $request->validate([
            'question_code' => 'required'
        ]);
    }
}
