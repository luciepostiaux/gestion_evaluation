<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Assurez-vous que l'utilisateur est autorisé à faire cette action
    }

    // Dans StoreAaRequest et StoreCriteriaRequest ou équivalent
    public function rules()
    {

        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'lesson_id' => ['required', 'exists:lessons,id'],
        ];
    }
}
