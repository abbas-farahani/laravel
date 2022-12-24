<?php

namespace App\Http\Controllers\Auth;

use App\Models\ActiveCode;
use App\Notifications\ActiveCodeNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

trait TwoFactorAuthenticate {
    public function loggedin(Request $request, $user){
        if( $user->isTwoFactorAuthenticationEnable() ){
            return $this->logoutAndRedirectToTokenEntry( $request, $user );
        }

        return false;
    }

    public function logoutAndRedirectToTokenEntry(Request $request, $user){
        $phone_number = $request->user()->phone_number;
        auth()->logout(); // Logout Current User

        $request->session()->flash('auth', [
            'user_id'   =>  $user->id,
            'using_sms' =>  false, // Parameter using for each types of 2fa
            'remember'  =>  $request->has('remember')
        ]);

        if( $user->isSmsTwoFactorAuthenticationEnable() ){
            $code = ActiveCode::generateCode($user);

            //TODO Send SMS
            $user->notify(new ActiveCodeNotification($code, $user->phone_number)); // Send SMS to User For Login

            $request->session()->push( 'auth.using_sms', true );
        }

        return redirect(route('2fa.token'));
    }
}
