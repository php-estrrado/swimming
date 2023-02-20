<?php

namespace App\Models\Admin;

use DB;

class Email extends Base {

    public static function sendMail($from = null, $to = null, $subject = null, $message = null) {

        if (getSiteName() != "") {
            $system_name = getSiteName();
        } else {
            $system_name = "Bizz Salon";
        }

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: ' . $system_name . '<' . $from . '>' . "\r\n";
        $headers .= "Reply-To: " . $system_name . '<' . $from . '>' . "\r\n";
        $headers .= "Return-Path: " . $system_name . '<' . $from . '>' . "\r\n";
        $headers .= "X-Priority: 3\r\n";
        $headers .= "X-Mailer: PHP" . phpversion() . "\r\n";
        $headers .= "Organization: " . $system_name . "\r\n";
        $result = @mail($to, $subject, $message, $headers, "-f " . $from);
        if ($result) {
            return 1;
        } else {
            return 0;
        }
    }

    public static function getRegistrationMailTemplate($username, $email, $password) {

        $whereData = [
            ['identifier', '=', 'admin_welcome_email'],
            ['active', '=', 1],
            ['status', '=', 1]
        ];

        $mailContent = DB::table('email_template')
                ->where($whereData)
                ->first();

        if ($mailContent) {

            $description = $mailContent->description;

            $msg1 = str_replace('{{User}}', $username, $description);
            $msg2 = str_replace('{{EmailId}}', $email, $msg1);
            $msg = str_replace('{{Password}}', $password, $msg2);
        } else {
            $msg = '<h4>Welcome.. ' . $username . ' </h4>';
            $msg .= '<p>Thanks for registering with ' . getSiteName() . '</p>';
            $msg .= '<p>Email Id: ' . $email . '</p>';
            $msg .= '<p>Password: ' . $password . '</p>';
        }
        return $msg;
    }

    public static function getPasswordResetMailTemplate($resetlink) {

        $whereData = [
            ['identifier', '=', 'admin_reset_password_link'],
            ['active', '=', 1],
            ['status', '=', 1]
        ];

        $mailContent = DB::table('email_template')
                ->where($whereData)
                ->first();

        if ($mailContent) {

            $description = $mailContent->description;

            $msg = str_replace('{{Link}}', $resetlink, $description);
        } else {
            $msg .= "Hi, " . getSiteName() . " Admin, Reset Password Link: " . $resetlink . "";
        }
        return $msg;
    }

    public static function getMembershipPlanMailTemplate($username, $plan) {

        $whereData = [
            ['identifier', '=', 'membership_plan_change'],
            ['active', '=', 1],
            ['status', '=', 1]
        ];

        $mailContent = DB::table('email_template')
                ->where($whereData)
                ->first();

        if ($mailContent) {

            $description = $mailContent->description;

            $msg1 = str_replace('{{User}}', $username, $description);
            $msg = str_replace('{{plan}}', $plan, $msg1);
        } else {
            $msg .= "Hi, " . $username . " Your Membership Plan has been changed to " . $plan . "";
        }
        return $msg;
    }

    public static function getRenewMembershipMailTemplate($username, $expiry) {

        $whereData = [
            ['identifier', '=', 'membership_renewal'],
            ['active', '=', 1],
            ['status', '=', 1]
        ];

        $mailContent = DB::table('email_template')
                ->where($whereData)
                ->first();

        if ($mailContent) {

            $description = $mailContent->description;

            $msg1 = str_replace('{{User}}', $username, $description);
            $msg = str_replace('{{expiry}}', $expiry, $msg1);
        } else {
            $msg .= "Hi, " . $username . " Your Membership Plan has been extended to " . $expiry . "";
        }
        return $msg;
    }

    public static function getMembershipExpiryMailTemplate($username, $expiry, $expflag) {

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

        $mailContent = DB::table('email_template')
                ->where($whereData)
                ->first();

        if ($mailContent) {

            $description = $mailContent->description;

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
