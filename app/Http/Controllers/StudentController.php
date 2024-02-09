<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
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
        return Inertia::render('Students/Create',);
    }
    public function store(StoreStudentRequest $request)
    {

        $validated = $request->validated();
        Student::create([
            'firstname' => $validated['firstname'],
            'lastname' => $validated['lastname'],
        ]);
        session()->flash('flash.banner', 'Elève ajouté(e) avec succès!');
    }



    public function index()
    {
        $students = Student::all();
        return Inertia::render('Students/Index', [
            'students' => $students,
        ]);
    }
}