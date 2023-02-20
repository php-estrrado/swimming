<?php

namespace App\Http\Requests\Admin\Settings;

use Illuminate\Foundation\Http\FormRequest;

class EmailRequest extends FormRequest {

    public function rules() {
        return [
            'identifier' => 'required|max:150',
            'title' => 'required|max:150',
            'description' => 'required'
        ];
    }

    public function messages() {
        return [
            'identifier.required' => 'Identifier is required',
            'identifier.max' => 'The maximum length for identifier is 150.',
            'title.required' => 'Title is required',
            'title.max' => 'The maximum length for title is 150.',
            'description.required' => 'Description is required'
        ];
    }

}
