<?php

namespace App\Http\Controllers\Api\Student;

use Validator;
use Illuminate\Http\Request;
use App\Rules\ActiveChild;
use App\Models\Api\Notification;
use App\Models\Functions;
use DB;
use App\Http\Resources\User as UserResource;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function index()
    {
        echo "hi Api";
    }
    function notifications(Request $request){
        $user                   =   validateToken($request->post('accesToken')); if(!$user){return Functions::invalidToken(); }
        return Notification::getNotifications($user);
    }
}
