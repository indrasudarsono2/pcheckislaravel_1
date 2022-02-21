<?php

namespace App\Http\Controllers\otentikasi;

use App\Aplication_file;
use App\Biodata;
use App\Http\Controllers\Controller;
use App\Ielp;
use App\Medex;
use App\Schedule;
use Illuminate\Http\Request;
use App\User;
use App\UserModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class OtentikasiController extends Controller
{
    public function index()
    {
        return view('otentikasi.login');
    }

    public function dummy()
    {
        $date = '2022-03-01';
        // $fourty = Carbon::now()->subYear(40);
        $fourty =  Carbon::createFromFormat('Y-m-d', $date)->subYear(40)->format('Y-m-d');

        $biodata = Biodata::with('user')->where('date_of_birth', '>=', $fourty)->get();
        // $biodata = Biodata::with('user')->where('user_id', 2195)->first();
        // return Carbon::parse($biodata->date_of_birth)->diff(Carbon::parse($date))->format('%y tahun %m bulan  %d hari');
        foreach ($biodata as $biodata) {
            $user_id[] = $biodata->user_id;
        }

        $remark[] = [1, 2];

        $user =  UserModel::whereIn('id', $user_id)->whereNotIn('remark_id',  $remark)->orderBy('name', 'asc')->get();
        foreach ($user as $user) {
            $usr_id[] = $user->id;
            $name_user[] = $user->name . "-" . $user->id;
        }

        $count = count($usr_id);

        for ($i = 0; $i < $count; $i++) {
            $medex[] = Medex::with('user')->where('user_id', $usr_id[$i])
                ->whereBetween('expired', ['2022-03-01', '2022-12-31'])
                ->get();
            if ($medex[$i]->isEmpty()) {
                unset($medex[$i]);
            }
        }

        $medex2 = array_values($medex);

        for ($j = 0; $j < count($medex2); $j++) {
            $name[] = $medex2[$j][0]->user->name;
            $id[] = $medex2[$j][0]->user_id;
            $nameId[] =  $medex2[$j][0]->user->name . "-" . $medex2[$j][0]->user_id . "-" . $medex2[$j][0]->expired->format('d F Y');
            $emailReceiver[] = $medex2[$j][0]->user->email;
            $expired = $medex2[$j][0]->expired;
        }
        // return $expired;
        return $nameId;
        return Carbon::parse($expired)->addDay(730)->format('Y-m-d');
    }

    public function home()
    {
        $user = UserModel::with('branch')->where('branch_id', Auth::user()->branch_id)->orderBy('name', 'asc')->paginate(20);
        return view('super.index', compact('user'));
    }

    public function examinee()
    {
        $ielp = Ielp::where('user_id', Auth::id())->orderBy('id', 'desc')->first();
        if ($ielp == null) {
            $ielp = Ielp::find(1);
        }

        $medex = Medex::where('user_id', Auth::id())->orderBy('id', 'desc')->first();
        if ($medex == null) {
            $medex = Medex::find(1);
        }

        $schedule = Schedule::where('branch_id', Auth::user()->branch_id)->first();
        if ($schedule == null) {
            $schedule = Schedule::find(1);
        }

        $aplication_file = Aplication_file::where('user_id', Auth::id())->where('provision_date', null)
            ->orderBy('id', 'desc')->first();

        return view('examinee.index', compact('ielp', 'medex', 'schedule', 'aplication_file'));
    }

    public function login(Request $request)
    {
        $remember = $request->remember ? true : false;

        // dd($request->all());
        if (Auth::attempt([
            'id' => $request->license_number, 'password' => $request->password, 'remark_id' => 1
        ], $remember)) {
            // $user = UserModel::where('license_id', $request->license_number);
            return redirect('/super');
        } else if (Auth::attempt([
            'id' => $request->license_number, 'password' => $request->password, 'remark_id' => 2
        ], $remember)) {
            // $user = UserModel::where('license_id', $request->license_number);
            return redirect('/super');
        } else if (
            Auth::attempt([
                'id' => $request->license_number, 'password' => $request->password, 'remark_id' => 3
            ], $remember) ||
            Auth::attempt([
                'id' => $request->license_number, 'password' => $request->password, 'remark_id' => 4
            ], $remember)
        ) {
            // $user = UserModel::where('license_id', $request->license_number);
            return redirect('/examinee');
        } else {
            return redirect('/')->with('message', 'Wrong license number or password');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect('/');
    }
}
