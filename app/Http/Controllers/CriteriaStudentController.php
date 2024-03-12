<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCriteriaStudentRequest;
use App\Models\CriteriaStudent;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CriteriaStudentController extends Controller
{
    public function update(StoreCriteriaStudentRequest $request)
    {

        $attributes = $request->validated();
        $criteriaStudent = CriteriaStudent::updateOrCreate(
            [
                'criteria_id' => $attributes['criteria_id'],
                'student_id' => $attributes['student_id'],
            ],
            $attributes
        );

        session()->flash('flash.banner', 'Étudiant noté avec succès!');
        return redirect()->back();
    }
}
