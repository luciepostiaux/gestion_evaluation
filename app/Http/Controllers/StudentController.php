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
}
