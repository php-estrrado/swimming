<?php

namespace App\Services\Admin;

use DB;

class SettingsService {

    public function getSmsRequestCount($userid) {

        $whereData = [
            ['status', '=', 1],
            ['request_status', '=', 1],
            ['user_id', '=', $userid]
        ];

        $count = DB::table('sms_package_users')
                ->where($whereData)
                ->count();

        return $count;
    }

}
