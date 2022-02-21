<?php

namespace App\Http\Controllers;

use App\Password_reset;
use App\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function forgot_password()
    {
        return view('otentikasi.forgotPassword');
    }

    public function forgot(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);
        $token = Str::random(64);

        Password_reset::create([
            'email' => $request->email,
            'token' => $token,
        ]);

        Mail::send('otentikasi.email', compact('token'), function ($message) use ($request) {
            $message->from('admin@proton.iatca-jakarta.or.id', 'Admin');
            $message->sender('admin@proton.iatca-jakarta.or.id', 'Admin');
            $message->to($request->email);
            $message->subject('(No reply !!!) Reset Password Notification');
        });

        return redirect()->route('login')->with('msg', 'Reset password link already sent to your email address');
    }

    public function password()
    {
        return ("coba");
    }
}
