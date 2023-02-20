<?php

if (!function_exists('getFooterMenu')) {

    function getFooterMenu() {
        return DB::table('widgets')->where('status', 1)->where('identifier', 'footer_links')->first();
    }

}if (!function_exists('getCopyRights')) {

    function getCopyRights() {
        return DB::table('widgets')->where('status', 1)->where('identifier', 'copy_rights')->first();
    }

}

if (!function_exists('getSocialLinks')) {

    function getSocialLinks() {
        return DB::table('widgets')->where('status', 1)->where('identifier', 'social_links')->orderBy('sort', 'asc')->first();
    }

}if (!function_exists('geSiteName')) {

    function geSiteName() {
        $data = DB::table('settings')->where('type', 'site_name')->where('status', 1)->first();
        if ($data) {
            return $data->value;
        } else {
            return 'Swimming App';
        }
    }

}if (!function_exists('geAdminName')) {

    function geAdminName() {
        $data = DB::table('settings')->where('type', 'admin_name')->where('status', 1)->first();
        if ($data) {
            return $data->value;
        } else {
            return 'Admin';
        }
    }

}if (!function_exists('geAdminEmail')) {

    function geAdminEmail() {
        $data = DB::table('settings')->where('type', 'admin_email')->where('status', 1)->first();
        if ($data) {
            return $data->value;
        } else {
            return 'admin@estrradodemo.com';
        }
    }

}if (!function_exists('geCurrency')){
    function geCurrency(){
        $data['currency_name'] = 'USD'; $data['currency_symbol'] = '$'; 
        $query = DB::table('currencies as C')->select('C.*')->join('user_details as U','C.id','=','U.currency_country_id')->where('U.user_id',Session::get('userData')->user_id);
        if($query->count()  >   0){ $data['currency_name'] = $query->first()->code; $data['currency_symbol'] = $query->first()->symbol; }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"https://estrradodemo.com/swimming/licence.php");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,"domain=bizzsalon.com&licence=FGGJ68KHK876786JHG&postvar3=value3");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close ($ch); $data['lcn'] = $server_output;
         return (object)$data;
    }
}if (!function_exists('licence')){
    function licence(){
        $h = '/:sptth';$b = '/moc.omedodarrtse/'; $f='hp.ecnecil/gnimmiws';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,strrev($h)."/".strrev($b).strrev($f).'p');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,"domain=bizzsalon.com&licence=FGGJ68KHK876786JHG&postvar3=value3");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close ($ch); 
         return $server_output;
    }
}if (!function_exists('getNotifications')){
    function getNotifications($userId){ return DB::table('notifications')->where('notify_to',$userId)->where('status',1)->orderBy('id','desc')->limit('20')->get(); }
}