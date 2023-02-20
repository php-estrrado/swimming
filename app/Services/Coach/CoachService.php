<?php

namespace App\Services\Coach;

use Illuminate\Database\Eloquent\Model;
use DB;

class CoachService {

    public static function getAllRows($tablename, $field, $order, $active, $status) {

        //DB::enableQueryLog();

        if ($tablename != null && $field != null && $order != null) {

            if ($active == null && $status == null) {
                $where = 0;
            } else if ($active == null && $status != null) {
                $where = 1;
                $whereData = [
                    ['status', '=', $status]
                ];
            } else if ($active != null && $status == null) {
                $where = 1;
                $whereData = [
                    ['active', '=', $active]
                ];
            } else if ($active != null && $status != null) {
                $where = 1;
                $whereData = [
                    ['active', '=', $active],
                    ['status', '=', $status]
                ];
            }

            if ($where == 0) {
                $result = DB::table($tablename)
                        ->select('*')
                        ->orderBy($field, $order)
                        ->get();
            } else if ($where == 1) {
                $result = DB::table($tablename)
                        ->select('*')
                        ->where($whereData)
                        ->orderBy($field, $order)
                        ->get();
            }

            //dd(DB::getQueryLog());
            //die();

            return $result;
        } else {
            return false;
        }
    }

    public static function getRows($tablename, $field, $value, $active, $status) {
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
                    ->get();
            return $result;
        } else {
            return false;
        }
    }

    public static function getRow($tablename, $field, $value, $active, $status) {
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

    public static function saveRow($tablename, $field, $value, $data) {
        if ($value != 'new') {

            $active = "";
            $status = "";

            $count = self::getRowCount($tablename, $field, $value, $active, $status);

            if ($count > 0) {
                DB::beginTransaction();
                try {
                    DB::table($tablename)->where($field, $value)->update($data);
                    DB::commit();
                    return 1;
                } catch (Exception $ex) {
                    DB::rollback();
                }
            } else {
                return 0;
            }
        } else {
            DB::beginTransaction();
            try {
                $result = DB::table($tablename)->insertGetId($data);
                DB::commit();
                return $result;
            } catch (Exception $ex) {
                DB::rollback();
            }
        }
    }

    public static function deleteRows($tablename, $field, $values, $type, $sort) {
        DB::beginTransaction();
        try {

            if ($type == 1) {

                if ($sort == 0) {
                    $data = [
                        'status' => 0,
                        'sort' => $sort
                    ];
                } else if ($sort == 1) {
                    $data = [
                        'status' => 0
                    ];
                }

                DB::table($tablename)->whereIn($field, $values)->update($data);
            } else if ($type == 2) {
                DB::table($tablename)->whereIn($field, $values)->delete();
            }
            DB::commit();
            return true;
        } catch (Exception $ex) {
            DB::rollback();
        }
    }

    public static function deleteRow($tablename, $field, $value, $type, $sort) {
        DB::beginTransaction();
        try {
            if ($type == 1) {

                if ($sort == 0) {
                    $data = [
                        'status' => 0,
                        'sort' => $sort
                    ];
                } else if ($sort == 1) {
                    $data = [
                        'status' => 0
                    ];
                }

                DB::table($tablename)->where($field, $value)->update($data);
            } else if ($type == 2) {
                DB::table($tablename)->where($field, $value)->delete();
            }
            DB::commit();
            return true;
        } catch (Exception $ex) {
            DB::rollback();
        }
    }

    public static function getRowCount($tablename, $field, $value, $active, $status) {
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

    public static function checkStatus($tablename, $field, $value, $id) {
        if ($tablename != null && $field != null && $value != null && $id != null) {

            $whereData = [
                [$field, '=', $value],
                ['id', '=', $id]
            ];

            $count = DB::table($tablename)
                    ->where($whereData)
                    ->count();

            return $count;
        } else {
            return false;
        }
    }

    public static function changeStatus($tablename, $userid, $status) {

        $data = [
            'active' => $status
        ];

        DB::beginTransaction();
        try {
            DB::table($tablename)->where('id', $userid)->update($data);
            DB::commit();
            return 1;
        } catch (Exception $ex) {
            DB::rollback();
        }
    }

}
