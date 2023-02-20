<?php

namespace App\Traits\Admin;

use App\Models\Admin\Sms;

trait SmsTrait {

    public static function sendSms($phone, $smscontent, $companyid, $password) {
        $result = Sms::sendSms($phone, $smscontent, $companyid, $password);
        return $result;
    }

    public static function getMembershipExpirySmsTemplate($username, $expiry, $expflag) {
        $result = Sms::getMembershipExpirySmsTemplate($username, $expiry, $expflag);
        return $result;
    }

}
