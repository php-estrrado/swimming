<?php

namespace App\Models\Admin;

use App\Services\Admin\BaseService as BaseService;
use DB;

class User extends Base {

    public function getUsers($args) {

        switch ($args['type']) {
            case 1:

                $whereData = [];
                $where = $wherebtw = 0;
                $fromfilterdate = $tofilterdate = $filterfield = "";

                if (isset($args['type']) && $args['type'] != null) {
                    $where = 1;
                    $usertype = ['users.user_type', '=', $args['type']];
                    array_push($whereData, $usertype);
                }

                if (isset($args['active']) && $args['active'] != null) {
                    $where = 1;
                    $uactive = ['users.active', '=', $args['active']];
                    array_push($whereData, $uactive);
                }

                if (isset($args['status']) && $args['status'] != null) {
                    $where = 1;
                    $ustatus = ['users.status', '=', $args['status']];
                    $udstatus = ['user_details.status', '=', $args['status']];
                    array_push($whereData, $ustatus);
                    array_push($whereData, $udstatus);
                }

                if (isset($args['membership']) && $args['membership'] !== "") {
                    $where = 1;
                    if ($args['membership'] == 0) {
                        $membership = ['users.membership', '=', 0];
                        array_push($whereData, $membership);
                    } else if ($args['membership'] == 1) {
                        $membership = ['users.membership', '!=', 0];
                        array_push($whereData, $membership);
                    }
                }

                if (isset($args['fromfilterdate']) && isset($args['tofilterdate'])) {
                    $wherebtw = 1;
                    $datefilter = $args['datefilter'];
                    $fromfilterdate = $args['fromfilterdate'];
                    $tofilterdate = dateAdd($args['tofilterdate'], "1 day");

                    if ($datefilter == 1) {
                        $filterfield = "users.created_at";
                    } else if ($datefilter == 2) {
                        $filterfield = "users.expire_date";
                    }
                }

                $users = DB::table('users')
                        ->leftJoin('user_details', 'users.id', '=', 'user_details.user_id')
                        ->leftJoin('membership_plans', 'users.membership', '=', 'membership_plans.id')
                        ->leftJoin('membership', 'membership.id', '=', 'membership_plans.membership_id')
                        ->select('*', 'users.id as uid', 'users.active as uactive', 'user_details.name as uname', 'membership.name as mname')
                        ->when($where, function($query) use ($whereData) {
                            return $query->where($whereData);
                        })
                        ->when($wherebtw, function($query) use ($filterfield, $fromfilterdate, $tofilterdate) {
                            return $query->whereBetween($filterfield, [$fromfilterdate, $tofilterdate]);
                        })
                        ->orderBy('users.id', 'desc')
                        ->get();

                break;
            case 2:

                if ($args['active'] == null && $args['status'] == null) {
                    $where = 0;
                } else if ($args['active'] == null && $args['status'] != null) {
                    $where = 1;
                    $whereData = [
                        ['customers.status', '=', $args['status']],
                        ['users.status', '=', $args['status']],
                        ['user_details.status', '=', $args['status']]
                    ];
                } else if ($args['active'] != null && $args['status'] == null) {
                    $where = 1;
                    $whereData = [
                        ['customers.active', '=', $args['active']],
                        ['users.active', '=', $args['active']]
                    ];
                } else if ($args['active'] != null && $args['status'] != null) {
                    $where = 1;
                    $whereData = [
                        ['customers.active', '=', $args['active']],
                        ['users.active', '=', $args['active']],
                        ['customers.status', '=', $args['status']],
                        ['users.status', '=', $args['status']],
                        ['user_details.status', '=', $args['status']]
                    ];
                }

                if ($where == 0) {
                    $users = DB::table('customers')
                            ->leftJoin('users', 'customers.user_id', '=', 'users.id')
                            ->leftJoin('user_details', 'users.id', '=', 'user_details.user_id')
                            ->select('*', 'customers.id as cid', 'customers.user_id as company_id', 'customers.name as cname', 'customers.email as cemail', 'customers.phone as cphone', 'customers.password as cpassword', 'customers.active as cactive', 'users.id as uid', 'users.email as uemail', 'users.phone as uphone', 'users.active as uactive', 'user_details.name as uname', 'customers.created_at as ccreated_at')
                            ->orderBy('customers.id', 'desc')
                            ->get();
                } else if ($where == 1) {
                    $users = DB::table('customers')
                            ->leftJoin('users', 'customers.user_id', '=', 'users.id')
                            ->leftJoin('user_details', 'users.id', '=', 'user_details.user_id')
                            ->select('*', 'customers.id as cid', 'customers.user_id as company_id', 'customers.name as cname', 'customers.email as cemail', 'customers.phone as cphone', 'customers.password as cpassword', 'customers.active as cactive', 'users.id as uid', 'users.email as uemail', 'users.phone as uphone', 'users.active as uactive', 'user_details.name as uname', 'customers.created_at as ccreated_at')
                            ->where($whereData)
                            ->orderBy('customers.id', 'desc')
                            ->get();
                }

                break;
            case 3:

                if ($args['active'] == null && $args['status'] == null) {
                    $where = 0;
                } else if ($args['active'] == null && $args['status'] != null) {
                    $where = 1;
                    $whereData = [
                        ['admins.status', '=', $args['status']]
                    ];
                } else if ($args['active'] != null && $args['status'] == null) {
                    $where = 1;
                    $whereData = [
                        ['admins.active', '=', $args['active']]
                    ];
                } else if ($args['active'] != null && $args['status'] != null) {
                    $where = 1;
                    $whereData = [
                        ['admins.active', '=', $args['active']],
                        ['admins.status', '=', $args['status']]
                    ];
                }

                if ($where == 0) {
                    $users = DB::table('admins')
                            ->select('*')
                            ->orderBy('admins.id', 'desc')
                            ->get();
                } else if ($where == 1) {
                    $users = DB::table('admins')
                            ->select('*')
                            ->where($whereData)
                            ->orderBy('admins.id', 'desc')
                            ->get();
                }

                break;
            default:
        }
        return $users;
    }

    public function getUser($type, $userid) {

        switch ($type) {
            case 1:
                $whereData = [
                    ['users.id', '=', $userid],
                    ['users.status', '=', 1]
                ];

                $user = DB::table('users')
                        ->leftJoin('user_details', 'users.id', '=', 'user_details.user_id')
                        ->select('*', 'users.id as uid', 'users.active as uactive', 'user_details.name as uname')
                        ->where($whereData)
                        ->first();
                break;
            case 2:
                $whereData = [
                    ['customers.id', '=', $userid],
                    ['customers.status', '=', 1],
                    ['users.user_type', '=', 1],
                    ['users.status', '=', 1],
                    ['user_details.status', '=', 1]
                ];

                $user = DB::table('customers')
                        ->leftJoin('users', 'customers.user_id', '=', 'users.id')
                        ->leftJoin('user_details', 'users.id', '=', 'user_details.user_id')
                        ->select('*', 'customers.id as cid', 'customers.user_id as company_id', 'customers.name as cname', 'customers.email as cemail', 'customers.phone as cphone', 'customers.password as cpassword', 'customers.active as cactive', 'users.id as uid', 'users.email as uemail', 'users.phone as uphone', 'users.active as uactive', 'user_details.name as uname', 'customers.created_at as ccreated_at')
                        ->where($whereData)
                        ->first();
                break;
            case 3:
                $whereData = [
                    ['id', '=', $userid],
                    ['status', '=', 1]
                ];

                $user = DB::table('admins')
                        ->select('*')
                        ->where($whereData)
                        ->first();
                break;
            default:
        }
        return $user;
    }

    public function createUser($data, $type) {

        $date = date('Y-m-d H:i:s');

        switch ($type) {
            case 1:

                $expire_date = $data['expire_date'];
                $plan = $this->getMembershipPlanById(0);
                $price = $plan->price;

                $data1 = [
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'password' => $data['password'],
                    'user_type' => $data['user_type'],
                    'active' => $data['active'],
                    'membership' => 0,
                    'expire_date' => $expire_date,
                    'updated_at' => $date
                ];

                DB::beginTransaction();
                try {
                    $userid = DB::table('users')->insertGetId($data1);

                    $data2 = [
                        'user_id' => $userid,
                        'name' => $data['name'],
                        'company_name' => $data['company_name'],
                        'address1' => $data['address1'],
                        'address2' => $data['address2'],
                        'modified' => $date
                    ];

                    $data3 = [
                        'user_id' => $userid,
                        'membership_id' => 0,
                        'validity_id' => 1,
                        'plan_id' => 0,
                        'price' => $price,
                        'effect_from' => $date,
                        'expire_on' => $expire_date
                    ];
                    $branchData         =   [
                        'user_id'       =>  $userid,
                        'branch_name'   =>  $data['company_name'],
                        'address1'      =>  $data['address1'],
                        'address2'      =>  $data['address2'],
                        'phone'         =>  $data['phone'],
                        'parent'        =>  1
                    ];

                    DB::table('user_details')->insert($data2);
                    DB::table('branches')->insert($branchData);
                    DB::table('user_memberships')->insert($data3);
                    DB::commit();
                    return 1;
                } catch (Exception $ex) {
                    DB::rollback();
                }

                break;
            case 2:
                DB::beginTransaction();
                try {
                    $userid = DB::table('customers')->insert($data);
                    DB::commit();
                    return 1;
                } catch (Exception $ex) {
                    DB::rollback();
                }

                break;
            case 3:
                DB::beginTransaction();
                try {
                    $userid = DB::table('admins')->insert($data);
                    DB::commit();
                    return 1;
                } catch (Exception $ex) {
                    DB::rollback();
                }

                break;
            default:
        }
    }

    public function updateUser($data, $type, $userid) {

        $date = date('Y-m-d H:i:s');

        switch ($type) {
            case 1:

                if ($data['password'] != '') {
                    $data1 = [
                        'email' => $data['email'],
                        'phone' => $data['phone'],
                        'password' => $data['password'],
                        'user_type' => $data['user_type'],
                        'active' => $data['active'],
                        'updated_at' => $date
                    ];
                } else {
                    $data1 = [
                        'email' => $data['email'],
                        'phone' => $data['phone'],
                        'user_type' => $data['user_type'],
                        'active' => $data['active'],
                        'updated_at' => $date
                    ];
                }

                $data2 = [
                    'name' => $data['name'],
                    'company_name' => $data['company_name'],
                    'address1' => $data['address1'],
                    'address2' => $data['address2'],
                    'modified' => $date
                ];

                DB::beginTransaction();
                try {
                    DB::table('users')->where('id', $userid)->update($data1);
                    DB::table('user_details')->where('user_id', $userid)->update($data2);
                    DB::commit();
                    return 1;
                } catch (Exception $ex) {
                    DB::rollback();
                }

                break;
            case 2:

                DB::beginTransaction();
                try {
                    DB::table('customers')->where('id', $userid)->update($data);
                    DB::commit();
                    return 1;
                } catch (Exception $ex) {
                    DB::rollback();
                }

                break;
            case 3:

                DB::beginTransaction();
                try {
                    DB::table('admins')->where('id', $userid)->update($data);
                    DB::commit();
                    return 1;
                } catch (Exception $ex) {
                    DB::rollback();
                }

                break;
            default:
        }
    }

    public function deleteUser($tablename, $userid) {

        $data = [
            'status' => 0
        ];

        DB::beginTransaction();
        try {
            DB::table($tablename)->where('id', $userid)->update($data);
            if ($tablename == 'users') {
                DB::table('user_details')->where('user_id', $userid)->update($data);
            }
            DB::commit();
            return 1;
        } catch (Exception $ex) {
            DB::rollback();
        }
    }

    public function deleteUsers($tablename, $userids) {

        $data = [
            'status' => 0
        ];

        DB::beginTransaction();
        try {
            DB::table($tablename)->whereIn('id', $userids)->update($data);
            if ($tablename == 'users') {
                DB::table('user_details')->whereIn('user_id', $userids)->update($data);
            }
            DB::commit();
            return 1;
        } catch (Exception $ex) {
            DB::rollback();
        }
    }

    public function checkUserDetails($tablename, $field, $value, $userid) {
        if ($tablename != null && $field != null && $value != null && $userid != null) {

            $whereData = [
                [$field, '=', $value],
                ['id', '!=', $userid]
            ];

            $count = DB::table($tablename)
                    ->where($whereData)
                    ->count();

            return $count;
        } else {
            return false;
        }
    }

    public function getLastCustomerCode($userid) {

        $result = DB::table('customers')
                ->where('user_id', $userid)
                ->orderBy('cust_id', 'desc')
                ->limit(1)
                ->first();

        return $result;
    }

    public function upgradeMembership($data, $type, $userid) {

        $date = date('Y-m-d H:i:s');
        $cstaff = $newstaff = 0;

        $membershipid = $data['membership'];
        $validityid = $data['validity'];

        $userdetails = $this->getUser(1, $userid);

        if ($userdetails) {
            $cplanid = $userdetails->membership;

            $mpargs = [
                "id" => $cplanid,
                "status" => 1
            ];

            $currentplan = self::getMembershipPlan($mpargs);

            if ($currentplan) {
                $cmembershipid = $currentplan->membership_id;
                $cvalidityid = $currentplan->validity_id;

                $currentval = [$cmembershipid, $cvalidityid];
                $newval = [$membershipid, $validityid];

                if ($currentval != $newval) {

                    $mvargs = [
                        "membershipid" => $membershipid,
                        "validityid" => $validityid
                    ];

                    $chkdetails = self::getMembershipPlanByMvId($mvargs);

                    if ($chkdetails) {

                        $planid = $chkdetails->id;
                        $price = $chkdetails->price;

                        $vdata = $this->getMembershipValidity($validityid);
                        $validity_period = $vdata->validity;
                        $period = "+" . $validity_period;
                        $expire_date = changeDate($period);

                        if ($type == 1) {

                            $updata = [
                                'membership' => $planid,
                                'expire_date' => $expire_date,
                                'updated_at' => $date
                            ];

                            $datalog = [
                                'user_id' => $userid,
                                'membership_id' => $membershipid,
                                'validity_id' => $validityid,
                                'plan_id' => $planid,
                                'price' => $price,
                                'effect_from' => $date,
                                'expire_on' => $expire_date
                            ];

                            $statusdata = [
                                'status' => 0
                            ];
                        }

                        DB::beginTransaction();
                        try {
                            DB::table('users')->where('id', $userid)->update($updata);
                            DB::table('user_memberships')->where('user_id', $userid)->update($statusdata);
                            DB::table('user_memberships')->insert($datalog);
                            DB::commit();
                            return 1;
                        } catch (Exception $ex) {
                            DB::rollback();
                        }
                    } else {
                        return 0;
                    }
                } else {
                    return 4;
                }
            } else {
                return 2;
            }
        } else {
            return 3;
        }
    }

    public function renewMembership($data, $type, $userid) {

        $date = date('Y-m-d H:i:s');

        $user_details = $this->getUser(1, $userid);

        $validityid = $data['validity'];

        $planid = $user_details->membership;
        $cp_expire_date = $user_details->expire_date;

        if (checkExpiry($cp_expire_date) == 0) {
            $effect_from = $date;
        } else {
            $effect_from = $cp_expire_date;
        }

        $args = [
            "id" => $planid,
            "status" => 1
        ];

        $chkdetails = self::getMembershipPlan($args);

        if ($chkdetails) {

            $membershipid = $chkdetails->membership_id;
            $price = $chkdetails->price;

            $vdata = $this->getMembershipValidity($validityid);
            $validity_period = $vdata->validity;
            $expire_date = dateAdd($effect_from, $validity_period);

            if ($type == 1) {

                $updata = [
                    'expire_date' => $expire_date,
                    'updated_at' => $date
                ];

                $datalog = [
                    'user_id' => $userid,
                    'membership_id' => $membershipid,
                    'validity_id' => $validityid,
                    'plan_id' => $planid,
                    'price' => $price,
                    'effect_from' => $effect_from,
                    'expire_on' => $expire_date
                ];
            }

            DB::beginTransaction();
            try {
                DB::table('users')->where('id', $userid)->update($updata);
                DB::table('user_memberships')->insert($datalog);
                DB::commit();
                return 1;
            } catch (Exception $ex) {
                DB::rollback();
            }
        } else {
            return 0;
        }
    }

    public function getAllMemberships($status) {

        if ($status == 0) {
            $res = DB::table('membership')
                    ->select('*')
                    ->orderBy('id', 'asc')
                    ->get();
        } else if ($status == 1) {
            $res = DB::table('membership')
                    ->select('*')
                    ->where('active', $status)
                    ->orderBy('id', 'asc')
                    ->get();
        }

        return $res;
    }

    public function getUserMembership($type, $id) {

        if ($type == 1) {

            $whereData = [
                ['MP.id', '=', $id],
                ['MV.status', '=', 1]
            ];

            $res = DB::table('membership_plans as MP')
                    ->select('*', 'MV.id as mvid', 'MP.id as mpid')
                    ->join('membership as M', 'M.id', '=', 'MP.membership_id')
                    ->join('membership_validity as MV', 'MV.id', '=', 'MP.validity_id')
                    ->where($whereData)
                    ->first();
        }

        return $res;
    }

    public function getMembershipById($id) {
        $res = DB::table('membership')
                ->select('*')
                ->where('id', $id)
                ->first();
        return $res;
    }

    public function getAllMembershipValidity() {

        $res = DB::table('membership_validity')
                ->select('*')
                ->where('status', 1)
                ->orderBy('id', 'asc')
                ->get();

        return $res;
    }

    public function getMembershipValidity($id) {

        $whereData = [
            ['id', '=', $id],
            ['status', '=', 1]
        ];

        $res = DB::table('membership_validity')
                ->select('*')
                ->where($whereData)
                ->first();

        return $res;
    }

    public function getMemberValidity($id) {

        if ($id == 'new') {
            $res = DB::table('membership_validity')
                    ->select('*', 'id as mvid')
                    ->where('status', 1)
                    ->get();
        } else {

            $whereData = [
                ['MP.membership_id', '=', $id],
                ['MV.status', '=', 1]
            ];

            $res = DB::table('membership_validity as MV')
                    ->select('*', 'MV.id as mvid', 'MP.id as mpid')
                    ->join('membership_plans as MP', 'MP.validity_id', '=', 'MV.id')
                    ->where($whereData)
                    ->get();
        }

        if ($res) {
            return $res;
        } else {
            return false;
        }
    }

    public function saveMembership($data, $id) {

        $datams = [
            'name' => $data['name'],
            'staff' => $data['staff'],
            'description' => $data['desc'],
            'status' => $data['status']
        ];

        $status = $data['status'];

        $datamsp = [];
        $upids = [];

        if ($id != 'new') {

            $datamspreset = [
                'price' => 0,
                'status' => 0
            ];

            $whereData = [
                ['membership_id', '=', $id]
            ];

            if (isset($data['price'])) {
                $i = 1;
                foreach ($data['price'] as $price) {

                    if ($price == 0) {
                        $status = 0;
                    } else {
                        $status = 1;
                    }

                    $updata = [
                        'price' => $price,
                        'status' => $status
                    ];

                    $upid = [
                        'id' => $data['mpid' . $i]
                    ];

                    array_push($datamsp, $updata);
                    array_push($upids, $upid);
                    $i++;
                }
            }

            DB::beginTransaction();
            try {

                DB::table('membership')->where('id', $id)->update($datams);
                if ($id != 0) {
                    DB::table('membership_plans')->where($whereData)->update($datamspreset);
                }
                if (isset($data['price'])) {
                    $tablename = 'membership_plans';
                    if (!empty($datamsp) && !empty($upids)) {
                        $result = BaseService::batchUpdate($tablename, $datamsp, $upids);
                    }
                    if ($result == 1) {
                        DB::commit();
                        return 1;
                    } else if ($result == 0) {
                        DB::rollback();
                        return 0;
                    }
                } else {
                    DB::commit();
                    return 1;
                }
            } catch (Exception $ex) {
                DB::rollback();
            }
        } else {

            DB::beginTransaction();
            try {

                $membership_id = DB::table('membership')->insertGetId($datams);
                $i = 1;

                if (isset($data['price'])) {

                    foreach ($data['price'] as $price) {

                        if ($price == 0) {
                            $status = 0;
                        } else {
                            $status = 1;
                        }

                        $insdata = [
                            'membership_id' => $membership_id,
                            'validity_id' => $data['validity_id' . $i],
                            'price' => $price,
                            'status' => $status
                        ];

                        array_push($datamsp, $insdata);
                        $i++;
                    }

                    DB::table('membership_plans')->insert($datamsp);
                    DB::commit();
                    return 1;
                } else {
                    return 0;
                }
            } catch (Exception $ex) {
                DB::rollback();
            }
        }
    }

    public function deleteMembership($id) {
        DB::beginTransaction();
        try {
            $res = DB::table('membership')->where('id', $id)->first();
            if ($res) {
                DB::table('membership')->where('id', $id)->delete();
                $results = DB::table('membership_plans')->where('membership_id', $id)->get();
                if ($results) {
                    DB::table('membership_plans')->where('membership_id', $id)->delete();
                }
                DB::commit();
                return true;
            } else {
                return false;
            }
        } catch (Exception $ex) {
            DB::rollback();
        }
    }

    public function deleteMemberships($ids) {
        DB::beginTransaction();
        try {
            DB::table('membership')->whereIn('id', $ids)->delete();
            DB::table('membership_plans')->whereIn('membership_id', $ids)->delete();
            DB::commit();
            return 1;
        } catch (Exception $ex) {
            DB::rollback();
        }
    }

    public function getMembershipDetails($id) {

        $whereData = [
            ['MP.membership_id', '=', $id],
            ['MP.status', '=', 1],
            ['MV.status', '=', 1]
        ];

        $data = DB::table('membership_plans as MP')
                ->select('*')
                ->join('membership_validity as MV', 'MP.validity_id', '=', 'MV.id')
                ->where($whereData)
                ->orderBy('MP.validity_id', 'asc')
                ->get();

        if ($data) {
            return $data;
        } else {
            return false;
        }
    }

    public function checkMembershipUsers($id) {
        $res = DB::table('user_memberships')
                ->where('membership_id', $id)
                ->count();
        return $res;
    }

    public function getMembershipPlanById($id) {
        $res = DB::table('membership_plans')
                ->select('*')
                ->where('id', $id)
                ->first();
        return $res;
    }

    public function getCallHistory($args) {

        if ($args['tablename'] != null && $args['field'] != null && $args['order'] != null && $args['userid']) {

            $whereData = [];
            $where = 0;

            if (isset($args['active']) && $args['active'] != null) {
                $where = 1;
                $uactive = ['active', '=', $args['active']];
                array_push($whereData, $uactive);
            }

            if (isset($args['status']) && $args['status'] != null) {
                $where = 1;
                $ustatus = ['status', '=', $args['status']];
                array_push($whereData, $ustatus);
            }

            if (isset($args['userid']) && $args['userid'] != null) {
                $where = 1;
                $userid = ['user_id', '=', $args['userid']];
                array_push($whereData, $userid);
            }

            if ($where == 0) {
                $result = DB::table($args['tablename'])
                        ->select('*')
                        ->orderBy($args['field'], $args['order'])
                        ->get();
            } else if ($where == 1) {
                $result = DB::table($args['tablename'])
                        ->select('*')
                        ->where($whereData)
                        ->orderBy($args['field'], $args['order'])
                        ->get();
            }

            return $result;
        } else {
            return false;
        }
    }

    public function getStaff($args) {

        if ($args['tablename'] != null && $args['field'] != null && $args['order'] != null && $args['userid']) {

            $whereData = [];
            $where = 0;

            if (isset($args['active']) && $args['active'] != null) {
                $where = 1;
                $uactive = ['active', '=', $args['active']];
                array_push($whereData, $uactive);
            }

            if (isset($args['status']) && $args['status'] != null) {
                $where = 1;
                $ustatus = ['status', '=', $args['status']];
                array_push($whereData, $ustatus);
            }

            if (isset($args['userid']) && $args['userid'] != null) {
                $where = 1;
                $userid = ['user_id', '=', $args['userid']];
                array_push($whereData, $userid);
            }

            if ($where == 0) {
                $result = DB::table($args['tablename'])
                        ->select('*')
                        ->orderBy($args['field'], $args['order'])
                        ->get();
            } else if ($where == 1) {
                $result = DB::table($args['tablename'])
                        ->select('*')
                        ->where($whereData)
                        ->orderBy($args['field'], $args['order'])
                        ->get();
            }

            return $result;
        } else {
            return false;
        }
    }

    public function getStaffCount($scargs) {
        if ($scargs["user_id"] != null && $scargs["active"] != null && $scargs["status"] != null) {

            $tablename = "staffs";
            $whereData = [
                ['user_id', '=', $scargs["user_id"]],
                ['active', '=', $scargs["active"]],
                ['status', '=', $scargs["status"]]
            ];

            $count = DB::table($tablename)
                    ->where($whereData)
                    ->count();
            return $count;
        } else {
            return false;
        }
    }

    public static function getMembershipPlanByMvId($args) {
        if ($args['membershipid'] != null && $args['validityid'] != null) {

            $whereData = [
                ['membership_id', '=', $args['membershipid']],
                ['validity_id', '=', $args['validityid']],
                ['status', '=', 1]
            ];

            $result = DB::table('membership_plans')
                    ->select('*')
                    ->where($whereData)
                    ->first();

            return $result;
        }
    }

    public static function getMembershipPlan($args) {
        if ($args['status'] != null) {

            $whereData = [];
            $where = 0;

            if (isset($args['id']) && $args['id'] != null) {
                $where = 1;
                $planid = ['id', '=', $args['id']];
                array_push($whereData, $planid);
            } else {
                $where = 1;
                $planid = ['id', '=', 0];
                array_push($whereData, $planid);
            }

            if (isset($args['status']) && $args['status'] != null) {
                $where = 1;
                $status = ['status', '=', $args['status']];
                array_push($whereData, $status);
            }

            if ($where == 0) {
                $result = DB::table('membership_plans')
                        ->select('*')
                        ->first();
            } else if ($where == 1) {
                $result = DB::table('membership_plans')
                        ->select('*')
                        ->where($whereData)
                        ->first();
            }

            return $result;
        }
    }
    
    public function saveMessageDetails($data) {

        $tablename = "sent_message_details";

        DB::beginTransaction();
        try {
            DB::table($tablename)->insert($data);
            DB::commit();
            return 1;
        } catch (Exception $ex) {
            DB::rollback();
        }
    }

}
