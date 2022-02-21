<?php

namespace App\Http\Controllers;

use App\Password_reset;
use App\UserModel;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    public function getPassword($token)
    {
        return view('otentikasi.resetPassword', compact('token'));
    }

    public function resetPassword($token, Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email|exists:users',
                'password' => 'required',
                'conf_password' => 'required|same:password'
            ],
            [
                'conf_password.required' => 'Retype new password please',
                'conf_password.same' => 'New password and corfirmation password must match'
            ]
        );

        $reset_password = Password_reset::where('email', $request->email)->where('token', $token)->orderBy('created_at', 'desc')->first();
        if ($reset_password == null) {
            return redirect()->route('login')->with('warning', 'Invalid token !');
        }

        UserModel::where('email', $request->email)
            ->update([
                'password' => bcrypt($request->password)
            ]);

        Password_reset::where('email', $request->email)->delete();

        return redirect()->route('login')->with('msg', 'Password edited successfully');
    }
}
