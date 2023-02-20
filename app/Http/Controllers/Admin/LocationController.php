<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Location;

class LocationController extends Controller
{
    public function __construct() {
        $this->middleware('authadmin:admin');
    }
    public function index()
    {
        //
    }
    
    public function locations()
    {
        $data['title']          =   'Locations';
        $data['locationsGroup'] =   'is-expanded';
        $data['locationMenu']   =   'active';
        $data['locations']      =   Location::getLocations();
        $data['states']         =   Location::getStates('132','dropDown');
        return view('admin.pages.locations.list', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request,$id=0)
    {
        $post                   =   (object) $request->post(); 
        $islocExist             =   Location::checkLocationExist($post->location);
        if($islocExist){
            if($islocExist->status  ==  0){ Location::reEnableLocation($post,$islocExist->id); $msg = 'Re-enabl'; $result = true; }
            else{return redirect('/admin/locations')->with('error', 'Location <b>'.$post->location.'</b> Already Exist.'); }
        }else{
            $result             =   Location::saveLocation($post,(int)$id);
            if($id > 0){ $msg   =   'Updat'; }else{ $msg = 'Add'; }
        }
        if($result){ return redirect('/admin/locations')->with('success', 'Location '.$msg.'ed Successfully!'); }
        else{   return redirect('/admin/locations')->with('error', 'Failes to Update'); }
    }
      
    public function changeStatus(Request $request)
    {
        $result                 =   Location::updateStatus((object)$request->post());
        if($request->post('active') == 1){ $msg = 'Activated successfully!'; }else{ $msg = 'Deactivated sucessfully!'; }
        if($result){ return array('type'=>'success','msg'=>$msg); }else{  return array('type'=>'warning','msg'=>'Status update failed.'); }
    }

    function disable(Request $request){
        $post                   =   (object)$request->post();
        $result                 =   Location::deleteLocation($post);
        if($result){ 
            $data['locations']  =   Location::getLocations();
            $data['states']     =   Location::getStates('132','dropDown');
            return view('admin.pages.locations.list.content', $data);
        }else{  return array('type'=>'warning','msg'=>'Failed to delete.'); }
    }
    
    public function delete($id)
    {
        $result                 =   Location::deleteLocation((int)$id);
        if($result){ return redirect('/admin/locations')->with('success', 'Location deleted successfully!'); }
        else{   return redirect('/admin/locations')->with('error', 'Failes to delete'); }
    }
}
