<?php

namespace App\Http\Requests\Admin\Settings;

use Illuminate\Foundation\Http\FormRequest;

class SmsPackageRequest extends FormRequest {

    public function rules() {
        return [
            'packagename' => 'required',
            'noofmessages' => 'required|numeric',
            'spdstatus' => 'required'
        ];
    }

    public function messages() {
        return [
            'packagename.required' => 'The packagename field is required.',
            'noofmessages.required' => 'The no of messages field is required.',
            'noofmessages.numeric' => 'The no of messages field must be numeric.',
            'spdstatus.required' => 'The status field is required.'
        ];
    }

}
