<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSkillRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Assurez-vous de retourner `true` ici si vous voulez permettre à tous les utilisateurs de faire cette demande
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'lesson_id' => ['required', 'integer', 'exists:lessons,id'], // Assurez-vous que le lesson_id existe dans la table lessons
            'notation' => ['required', 'integer'],
        ];
    }
}
