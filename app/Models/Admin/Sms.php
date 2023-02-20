<?php

namespace App\Models\Admin;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use DB;

class Sms extends Base {

    public static function sendSms($phone = null, $smscontent = null, $companyid = null, $password = null) {

        $client = new Client();
        $smsapi = "http://119.235.1.63:4050/Sms.svc/SendSms?phoneNumber=" . $phone . "&smsMessage=" . $smscontent . "&companyId=" . $companyid . "&pword=" . $password . "";
        $response = $client->request("GET", $smsapi);
        $statuscode = $response->getStatusCode();
        $body = $response->getBody();
        $bodycontents = $body->getContents();

        if ($statuscode == 200) {
            return $bodycontents;
        } else {
            return false;
        }
    }
    public static function sendSms1($phone = null, $smscontent = null, $companyid = null, $password = null) {

        $message = urlencode($smscontent);
            $curl                   =   curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL         => "http://sms.estrrado.com/sendsms?uname=Poetrl&pwd=sms4poetrl&senderid=Poetrl&to=8973732732&msg=$message&route=T",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING    =>  "",
                CURLOPT_MAXREDIRS   =>  10,
                CURLOPT_TIMEOUT     =>  30,
                CURLOPT_HTTP_VERSION=>  CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST=> "GET",
            ));
            $response               =   curl_exec($curl);
            $err                    =   curl_error($curl);
            curl_close($curl);
            if ($err) { return "cURL Error #:" . $err; } else { return $response; }
    }

    public static function getMembershipExpirySmsTemplate($username, $expiry, $expflag) {

        if ($expflag == 1) {
            $identifier = 'membership_expiry';
        } else if ($expflag == 0) {
            $identifier = 'membership_expired';
        }

        $whereData = [
            ['identifier', '=', $identifier],
            ['active', '=', 1],
            ['status', '=', 1]
        ];

        $smsContent = DB::table('sms_template')
                ->where($whereData)
                ->first();

        if ($smsContent) {

            $description = $smsContent->description;

            $msg1 = str_replace('{{User}}', $username, $description);
            $msg = str_replace('{{expiry}}', $expiry, $msg1);
        } else {
            if ($expflag == 1) {
                $msg .= "Hi, " . $username . ", Your Membership Plan will expire soon. Expiry Date: " . $expiry . "";
            } else if ($expflag == 0) {
                $msg .= "Hi, " . $username . ", Your Membership Plan has been expired on " . $expiry . "";
            }
        }
        return $msg;
    }

}
