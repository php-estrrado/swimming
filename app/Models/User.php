<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class User extends Authenticatable {

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'phone', 'password', 'user_type', 'active_link', ''
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    static function getValidity($id = 0) {
        return DB::table('membership as M')->select('M.name', 'V.*')->join('membership_plans as MP', 'M.id', '=', 'MP.membership_id')
                        ->join('membership_validity as V', 'MP.validity_id', '=', 'V.id')->where('M.id', $id)->first();
    }

    static function sendResrtPassLink($post) {
        $res = DB::table('users')->where('email', $post['email'])->first();
        if ($res) {
            if ($res->active == 0) {
                return 2;
            } else {
                $user = DB::table('user_details')->where('user_id', $res->id)->first();
                $resetLink = base64_encode(rand(100000, 999999) . 'resetpassword' . time() . '1');
                $resetLink = urlencode($resetLink);
                $currTime = date('Y-m-d H:i:s');
                $data = array('active_link' => $resetLink, 'email_verified_at' => $currTime);
                $msg = '<h4>Hi, ' . $user->name . ' </h4>';
                $msg .= 'You can reset password of ' . geSiteName() . ' throuth this <a href="' . url('/reset/password/' . $resetLink) . '">Reset Password</a> link.';
                $update = DB::table('users')->where('email', $post['email'])->update($data);
                if ($update)
                    Email::sendEmail(geAdminEmail(), $post['email'], 'Reset Password', $msg);
                return 1;
            }
        }else {
            return false;
        }
    }

    static function getUserData($id) {
        $data = array();
        $query = DB::table('users as U')->join('user_details as D', 'U.id', '=', 'D.user_id')->select('U.*', 'D.*', 'M.name as mname')
                        ->join('membership as M', 'U.membership', '=', 'M.id')->where('U.id', $id);
        if ($query->count() > 0) {
            $user = $query->first();
            if ($user->user_avthar != NULL) {
                $avthar = url('/storage') . $user->user_avthar;
            } else {
                $avthar = url('/storage/uploads/shop/no-avatar.png');
            }
            if ($user->company_logo != NULL) {
                $logo = url('/storage') . $user->company_logo;
            } else {
                $logo = url('/storage/uploads/shop/logo.png');
            }
            $data['user_id'] = $user->user_id;
            $data['token'] = $user->access_tocken;
            $data['name'] = $user->name;
            $data['sname'] = $user->company_name;
            $data['email'] = $user->email;
            $data['phone'] = $user->phone;
            $data['address1'] = $user->address1;
            $data['address2'] = $user->address2;
            $data['avthar'] = $avthar;
            $data['logo'] = $logo;
            $data['membership'] = $user->mname;
            $data['expire_on'] = $user->expire_date;
        }
        return $data;
    }
    
    static function getLocations(){
       $query              =   DB::table('cities')->where('status',1);
       $data               =   array();
       if($query->count()  >   0){ foreach($query->get() as $row){ $data[$row->id] = $row->name; } }
       return $data;
    }

    static function getStaffByUserId($id) {
        $query = DB::table('staffs')->where('user_id', $id);
        if ($query->count() > 0) {
            return $query->get();
        } else {
            $data = array();
            return (object) $data;
        }
    }

}
