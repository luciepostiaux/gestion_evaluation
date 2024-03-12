<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCriteriaStudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {

        return [
            'note' => ['required', 'boolean'],
            'student_id' => ['required', 'exists:students,id'],
            'criteria_id' => ['required', 'exists:criterias,id'],
        ];
    }
}
