<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class TwoStepLoginController extends Controller
{

    public function sendEmail()
    {
        Mail::to('shykat@pfecglobal.com')->send(new \App\Mail\LoginOtpMail('123456'));
    }

    public function showOtpForm()
    {
        if (!Session::has('otp_user_id')) {
            return redirect()->route('login');
        }
        return view('admin.auth.otp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate(['otp' => 'required|numeric']);

        $user = User::find(Session::get('otp_user_id'));

        if (!$user) {
            Alert::toast('User Not Found!', 'danger')->timerProgressBar();
            return redirect()->route('login')->withErrors(['email' => 'User not found']);
        }

        if ($user->otp !== $request->otp) {
            Alert::toast('Invalid OTP!', 'danger')->timerProgressBar();
            return back()->withErrors(['otp' => 'Invalid OTP']);
        }

        // Clear OTP
        $user->otp = null;
        $user->save();


        Cookie::queue(
            cookie('otp_verified', $user->id, 60 * 24 * 7)
        );

        // Log in the user
        Auth::login($user);

        Session::forget('otp_user_id');

        Alert::toast('Successfully Login!', 'success')->timerProgressBar();

        return redirect()->intended(config('fortify.home'));
    }

    public function resend(Request $request)
    {
        $userId = Session::get('otp_user_id');

        if (!$userId) {
            Alert::toast('Session expired. Please login again.', 'error')->timerProgressBar();
            return redirect()->route('login');
        }

        $user = User::find($userId);

        if (!$user) {
            Alert::toast('User not found.', 'error')->timerProgressBar();
            return redirect()->route('login');
        }

        try {
            $otp = generateOtpCode();

            $user->update([
                'otp' => $otp,
            ]);

            Mail::to($user->email)->send(new \App\Mail\LoginOtpMail($otp));

            Alert::toast('OTP resent successfully.', 'success')->timerProgressBar();

            return back();

        } catch (\Exception $e) {

            Log::error('OTP resend failed', [
                'user_id' => $user->id,
                'error' => $e->getMessage(),
            ]);

            Alert::toast('Failed to resend OTP. Try again later.', 'error')->timerProgressBar();
            return back();
        }
    }
}
