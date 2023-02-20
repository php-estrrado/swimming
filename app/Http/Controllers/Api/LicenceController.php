<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
// use App\Models\Api\Licence;
use App\Http\Controllers\Controller;
use DB;

class LicenceController extends Controller
{
    public function index(){ echo "hi Api"; }
    function check(Request $request){ 
        $query                  =   DB::table('licences')->where('domain',$request->post('domain'))->where('licence_key',$request->post('licence'));
        if($query->count()      >   0){ return 'success'; }else{ echo '<div>Invalied Key</div>'; die; }
    }
}
