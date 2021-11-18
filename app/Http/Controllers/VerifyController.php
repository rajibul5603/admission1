<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\SendCode;
use Illuminate\Http\Request;

class VerifyController extends Controller
{
    public function getVerify()
    {
        return view('auth.verify');
    }
    public function postVerify(Request $request)
    {
        if ($user = User::where('code', $request->code)->first()) {
            $user->active = 1;
            $user->code = null;
            $user->save();
            return redirect()->route('login')->withMessage('Your account is active');
        } else {
            return back()->withMessage('Verify code is not correct. Please try again');
        }
    }

    public function resendVerify()
    {
        return view('auth.resendVerification');
    }

    public function RequestForResendCode(Request $request)
    {
        if ($user = User::where('user_contact', $request->user_contact)->where('brid', $request->brid)->where('active','=',0)->first()) {
            $user->code = SendCode::sendCode($user->brid, $user->user_contact);

            if ($user->code)
                $user->update();
            return redirect('/verify?phone=' . $request->user_contact);
        } else {
            return redirect()->back()->withMessage("Please Input Correct Info");
        }
    }
}
