<?php

namespace App;

use iqbalhasandev\bulksmsbd\Classes\BulkSMSBD; //this is form BulkSMSBD

class SendCode
{

    // This Code is for Nexmo or Onnorokom SMS API 

    public static function sendCode($brid, $phone)
    {
        $code = rand(1111, 9999);
        // $nexmo = app('Nexmo\Client');
        // $nexmo->message()->send([
        //     'to' => '+880' . (int) $phone,
        //     'from' => '+8801716070696',
        //     'text' => 'Your BRID is' . $brid . '. If it is Alright then Put the Verification code. Your Code is' .  'Verify code: ' . $code,
        // ]);

        $text =  'Are You Sure that Your BRID is ' . $brid . ' . If Answer is Yes Then Use This Code. Verify code: ' . $code;
        $toPhone = '+880' . (int) $phone;
        $data = [
            'message' => $text,
            'mobile_number' => $toPhone,
        ];
        onnorokom_sms($data);
        return $code;
    }

    //This code is for BulKSMSBD Messaging API ... 
    // public static function sendCode($brid, $phone)
    // {
    //     $code = rand(1111, 9999);
    //     $text =  'Your BRID is' . $brid . '. If it is Alright then Put the Verification code. Your Code is' .  'Verify code: ' . $code;
    //     $toPhone = '+880' . (int) $phone;
    //     BulkSMSBD::send($toPhone, $text);
    //     return $code;
    // }




}
