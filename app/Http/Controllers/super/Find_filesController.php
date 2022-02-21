<?php

namespace App\Http\Controllers\super;

use App\Http\Controllers\Controller;
use App\UserModel;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Empty_;

class Find_filesController extends Controller
{
    public function index()
    {

        $user = UserModel::orderBy('name', 'asc')->get();

        return view('super.preparing.findFile', compact('user'));
    }

    public function search(Request $request)
    {
        // $user = UserModel::where('name', 'LIKE', '%' . $request->search . '%')get();

        // return view('super.ajax.findFile', compact('user'));
        // $search = $request->get('keyword');
        // $user = UserModel::where('name', 'like', '%{$search%}')->get();

        // return view('super.ajax.findFile', compact('user'));
        $search = $request->keyword;
        if ($request->ajax()) {
            $user = UserModel::where('name', 'like', "%{$search}%")->get();

            return view('super.ajax.findFile', compact('user'));
        }
    }
}
