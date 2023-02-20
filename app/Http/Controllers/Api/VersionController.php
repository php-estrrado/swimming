<?php

namespace App\Http\Controllers\Api;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Rules\Name;
use App\Models\Api\User;
use App\Models\Email;
use DB;
use Mail;
use App\Http\Resources\User as UserResource;
use App\Http\Controllers\Controller;

class VersionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        echo "hi Api";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function currentVersion(Request $request)
    { 
        return array('status'=>'success','message'=>'version','data'=>['version'=>'1.0']); 
        
    }
    
    
}
