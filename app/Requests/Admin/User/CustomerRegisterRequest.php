<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRegisterRequest extends FormRequest {

    public function rules() {
        return [
            'customername' => 'required|string|max:55',
            'phone' => 'required|numeric|digits_between:7,12',
            'company' => 'required|numeric',
            'password' => 'nullable|min:5|string',
            'cpassword' => 'nullable|min:5|string|required_with:password|same:password'
        ];
    }

    public function messages() {
        return [
            'customername.required' => 'Customer name is required',
            'customername.max' => 'The maximum length for customer name is 55.',
            'phone.required' => 'Phone number is required',
            'phone.numeric' => 'Please enter a numeric value as phone number',
            'company.required' => 'Company is required',
            'company.numeric' => 'Please enter a numeric value as company',
            'password.min' => 'The minimum length for password is 5.',
            'cpassword.min' => 'The minimum length for confirm password is 5.',
            'cpassword.required_with' => 'The confirm password field is required when password is present.',
            'cpassword.same' => 'Enter confirm password same as password.'
        ];
    }

}
