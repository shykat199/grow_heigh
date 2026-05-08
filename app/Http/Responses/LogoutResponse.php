<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LogoutResponse as LogoutResponseContract;
use RealRashid\SweetAlert\Facades\Alert;

class LogoutResponse implements LogoutResponseContract
{
    public function toResponse($request)
    {
        Alert::toast('Logged out successfully!', 'success')->timerProgressBar();

        return redirect()->route('login');
    }
}
