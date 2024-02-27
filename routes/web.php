<?php

use App\Http\Controllers\AaController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StudentController;
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

    Route::get('/lessons/addStudent/{lessonId}', [LessonController::class, 'addStudent'])->name('lessons.addStudent');
    Route::post('lessons.addstudentlesson', [LessonController::class, 'addStudentLesson'])->name('lessons.AddStudentlesson');
    Route::delete('lessons.deletestudentlesson', [LessonController::class, 'deleteStudentLesson'])->name('lessons.DeleteStudentLesson');



    Route::resource('lessons', LessonController::class)->only(['store', 'create']);

    Route::resource('students', StudentController::class)->only(['index', 'store', 'create', 'edit', 'update']);
    Route::resource('sections', SectionController::class)->only(['index', 'store', 'create', 'edit']);
    Route::delete('/sections/{section}', [SectionController::class, 'destroy'])->name(
        'sections.destroy'
    );
    Route::delete('/students/{students}', [StudentController::class, 'destroy'])->name('students.destroy');

    Route::resource('aas', AaController::class)->only(['create', 'store']);
    Route::post('/criteria', [CriteriaController::class, 'store'])->name('criteria.store');


    Route::get('lessons/{id?}', [LessonController::class, 'index'])->name('lessons.index');
    Route::put('/sections/{section}', [SectionController::class, 'update'])->name('sections.update');
    Route::get('/sections/{section}/lessons', [LessonController::class, 'indexBySection'])->name('sections.lessons.index');
});
