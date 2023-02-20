<?php

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;
use Validator;

class ApiController extends BaseController {

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;

    public function users(Request $request) {
        //$email = $request->input('email');
        //$count = DB::table('users')->where('email', $email)->where('usertype', 1)->count();
        //return response()->json(['usercount' => $count]);
        return response()->json(['usercount' => 0]);
    }

}
