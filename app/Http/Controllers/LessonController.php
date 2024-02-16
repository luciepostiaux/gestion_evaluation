<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLessonRequest;
use App\Models\AA;
use App\Models\Lesson;
use App\Models\LessonStudent;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class LessonController extends Controller
{
    public function __construct()
    {
        $this->middleware(HandlePrecognitiveRequests::class)->only('store');
    }

    public function create()
    {
        $sections = Section::all();
        return Inertia::render('Lessons/Create', [
            'sections' => $sections
        ]);
    }
    public function store(StoreLessonRequest $request)
    {
        $validated = $request->validated();
        Auth::user()->lessons()->create([
            'name' => $validated['name'],
            'section_id' => $validated['section_id'],

        ]);
        session()->flash('flash.banner', 'Cours ajouté avec succès!');
    }



    public function index($id = null)
    {
        $lessons = Lesson::where('user_id', Auth::id())->get();

        if ($id !== null) {
            $selectedLesson = Lesson::find($id);
            $aa = AA::where('lesson_id', $selectedLesson->id)->get();
            $studentIds = LessonStudent::where('lesson_id', $selectedLesson->id)->pluck('student_id');
            $studentslist = Student::query()->wherein('id', $studentIds)->get();
        } else {
            $selectedLesson = null;
            $studentIds = null;
            $studentslist = null;
            $aa = null;
        }
        return Inertia::render('Lessons/Index', [
            'lessons' => $lessons,
            'selectedLesson' => $selectedLesson,
            'studentslist' => $studentslist,
            'aa' => $aa,
        ]);
    }
    public function addStudent($lessonId)
    {
        $students = Student::all(); // Récupère tous les élèves
        $studentsLessonIds = LessonStudent::where('lesson_id', $lessonId)->pluck('student_id'); // Récupère les IDs des élèves inscrits au cours
        $studentsLessonList = Student::whereIn('id', $studentsLessonIds)->get(); // Utilise whereIn pour filtrer les élèves par leurs IDs
        $lesson = Lesson::find($lessonId); // Trouve le cours par son ID

        return Inertia::render(
            'Lessons/AddStudent',
            [
                'lesson' => $lesson,
                'students' => $students,
                'studentsLessonList' => $studentsLessonList // Cette liste contiendra maintenant les élèves enregistrés dans le cours
            ]
        );
    }
    public function addStudentLesson(Request $request)
    {
        Validator::make($request->all(), [
            'student_id' => ['required'],
            'lesson_id' => ['required'],
        ])->validate();
        $exists = LessonStudent::where('student_id', $request->student_id)
            ->where('lesson_id', $request->lesson_id)
            ->exists();

        if (!$exists) {
            LessonStudent::create(['student_id' => $request->student_id, 'lesson_id' => $request->lesson_id]);
        }
    }
    public function deleteStudentLesson(Request $request)
    {
        Validator::make($request->all(), [
            'student_id' => ['required'],
            'lesson_id' => ['required'],
        ])->validate();
        $inscrit = LessonStudent::where('student_id', $request->student_id)
            ->where('lesson_id', $request->lesson_id)
            ->first(); // Assurez-vous d'utiliser first() pour obtenir un modèle unique
        $inscrit->delete();
    }
}
