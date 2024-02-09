<?php

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



    Route::resource('lessons', LessonController::class)->only(['index', 'store', 'create']);
    Route::resource('students', StudentController::class)->only(['index', 'store', 'create']);
    Route::resource('sections', SectionController::class)->only(['index', 'store', 'create']);
});
