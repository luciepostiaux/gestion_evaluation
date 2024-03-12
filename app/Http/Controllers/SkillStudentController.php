<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSkillStudentRequest;
use App\Models\CriteriaStudent;
use App\Models\SkillStudent;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SkillStudentController extends Controller
{
    public function update(StoreSkillStudentRequest $request)
    {
        $attributes = $request->validated();
        $skillStudent = SkillStudent::updateOrCreate(
            [
                'skill_id' => $attributes['skill_id'],
                'student_id' => $attributes['student_id'],
            ],
            $attributes
        );

        session()->flash('flash.banner', 'Étudiant noté avec succès!');
        return redirect()->back();
    }
}
