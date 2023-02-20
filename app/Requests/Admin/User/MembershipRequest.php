<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class MembershipRequest extends FormRequest {

    public function rules() {
        return [
            'name' => 'required|string|max:25',
            'staff' => 'required|numeric'
        ];
    }

    public function messages() {
        return [
            'name.required' => 'Name is required',
            'name.max' => 'The maximum length for name is 25.',
            'staff.required' => 'No of Staff is required',
            'staff.numeric' => 'Please enter a numeric value as No of staff'
        ];
    }

}
