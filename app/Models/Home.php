<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Home extends Model {

    static function bannerSlider() {

        $whereData = [
            ['active', '=', 1],
            ['status', '=', 1]
        ];

        return DB::table('banner')->where($whereData)->orderBy('sort', 'asc')->get();
    }

    static function getHomeContents() {

        $whereData = [
            ['active', '=', 1],
            ['status', '=', 1]
        ];

        $identifier = array(
            "join_over", "book_appointment", "simple_appointment", "customer_record", "employee_management", "real_time_booking",
            "make_perfection", "appointment_management", "who_usses"
        );
        return DB::table('widgets')->whereIn('identifier', $identifier)->where($whereData)->orderBy('sort', 'asc')->get();
    }

    static function getPage($identifier) {

        $whereData = [
            ['identifier', '=', $identifier],
            ['active', '=', 1],
            ['status', '=', 1]
        ];

        return DB::table('pages')->where($whereData)->first();
    }
    static function getLocation() {

        $whereData = [
            ['active', '=', 1],
            ['status', '=', 1]
        ];

        return DB::table('pages')->where($whereData)->first();
    }
    
    static function getCourse() {

        $whereData = [
            ['active', '=', 1],
            ['status', '=', 1]
        ];

        return DB::table('pages')->where($whereData)->first();
    }
    static function getAllFaqs() {

        $whereData = [
            ['active', '=', 1],
            ['status', '=', 1]
        ];

        return DB::table('faqs')->where($whereData)->orderBy('sort', 'asc')->get();
    }

    static function saveContact($data) {

        $datains = [
            "name" => $data["name"],
            "email" => $data["email"],
            "subject" => $data["subject"],
            "message" => $data["message"]
        ];

        DB::beginTransaction();
        try {
            $result = DB::table('contacts')->insert($datains);
            DB::commit();
            return 1;
        } catch (Exception $ex) {
            DB::rollback();
        }
    }

    static function getAllMembershipValidity() {

        $whereData = [
            ['id', '!=', 1],
            ['status', '=', 1]
        ];

        $res = DB::table('membership_validity')
                ->select('*')
                ->where($whereData)
                ->orderBy('id', 'asc')
                ->get();

        return $res;
    }

    static function getMembershipPlans() {

        $whereData = [
            ['MP.membership_id', '!=', 0],
            ['M.active', '=', 1],
            ['M.status', '=', 1],
            ['MP.status', '=', 1],
            ['MV.status', '=', 1]
        ];

        $res = DB::table('membership_plans as MP')
                ->select('*')
                ->join('membership as M', 'M.id', '=', 'MP.membership_id')
                ->join('membership_validity as MV', 'MP.validity_id', '=', 'MV.id')
                ->where($whereData)
                ->orderBy('MP.validity_id', 'asc')
                ->orderBy('M.id', 'asc')
                ->get();

        return $res;
    }
    static function saveResponse($post){
        $name = 'Merlin'; $email = 'merlin@estrrado.com';
        
        return $insertId = DB::table('test')->insertGetId(['name'=>$post->name,'email'=>$post->email]);
    }

}
