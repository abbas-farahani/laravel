<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ActiveCode;
use App\Models\User;
use Illuminate\Http\Request;

class AuthTokenController extends Controller
{

    public function getToken(Request $request){
        if( ! $request->session()->has('auth')){ // Redirect If 'auth' Session is not Available
            return redirect('login');
        }

        $request->session()->reflash(); // Renew Flashed Session for one more route

        return view('auth.token');
    }


    public function postToken(Request $request){
        $request->validate([ // Input Validation
            'token'  =>  'required'
        ]);

        if( ! $request->session()->has('auth')){ // Redirect If 'auth' Session is not Available
            return redirect('login');
        }

        $user = USER::findOrFail( $request->session()->get('auth.user_id') ); // Get and keep user id from Session

        $status = ActiveCode::verifyCode( $request->token, $user ); // Return True/False when Check '$user' is Token owner
        if( ! $status ){
            alert()->error('Token isn\'t Valid', 'Login Failed!');
            return redirect('login');
        }

        if( auth()->loginUsingId( $user->id, $request->session()->get('auth.remember') ) ){ // Token Validate Successfully
            $user->activeCode()->delete();
            alert()->success('Login Successfully!', 'Login Successfully!');
            return redirect('profile');
        }

        return redirect('login');
    }
}
