<?php

namespace App\Notifications\Channels;

use Exception;
use Illuminate\Notifications\Notification;

class MaxsmsChannel{


    public function send($notifiable, Notification $notification){


        if( ! method_exists( $notification, 'toSmsProviderChannel' )){
            throw new \Exception('SMSProviderChannel no found ');
        }
        $message = $notification->toSmsProviderChannel($notifiable)['text'];
        $phoneNum = $notification->phoneNumber;
        try {
            $url = "https://ippanel.com/services.jspd";

//            $rcpt_nm = array('9121111111','9122222222');
            $params = array(
                'uname'=>'abbas-farahani',
                'pass'=>'48845_F@rahani',
                'from'=>'5000125475',
                'message'=> $message,
                'to'=>json_encode($phoneNum),
                'op'=>'send'
            );

            $result = $this->cUrl( $url, $params, 'POST' );
            $result2 = json_decode($result);
            $res_code = $result2[0];
            $res_data = $result2[1];

            if ($res_code == '0'){
                $response = $res_data;
            }
        }catch (Exception $e){
            throw $e;
        }

//        // turn off the WSDL cache
//        ini_set("soap.wsdl_cache_enabled", "0");
//        try {
//            $client = new SoapClient("http://ippanel.com/class/sms/wsdlservice/server.php?wsdl");
//            $user = "";
//            $pass = "";
//            $fromNum = "";
//            $toNum = array("9122000000","9210000000");
//            $messageContent = '';
//            $op  = "send";
//            //If you want to send in the future  ==> $time = '2016-07-30' //$time = '2016-07-30 12:50:50'
//
//            $time = '';
//
//            echo $client->SendSMS($fromNum,$toNum,$messageContent,$user,$pass,$time,$op);
//            echo $status;
//        } catch (SoapFault $ex) {
//            echo $ex->faultstring;
//        }
    }

    private function cUrl( $url, $params = array() , $method = 'POST' ) {
        $handler = curl_init('https://ippanel.com/services.jspd');
        curl_setopt($handler, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($handler, CURLOPT_TIMEOUT, 20);
        curl_setopt($handler, CURLOPT_CUSTOMREQUEST, $method);
        if($method == 'POST') curl_setopt($handler, CURLOPT_POSTFIELDS, $params);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($handler);
        if (curl_errno($handler)) {
            $result = curl_error($handler);
            return json_encode(array('-10',$result));
        }
        return $result;
    }
}
