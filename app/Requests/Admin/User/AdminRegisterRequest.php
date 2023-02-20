<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class AdminRegisterRequest extends FormRequest {

    public function rules() {
        return [
            'username' => 'required|string|max:55',
            'email' => 'required|email|max:55',
            'phone' => 'required|numeric|digits_between:7,12',
            'password' => 'nullable|min:5|string',
            'cpassword' => 'nullable|min:5|string|required_with:password|same:password'
        ];
    }

    public function messages() {
        return [
            'username.required' => 'Username is required',
            'username.max' => 'The maximum length for Username is 55.',
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
