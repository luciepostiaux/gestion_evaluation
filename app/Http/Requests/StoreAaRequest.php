<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Assurez-vous que l'utilisateur est autorisé à faire cette action
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'lesson_id' => ['required', 'integer', 'exists:lessons,id'], // Assurez-vous que lesson_id existe dans la table lessons
            'aacriteria' => ['required', 'array'],
            'aacriteria.*.value' => ['required', 'string', 'max:255'], // Valide chaque critère individuellement
        ];
    }
}
