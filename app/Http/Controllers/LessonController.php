<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLessonRequest;
use App\Models\AA;
use App\Models\Lesson;
use App\Models\LessonStudent;
use App\Models\Section;
use App\Models\Student;
use App\Models\User;
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
        // Récupère les leçons où l'utilisateur connecté est le user_id ou le second_user_id
        $lessons = Lesson::where('user_id', Auth::id())
            ->orWhere('second_user_id', Auth::id())
            ->get();

        if ($id !== null) {
            $selectedLesson = Lesson::find($id);
            $aa = $selectedLesson ? AA::where('lesson_id', $selectedLesson->id)->get() : null;
            $studentIds = $selectedLesson ? LessonStudent::where('lesson_id', $selectedLesson->id)->pluck('student_id') : null;
            $studentslist = $studentIds ? Student::whereIn('id', $studentIds)->get() : null;
        } else {
            $selectedLesson = null;
            $studentslist = null;
            $aa = null;
        }

        // Récupère tous les utilisateurs sauf l'utilisateur actuellement connecté
        $allTeachers = User::where('id', '!=', Auth::id())->get();

        return Inertia::render('Lessons/Index', [
            'lessons' => $lessons,
            'selectedLesson' => $selectedLesson,
            'studentslist' => $studentslist,
            'aa' => $aa,
            'allTeachers' => $allTeachers, // Ajoutez cette ligne
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
            LessonStudent::create(['student_id' => $request->student_id, 'lesson_id' => $request->lesson_id, 'status' => 0]);
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
            ->first();
        $inscrit->delete();
    }
    public function update(Request $request, Lesson $lesson)
    {
        $validatedData = $request->validate([
            'second_user_id' => 'nullable|exists:users,id'
        ]);

        $lesson->update($validatedData);

        return redirect()->back()->with('message', 'Co-professeur ajouté avec succès.');
    }

    public function indexBySection(Section $section)
    {
        $lessons = $section->lessons;

        return Inertia::render('Sections/Lessons', [
            'section' => $section,
            'lessons' => $section->lessons,
        ]);
    }
}
