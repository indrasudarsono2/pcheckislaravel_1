<?php

namespace App\Http\Controllers\examinee;

use App\Aplication_file;
use App\Http\Controllers\Controller;
use App\Provision;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProvisionsController extends Controller
{
    public function index()
    {
    }

    public function token(Request $request)
    {
        $token = $request->token;
        $aplication_file = Aplication_file::where('user_id', Auth::id())->where('provision_date', null)
            ->orderBy('id', 'desc')->first();
        $now = Carbon::now();

        $provision = Provision::where('branch_id', Auth::user()->branch_id)->first();
        if ($provision == null) {
            return view('examinee.ajax.provision', compact('aplication_file', 'token'));
        } else {
            if ($provision->token == $token && $now <= $provision->validity) {
                Aplication_file::where('id', $aplication_file->id)
                    ->update([
                        'provision_date' => $now
                    ]);
                $aplication_file = Aplication_file::where('user_id', Auth::id())->where('provision_date', null)
                    ->orderBy('id', 'desc')->first();
            }
            return view('examinee.ajax.provision', compact('aplication_file'));
        }
    }
}
