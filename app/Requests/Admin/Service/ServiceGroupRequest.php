<?php

namespace App\Http\Requests\Admin\Service;

use Illuminate\Foundation\Http\FormRequest;

class ServiceGroupRequest extends FormRequest {

    public function rules() {
        return [
            'servicegroup' => 'required'
        ];
    }

    public function messages() {
        return [
            'servicegroup.required' => 'Service Group is required'
        ];
    }

}
