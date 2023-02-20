<?php

namespace App\Services\Shop;

use Illuminate\Database\Eloquent\Model;
use DB;

class FeedbackService {

    public function getRowCount($tablename, $field, $value, $active, $status) {
        if ($tablename != null) {

            if ($field != null && $value != null) {

                if ($active == null && $status == null) {
                    $whereData = [
                        [$field, '=', $value]
                    ];
                } else if ($active == null && $status != null) {
                    $whereData = [
                        [$field, '=', $value],
                        ['status', '=', $status]
                    ];
                } else if ($active != null && $status == null) {
                    $whereData = [
                        [$field, '=', $value],
                        ['active', '=', $active]
                    ];
                } else if ($active != null && $status != null) {
                    $whereData = [
                        [$field, '=', $value],
                        ['active', '=', $active],
                        ['status', '=', $status]
                    ];
                }

                $count = DB::table($tablename)
                        ->where($whereData)
                        ->count();
                return $count;
            } else if ($field == null && $value == null) {
                if ($active == null && $status == null) {
                    $where = 0;
                } else if ($active == null && $status != null) {
                    $whereData = [
                        ['status', '=', $status]
                    ];
                    $where = 1;
                } else if ($active != null && $status == null) {
                    $whereData = [
                        ['active', '=', $active]
                    ];
                    $where = 1;
                } else if ($active != null && $status != null) {
                    $whereData = [
                        ['active', '=', $active],
                        ['status', '=', $status]
                    ];
                    $where = 1;
                }

                if ($where == 1) {
                    $count = DB::table($tablename)
                            ->where($whereData)
                            ->count();
                } else if ($where == 0) {
                    $count = DB::table($tablename)
                            ->count();
                }
                return $count;
            }
        } else {
            return false;
        }
    }

    public function getAnswer($tablename, $field, $value, $active, $status) {
        if ($tablename != null && $field != null && $value != null) {

            if ($active == null && $status == null) {
                $whereData = [
                    [$field, '=', $value]
                ];
            } else if ($active == null && $status != null) {
                $whereData = [
                    [$field, '=', $value],
                    ['status', '=', $status]
                ];
            } else if ($active != null && $status == null) {
                $whereData = [
                    [$field, '=', $value],
                    ['active', '=', $active]
                ];
            } else if ($active != null && $status != null) {
                $whereData = [
                    [$field, '=', $value],
                    ['active', '=', $active],
                    ['status', '=', $status]
                ];
            }

            $result = DB::table($tablename)
                    ->select('*')
                    ->where($whereData)
                    ->first();

            return $result;
        } else {
            return false;
        }
    }

}
