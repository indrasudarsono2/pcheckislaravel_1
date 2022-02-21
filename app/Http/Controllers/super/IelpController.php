<?php

namespace App\Http\Controllers\super;

use App\Http\Controllers\Controller;
use App\Ielp;
use App\UserModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;

class IelpController extends Controller
{
    public function index()
    {
        $three = Carbon::now()->addMonth(3);
        $six = Carbon::now()->addMonth(6);
        $nine = Carbon::now()->addMonth(9);
        $user =  UserModel::where('branch_id', Auth::user()->branch_id)
            ->where('remark_id', '!=', [1, 2])->orderBy('name', 'asc')->get();
        foreach ($user as $user) {
            $usr_id[] = $user->id;
        }
        $count = count($usr_id);

        for ($i = 0; $i < $count; $i++) {
            $ielp[] = Ielp::with('user')->where('user_id', $usr_id[$i])
                ->orderBy('id', 'desc')
                ->limit(1)
                ->get();
            if ($ielp[$i]->isEmpty()) {
                unset($ielp[$i]);
            }
        }
        $ielp2 = array_values($ielp);
        $count_ielp =  count($ielp2);
        $no = 1;
        return view('super.data.ielp', compact('ielp2', 'count', 'count_ielp', 'no', 'three', 'six', 'nine'));
    }
    
    public function search(Request $request)
    {
        $three = Carbon::now()->addMonth(3);
        $six = Carbon::now()->addMonth(6);
        $nine = Carbon::now()->addMonth(9);
        $search = $request->keyword;
        $user =  UserModel::where('branch_id', Auth::user()->branch_id)->where('name', 'like', "%{$search}%")
            ->where('remark_id', '!=', [1, 2])->orderBy('name', 'asc')->get();

        foreach ($user as $user) {
            $usr_id[] = $user->id;
        }
        $count = count($usr_id);

        for ($i = 0; $i < $count; $i++) {
            $ielp[] = Ielp::with('user')->where('user_id', $usr_id[$i])
                ->orderBy('id', 'desc')
                ->limit(1)
                ->get();
            if ($ielp[$i]->isEmpty()) {
                unset($ielp[$i]);
            }
        }
        $ielp2 = array_values($ielp);
        $count_ielp =  count($ielp2);
        $no = 1;
        return view('super.ajax.findIelp', compact('ielp2', 'count', 'count_ielp', 'no', 'three', 'six', 'nine'));
    }
    
    public function print()
    {
        $now = Carbon::now()->format('d-m-y H:i:s');
        $three = Carbon::now()->addMonth(3);
        $six = Carbon::now()->addMonth(6);
        $nine = Carbon::now()->addMonth(9);
        $user =  UserModel::where('branch_id', Auth::user()->branch_id)
            ->where('remark_id', '!=', [1, 2])->orderBy('name', 'asc')->get();
        foreach ($user as $user) {
            $usr_id[] = $user->id;
        }
        $count = count($usr_id);

        for ($i = 0; $i < $count; $i++) {
            $ielp[] = Ielp::with('user')->where('user_id', $usr_id[$i])
                ->orderBy('id', 'desc')
                ->limit(1)
                ->get();
            if ($ielp[$i]->isEmpty()) {
                unset($ielp[$i]);
            }
        }

        $ielp2 = array_values($ielp);
        $count_ielp =  count($ielp2);
        $no = 1;

        $pdf = PDF::loadview('super.print.ielpTable', compact(
            'ielp2',
            'count',
            'count_ielp',
            'no',
            'three',
            'six',
            'nine'
        ))->setPaper('A4', 'Portrait');

        return $pdf->stream('printIelp-' . $now . '-.pdf');
    }
}
