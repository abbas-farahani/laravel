<?php

namespace App\Notifications\Channels;

use Exception;
use Illuminate\Notifications\Notification;
use Melipayamak;

class MeliPayamakChannel{


    public function send($notifiable, Notification $notification){

            try{
                $sms = Melipayamak::sms();
                $to = '09123456789';
                $from = '90001429';
                $text = 'تست وب سرویس ملی پیامک';
                $response = $sms->send($to,$from,$text);
                $json = json_decode($response);
                echo $json->Value; //RecId or Error Number
            }catch(Exception $e){
                throw $e;
            }

//            //GitHub نمونه کدهای
//            $username = 'username';
//            $password = 'password';
//            $api = new MelipayamakApi($username,$password);
//            $sms = $api->sms('soap');
//            $to = '09123456789';
//            $from = '5000...';
//            $text = 'تست وب سرویس ملی پیامک';
//            $isFlash = false;
//            $smsRest->send($to,$from,$text,$isFlash);
//
//            //بدون نیاز به پکیج گیت هاب Procedural PHP نمونه کدهای
//            ini_set("soap.wsdl_cache_enabled",0);
//            $sms = new SoapClient("http://api.payamak-panel.com/post/Send.asmx?wsdl",array("encoding"=>"UTF-8"));
//            $data = array("username"=>"" ,
//                "password"=>"",
//                "to"=>array(""),
//                "from"=>"",
//                "text"=>"",
//                "isflash"=>false);
//            $result = $sms->SendSimpleSMS($data)->SendSimpleSMSResult;
    }

}
