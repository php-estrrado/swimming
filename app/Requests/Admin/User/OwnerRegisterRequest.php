<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class OwnerRegisterRequest extends FormRequest {

    public function rules() {
        return [
            'ownername' => 'required|string|max:55',
            'salonname' => 'required|max:55',
            'addressline1' => 'required',
            'email' => 'required|email|max:55',
            'phone' => 'required|numeric|digits_between:7,12',
            'password' => 'nullable|min:5|string',
            'cpassword' => 'nullable|min:5|string|required_with:password|same:password'
        ];
    }

    public function messages() {
        return [
            'ownername.required' => 'Ownername is required',
            'ownername.max' => 'The maximum length for ownername is 55.',
            'salonname.required' => 'Salonname is required',
            'salonname.max' => 'The maximum length for salonname is 55.',
            'addressline1.required' => 'Addressline is required',
            'email.email' => 'Please enter a valid email address',
            'email.required' => 'Email is required',
            'email.max' => 'The maximum length for email is 55.',
            'phone.required' => 'Phone number is required',
            'phone.numeric' => 'Please enter a numeric value as phone number',
            'password.min' => 'The minimum length for password is 5.',
            'cpassword.min' => 'The minimum length for confirm password is 5.',
            'cpassword.required_with' => 'The confirm password field is required when password is present.',
            'cpassword.same' => 'Enter confirm password same as password.'
        ];
    }

}
