<?php

namespace App\Http\Requests\Admin\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest {

    public function rules() {
        return [
            'email' => 'required|email|max:55',
            'username' => 'required|string|max:55',
            'phone' => 'required|numeric|digits_between:7,12',
            'password' => 'nullable|min:5|string',
            'cpassword' => 'nullable|min:5|string|required_with:password|same:password'
        ];
    }

    public function messages() {
        return [
            'email.email' => 'The email must be a valid email address.',
            'email.required' => 'The email field is required.',
            'email.max' => 'The maximum length for email is 55.',
            'username.required' => 'The username field is required.',
            'username.max' => 'The maximum length for username is 55.',
            'phone.required' => 'The phone field is required.',
            'phone.numeric' => 'Enter a numeric value as phone number.',
            'password.min' => 'The minimum length for password is 5.',
            'cpassword.min' => 'The minimum length for confirm password is 5.',
            'cpassword.required_with' => 'The confirm password field is required when password is present.',
            'cpassword.same' => 'Enter confirm password same as password.'
        ];
    }

}
