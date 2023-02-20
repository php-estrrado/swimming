<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use DB;
class Active implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value){ 
        if($attribute   ==  'child_id') $attribute = 'id';
        $res        =   DB::table('users')->where($attribute, $value)->first();
        if($res){ if($res->active == 0 && $res->active_from == NULL){ return false; }else{ return true; } }else{ return true; }
    }
    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This account not activated yet. Please contact admin.';
    }
}
