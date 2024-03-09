<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LessonStudent;

class LessonStudentController extends Controller
{
    public function update($lessonId, $studentId)
    {
        // Trouve l'entrée correspondante dans la table pivot et met à jour le statut
        $lessonStudent = LessonStudent::where('lesson_id', $lessonId)
            ->where('student_id', $studentId)
            ->first();

        if ($lessonStudent) {
            $lessonStudent->status = 1; // Met à jour le statut
            $lessonStudent->save();

            session()->flash('flash.banner', 'Étudiant ajouté en Ajournement!');
        } else {
            return back()->with('error', 'Entrée non trouvée.');
        }
    }
    public function updaterefuse($lessonId, $studentId)
    {
        // Trouve l'entrée correspondante dans la table pivot et met à jour le statut
        $lessonStudent = LessonStudent::where('lesson_id', $lessonId)
            ->where('student_id', $studentId)
            ->first();

        if ($lessonStudent) {
            $lessonStudent->status = 2; // Met à jour le statut
            $lessonStudent->save();

            session()->flash('flash.banner', 'Étudiant ajouté en Ajournement!');
        } else {
            return back()->with('error', 'Entrée non trouvée.');
        }
    }
    public function updateaccept($lessonId, $studentId)
    {
        // Trouve l'entrée correspondante dans la table pivot et met à jour le statut
        $lessonStudent = LessonStudent::where('lesson_id', $lessonId)
            ->where('student_id', $studentId)
            ->first();

        if ($lessonStudent) {
            $lessonStudent->status = 3; // Met à jour le statut
            $lessonStudent->save();

            session()->flash('flash.banner', 'Réussite enregistrée');
        } else {
            return back()->with('error', 'Entrée non trouvée.');
        }
    }
}
