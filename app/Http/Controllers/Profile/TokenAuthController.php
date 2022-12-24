<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\ActiveCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class TokenAuthController extends Controller
{
    // First, Check Phone Number and Then View Token Form for Validation User new Phone Number
    public function getPhoneVerify(Request $request){

        if( ! $request->session()->has('phone') ){ // Check 'phone' Session is Exist or not
            alert()->error('Check Phone Number and re-send form', 'Something Wrong!'); // View Error in Next Return
            return redirect(route('profile.2fa'));
        }
        $request->session()->reflash(); // Renew Flashed Session for one more route

        return view('profile.phone-verify');
    }

    // Token Verification for Activation Two-Factor Authentication
    // Verification on Post Method
    public function postPhoneVerify(Request $request){

        $request->validate([ // Input Validation
            'token'  =>  'required'
        ]);

        if( ! $request->session()->has('phone') ){ // Check 'phone' Session is Exist or Not
            alert()->error('Check Phone Number and re-send form', 'Something Wrong!'); // View Error in Next Return
            return redirect(route('profile.2fa'));
        }

        // Check Submitted Code is Valid or Invalid
        $status = ActiveCode::VerifyCode($request->token , $request->user());
        if($status){
            $request->user()->activeCode()->delete(); // Delete All Codes Related to Current User from Database
            $request->user()->update([ // Update Current User Data Table by List in below
                'phone_number' =>  $request->session()->get('phone'),
                'two_factor_type'   =>  'sms'
            ]);
            alert()->success('2FA is Active ', 'Successfully Update!');
        }else{
            alert()->error('2FA is  De-Active ', 'Failed to Update!');
        }


        return redirect(route('profile.2fa'));
    }
}
