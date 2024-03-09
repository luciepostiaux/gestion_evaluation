<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Models\Lesson;
use App\Models\LessonStudent;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;
use Inertia\Inertia;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware(HandlePrecognitiveRequests::class)->only('store');
    }

    public function create()
    {
        $sections = Section::all();

        return Inertia::render('Students/Create', [
            'sections' => $sections
        ]);
    }
    public function store(StoreStudentRequest $request)
    {

        $validated = $request->validated();
        Student::create([
            'firstname' => $validated['firstname'],
            'lastname' => $validated['lastname'],
            'section_id' => $validated['section_id'],
        ]);
        session()->flash('flash.banner', 'Élève ajouté(e) avec succès!');
    }



    public function index()
    {
        $students = Student::all();
        return Inertia::render('Students/Index', [
            'students' => $students,
        ]);
    }


    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        // Utilisez Inertia::location pour forcer la redirection côté client
        return Inertia::location(route('students.index'));
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return Inertia::render('Students/Edit', ['student' => $student]);
    }

    public function update(StoreStudentRequest $request, $id)
    {

        $student = Student::findOrFail($id);
        $student->update($request->validated());

        // Redirection côté client après la mise à jour réussie
        return Inertia::location(route('students.index'));
    }
    public function note($courseId, $studentId)
    {
        // Trouver l'élève par son ID
        $student = Student::findOrFail($studentId);

        // Trouver le cours (lesson) par son ID, avec les relations préchargées pour optimisation
        $lesson = Lesson::with('aas.criteria', 'skills')->findOrFail($courseId);

        $lessonStatus = LessonStudent::where('student_id', $studentId)
            ->where('lesson_id', $courseId)
            ->first()
            ->status;
        $aas = $lesson->aas->map(function ($aa) use ($studentId) {
            // Pour chaque AA, récupérer les critères et ajouter les notes des élèves si disponibles
            $aa->criteria = $aa->criteria->map(function ($criteri) use ($studentId) {
                $criteriaStudentNote = $criteri->criteriastudents()->where('student_id', $studentId)->first();
                $criteri->studentNote = $criteriaStudentNote ? $criteriaStudentNote : "";
                return $criteri;
            });
            return $aa;
        });

        // Récupérer les compétences (skills) liées au cours
        $skills = $lesson->skills->map(function ($skill) use ($studentId) {
            // Ajouter les notes des élèves pour chaque compétence, si disponibles
            $skillStudentNote = $skill->skillstudent()->where('student_id', $studentId)->first();

            $skill->studentNote = $skillStudentNote ? $skillStudentNote : "";
            return $skill;
        });

        return Inertia::render('Results/Evaluation', [
            'student' => $student,
            'lesson' => $lesson,
            'aas' => $aas,
            'skills' => $skills,
            'lessonStatus' => $lessonStatus // Ajoutez cette ligne pour inclure le statut
        ]);
    }
}
