<?php

namespace App\Http\Requests\Admin\Settings;

use Illuminate\Foundation\Http\FormRequest;

class FaqRequest extends FormRequest {

    public function rules() {
        return [
            'question' => 'required|max:150',
            'answer' => 'required'
        ];
    }

    public function messages() {
        return [
            'question.required' => 'Question is required',
            'question.max' => 'The maximum length for question is 150.',
            'answer.required' => 'Answer is required'
        ];
    }

}
