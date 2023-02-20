<?php

namespace App\Services\Admin;

use DB;

class BaseService {

    public static function batchUpdate($tablename, $dataarr, $ids) {

        if ($tablename != null && !empty($dataarr) && !empty($ids)) {
            $i = 0;
            foreach ($dataarr as $data) {
                $id = $ids[$i];
                DB::table($tablename)->where('id', $id)->update($data);
                $i++;
            }
            return 1;
        } else {
            return 0;
        }
    }

}
