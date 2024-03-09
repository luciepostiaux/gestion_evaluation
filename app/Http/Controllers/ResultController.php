<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Student;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ResultController extends Controller
{
    public function adjournement($lessonId, $studentId)
    {
        $lesson = Lesson::find($lessonId);
        $student = Student::find($studentId);
        return Inertia::render('Results/Adjournement', [
            'lesson' => $lesson,
            'student' => $student,
        ]);
    }


    public function refuse($courseId, $studentId)
    {
        $lesson = Lesson::find($courseId);
        $student = Student::find($studentId);

        return Inertia::render('Results/Refuse', [
            'lesson' => $lesson,
            'student' => $student,
        ]);
    }
    public function evaluation()
    {
        return Inertia::render('Results/Evaluation');
    }
    public function accept(Request $request, $studentId, $lessonId)
    {
        $note = $request->query('finalResult'); // Accès via les paramètres de requête

        $lesson = Lesson::find($lessonId);
        $student = Student::find($studentId);

        return Inertia::render('Results/Accept', [
            'lesson' => $lesson,
            'student' => $student,
            'note' => $note,
        ]);
    }
}
