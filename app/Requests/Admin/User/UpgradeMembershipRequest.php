<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class UpgradeMembershipRequest extends FormRequest {

    public function rules() {
        return [
            'membership' => 'required|numeric',
            'validity' => 'required|numeric'
        ];
    }

    public function messages() {
        return [
            'membership.required' => 'Membership is required',
            'membership.numeric' => 'Membership should be numeric value',
            'validity.required' => 'Validity is required',
            'validitymembership.numeric' => 'Validity should be numeric value'
        ];
    }

}
