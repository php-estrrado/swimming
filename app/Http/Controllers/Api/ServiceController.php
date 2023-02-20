<?php


namespace App\Http\Controllers\Api;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Rules\Name;
use App\Models\Api\Service;
use App\Models\Email;
use App\Functions;
use DB;
use Mail;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
   public function __construct(Request $request){ 
       
    }
    function serviceList(Request $request) { 
        if(validateToken($request->post('accesToken')))
        {
            $post                       =   (object)$request->post();
            $data = DB::table('users')->where('access_token',(int)$post->accesToken)->where('is_login',1)->where('active',1)->where('status',1)->first();
            return array('status'=>'success','message'=>'Success!','data'=>$data);
        }
        else
        { 
            return $this->invalidToken(); 
        }
      
    }
    
    function viewService(Request $request) { 
        $post                       =   $request->post(); 
        if($user = validateTocken($post['access_tocken']))
        {
            $data                   =   Service::getServiceById($post['staff_id'],'view');
            return array('status'=>'success','message'=>'Success!','data'=>$data);
        }
        else
        {
            return array('status'=>'error','message'=>'Invalid access tocken','data'=>array('errors' =>array('error'=>'Invalid access tocken')));
        }
    }
    
    
    function invalidToken(){
        return array('status'=>'error','message'=>'Invalid access token','data'=>array('errors' =>array('error'=>'Invalid access token'))); 
    }
}
