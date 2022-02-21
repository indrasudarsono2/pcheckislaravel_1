<?php

namespace App\Http\Controllers;

use App\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PasswordController extends Controller
{
    public function user()
    {
        if(Auth::user()->remark_id == 3 || Auth::user()->remark_id == 4){
            return view('examinee.profil.password');
        }else{
           return view('super.password');
        }
    }

    public function editUsr(Request $request)
    {

        $request->validate(
            [
                'new_password' => 'required',
                'conf_password' => 'required|same:new_password'
            ],
            [
                'conf_password.required' => 'Retype new password please',
                'conf_password.same' => 'New password and corfirmation password must match'
            ]
        );

        UserModel::where('id', Auth::id())
            ->update([
                'password' => bcrypt($request->new_password)
            ]);

        return redirect()->route('login')->with('msg', 'Password updated successfully');
    }

    public function confirmation(Request $request)
    {
        if (Auth::attempt(['id' => Auth::id(), 'password' => $request->old_password])) {
            if(Auth::user()->remark_id == 3 || Auth::user()->remark_id == 4){
                 return redirect('/passwordusr_edit');
            }else{
                return redirect('/password_edit');
            }
        } else {
            if(Auth::user()->remark_id == 3 || Auth::user()->remark_id == 4){
                return redirect('/password_usr')->with('alert', 'Wrong confirmation password !');
            }else{
                return redirect('/password_')->with('alert', 'Wrong confirmation password !');
            }
        }
    }

    public function edit()
    {   
        if(Auth::user()->remark_id == 3 || Auth::user()->remark_id == 4){
             return view('examinee.profil.passwordedit');
        }else{
           return view('super.passwordedit');
        }
    }
}
