<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
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
            'section_id' => $validated['section_id']
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
