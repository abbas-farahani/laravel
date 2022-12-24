<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    use TwoFactorAuthenticate;

    public function redirect(){
        return Socialite::driver('google')->redirect();
    }

    public function callback(Request $request){

        try {

            $google_user = Socialite::driver('google')->user();
            $user = User::where( 'email', $google_user->email )->first();

            if( ! $user ){
                $user = User::create([
                    'name' => $google_user->name,
                    'email' =>  $google_user->email,
                    'password'  =>  bcrypt(\Str::random(16)),
                    'two_factor_type'   =>  'off'
                ]);
            }

            if( ! $user->hasVerifiedEmail() ){
                $user->markEmailAsVerified();
            }
            auth()->loginUsingId($user->id);

            return $this->loggedin( $request, $user ) ?: redirect('profile');

        } catch (\Exception $e){
            //TODO Log Error Messages

            alert()->success('خطایی به هنگام ورود به حساب کاربری رخ داد.', 'ورود ناموفق')->persistent('باشه');
            return redirect('/login');
        }
//        return 'test';
    }
}
