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

    Route::get('/listinglesson', function () {
        return Inertia::render('ListingLesson');
    })->name('ListingLesson');

    Route::get('/listingstudent', function () {
        return Inertia::render('ListingStudent');
    })->name('ListingStudent');
    Route::post('/lessons', [LessonController::class, 'store'])->name('lessons.store');
    Route::post('/section', [SectionController::class, 'store'])->name('section.store');
    Route::post('/student', [StudentController::class, 'store'])->name('student.store');
});
