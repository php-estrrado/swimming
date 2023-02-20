<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use DB;

class DeletedChild implements Rule
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
    public function passes($attribute, $value)
    {
        $res        =   DB::table('users')->where('id', $value)->first(); 
        if($res){ if($res->status == 0){ return false; }else{ return true; } }else{ return false; }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This child account disabled. Please contact admin.';
    }
}
