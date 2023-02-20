<?php

namespace App\Traits\Admin;

use App\Models\Admin\Email;

trait EmailTrait {

    public static function sendMail($from, $to, $subject, $message) {
        $result = Email::sendMail($from, $to, $subject, $message);
        return $result;
    }

    public static function getRegistrationMailTemplate($username, $email, $password) {
        $result = Email::getRegistrationMailTemplate($username, $email, $password);
        return $result;
    }

    public static function getPasswordResetMailTemplate($resetlink) {
        $result = Email::getPasswordResetMailTemplate($resetlink);
        return $result;
    }

    public static function getMembershipPlanMailTemplate($username, $plan) {
        $result = Email::getMembershipPlanMailTemplate($username, $plan);
        return $result;
    }

    public static function getRenewMembershipMailTemplate($username, $expiry) {
        $result = Email::getRenewMembershipMailTemplate($username, $expiry);
        return $result;
    }

    public static function getMembershipExpiryMailTemplate($username, $expiry, $expflag) {
        $result = Email::getMembershipExpiryMailTemplate($username, $expiry, $expflag);
        return $result;
    }

}
