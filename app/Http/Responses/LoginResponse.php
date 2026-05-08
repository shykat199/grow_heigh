<?php

namespace App\Http\Responses;

use Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Mail;
use RealRashid\SweetAlert\Facades\Alert;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = $request->user();

        // ✅ If cookie exists → skip OTP
        if (
            $request->cookie('otp_verified') &&
            $request->cookie('otp_verified') == $user->id
        ) {
            return redirect()->intended(config('fortify.home'));
        }

        // ❌ No cookie → send OTP
        $otp = generateOtpCode();

        $user->otp = $otp;
        $user->save();

        Mail::to($user->email)->send(new \App\Mail\LoginOtpMail($otp));

        session(['otp_user_id' => $user->id]);

//        Auth::logout();

//        Alert::toast('OTP Sent Successfully!', 'success')->timerProgressBar();
        Alert::toast('Login Successfully!', 'success')->timerProgressBar();

//        return redirect()->route('otp.form');
        return redirect()->route('admin.dashboard');
    }
}
