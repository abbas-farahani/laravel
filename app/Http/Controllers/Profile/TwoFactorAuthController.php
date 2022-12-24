<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\ActiveCode;
use App\Notifications\ActiveCodeNotification;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;

class TwoFactorAuthController extends Controller
{
    public function manageTwoFactorAuth(){
        return view('profile.2fa');
    }


    public function postManageTwoFactorAuth(Request $request){

        $data = $this->requestDataValidation($request);

        if($this->isRequestTypeSms($data['type'])) {

            if( $request->user()->phone_number !== $data['phone'] ){ // Check New Phone Number is the Same as (Equal to) Existing Number in User Data Table phone_number

                return $this->generateAndSendSmsCode($request, $data['phone']);

            }else{
                $request->user()->update([
                    'two_factor_type' => 'sms'
                ]);
            }

        }

        if( $this->isRequestTypeOff($data['type']) ) {
            $request->user()->update([
                'two_factor_type' => 'off'
            ]);
        }

        return back();
    }

    /**
     * @param Request $request
     * @return array
     */
    private function requestDataValidation(Request $request){
        $data = $request->validate([ // Input Validation
            'type' => 'required|in:sms,off',
            'phone' => ['required_unless:type,off', Rule::unique('users', 'phone_number')->ignore($request->user()->id, 'id')]
        ]);
        return $data;
    }


    /**
     * @param $type
     * @return bool
     */
    private function isRequestTypeOff($type): bool
    {
        return $type === 'off';
    }


    /**
     * @param $type
     * @return bool
     */
    private function isRequestTypeSms($type): bool
    {
        return $type === 'sms';
    }


    /**
     * @param Request $request
     * @param $phone
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    private function generateAndSendSmsCode(Request $request, $phone)
    {
        $code = ActiveCode::GenerateCode($request->user()); // Generate New Code
        $request->session()->flash('phone', $phone); // Keep and Store Phone Number by Session

        // Send Code to user
        $request->user()->notify(new ActiveCodeNotification($code, $phone));

        // return $code;
        return redirect(route('profile.2fa.phone'));
    }

}
