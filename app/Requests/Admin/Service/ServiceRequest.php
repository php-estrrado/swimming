<?php

namespace App\Http\Requests\Admin\Service;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest {

    public function rules() {
        return [
            'servicename' => 'required',
            'servicegroup' => 'required'
        ];
    }

    public function messages() {
        return [
            'servicename.required' => 'Service Name is required',
            'servicegroup.required' => 'Service Group is required'
        ];
    }

}
