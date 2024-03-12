<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSkillStudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {

        return [
            'note' => ['required', 'integer'],
            'student_id' => ['required', 'exists:students,id'],
            'skill_id' => ['required', 'exists:skills,id'],
        ];
    }
}
