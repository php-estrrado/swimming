<?php

namespace App\Models\Admin;

use DB;

class Location extends User {

    static function getLocations() { 
        return DB::table('cities as C')->select('C.*','S.name as stName','S.id as stId')->join('states as S','C.state_id','=','S.id')
                                ->where('C.status',1)->where('S.country_id',132)->get();
    }
    static function getStates($cId,$type=''){ 
        $data               =   array();
        $states             =   DB::table('states')->where('country_id',$cId)->where('status',1)->get(); 
        if($states && $type ==  'dropDown'){ foreach($states as $row){ $data[$row->id] = $row->name; } return $data; }
        else{ return $states; }
    }
    
    static function checkLocationExist($location){
        $query              =   DB::table('cities')->where('name',$location);
        if($query->count()  >   0){ return $query->first(); }else{ return false; }
    }
        
    static function reEnableLocation($post,$id){
        return DB::table('cities')->where('id',$id)->update(['state_id'=>$post->state,'active'=>$post->status,'status'=>1,]);
    }

    static function saveLocation($post,$id){
        $data               =   ['name'=>$post->location,'state_id'=>$post->state,'active'=>$post->status]; $res = false;
        if($id              >   0){ $res = DB::table('cities')->where('id',$id)->update($data); }else{ $res = DB::table('cities')->insert($data); }
        return $res;
    }
    
    static function updateStatus($post){ return DB::table($post->table)->where('id',$post->id)->update(['active'=>$post->active]); }
    
    static function deleteLocation($post){ return DB::table($post->table)->where('id',$post->id)->update(['status'=>0]); }

}
