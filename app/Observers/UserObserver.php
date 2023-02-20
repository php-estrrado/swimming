<?php

namespace App\Observers;

use App\User;
use DB;
use Session;
class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function created(User $user)
    {   
        $uderData               =   Session::get('userData');
        $data                   =   array();
        $userId                 =   DB::table('users')->orderBy('id', 'desc')->limit(1)->get()->first()->id;
        $data['user_id']        =   $userId;
        $data['name']           =   $uderData['name'];
        $data['company_name']   =   $uderData['sname'];
        $data['address1']       =   $uderData['address1'];
        $data['address2']       =   $uderData['address2'];
        DB::table('user_details')->insert($data);
        Session::forget('userData');
        Session::flash('success', 'You are successfully registered. Please activate your account through your registered email!'); 
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the user "restored" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
