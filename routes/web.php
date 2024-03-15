<?php

use App\Http\Controllers\AaController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\CriteriaStudentController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\LessonStudentController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\SkillStudentController;
use App\Http\Controllers\StudentController;
use App\Models\Lesson;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');


    Route::get('/results/evaluation', [ResultController::class, 'evaluation'])->name('results.evaluation');
    Route::get('/results/adjournement', [ResultController::class, 'adjournement'])->name('results.adjournement');
    Route::get('/results/refuse', [ResultController::class, 'refuse'])->name('results.refuse');
    Route::get('/lessons/addStudent/{lessonId}', [LessonController::class, 'addStudent'])->name('lessons.addStudent');
    Route::post('lessons/addstudentlesson', [LessonController::class, 'addStudentLesson'])->name('lessons.AddStudentlesson');
    Route::delete('lessons/deletestudentlesson', [LessonController::class, 'deleteStudentLesson'])->name('lessons.DeleteStudentLesson');



    Route::get('/skills/{id}/edit', [SkillController::class, 'edit'])->name('skills.edit');
    Route::post('/aas/{id}/criteria', [AaController::class, 'addCriteria'])->name('aas.addCriteria');


    Route::resource('lessons', LessonController::class)->only(['store', 'create']);
    Route::resource('students', StudentController::class)->only(['index', 'store', 'create', 'edit', 'update']);
    Route::resource('sections', SectionController::class)->only(['index', 'store', 'create', 'edit']);
    Route::resource('aas', AaController::class)->only(['create', 'store']);
    Route::resource('skills', SkillController::class)->only(['create', 'store']);

    Route::delete('/sections/{section}', [SectionController::class, 'destroy'])->name(
        'sections.destroy'
    );
    Route::delete('/lessons/{lesson}', [LessonController::class, 'destroy'])->name(
        'lessons.destroy'
    );
    Route::delete('/aas/{aa}', [AaController::class, 'destroy'])->name(
        'aas.destroy'
    );
    Route::delete('/criterias/{criteria}', [AaController::class, 'destroyCriteria'])->name(
        'criterias.destroy'
    );
    Route::delete('/skills/{skill}', [SkillController::class, 'destroy'])->name(
        'skills.destroy'
    );
    Route::delete('/students/{students}', [StudentController::class, 'destroy'])->name('students.destroy');
    Route::get('/students/{courseId}/{studentId}/note', [StudentController::class, 'note'])->name('students.note');
    Route::put('/CriteriaStudents/{CriteriaStudent}', [CriteriaStudentController::class, 'update'])->name('criteriastudents.update');
    Route::put('/studentlesson/update/{lessonId}/{studentId}', [LessonStudentController::class, 'update'])->name('studentlesson.update');
    Route::put('/studentlesson/updaterefuse/{lessonId}/{studentId}', [LessonStudentController::class, 'updaterefuse'])->name('studentlesson.updaterefuse');
    Route::put('/studentlesson/updateaccept/{lessonId}/{studentId}', [LessonStudentController::class, 'updateaccept'])->name('studentlesson.updateaccept');
    Route::put('/SkillStudents/{SkillStudent}', [SkillStudentController::class, 'update'])->name('skillstudents.update');
    Route::get('/results/adjournement/{courseId}/{studentId}', [ResultController::class, 'adjournement'])->name('results.adjournement');
    Route::get('/results/refuse/{courseId}/{studentId}', [ResultController::class, 'refuse'])->name('results.refuse');
    Route::get('/results/accept/{studentId}/{lessonId}', [ResultController::class, 'accept'])->name('results.accept');
    Route::get('aas/lessons/{id}', [AaController::class, 'edit'])->name('aas.edit');
    Route::get('lessons/{id?}', [LessonController::class, 'index'])->name('lessons.index');
    Route::put('/sections/{section}', [SectionController::class, 'update'])->name('sections.update');
    Route::put('/students/{student}', [StudentController::class, 'update'])->name('students.update');
    Route::put('/aas/{aa}', [AaController::class, 'update'])->name('aas.update');
    Route::put('/skills/{skill}', [SkillController::class, 'update'])->name('skills.update');
    Route::put('/lessons/{lesson}', [LessonController::class, 'update'])->name('lessons.update');

    Route::put('/criterias/{criteria}', [AaController::class, 'updateCriteria'])->name('aas.updateCriteria');
    Route::get('/sections/{section}/lessons', [LessonController::class, 'indexBySection'])->name('sections.lessons.index');
});
