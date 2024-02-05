<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'lastname' => 'required|max:50',
            'firstname' => 'required|max:50',

            'sections' => 'array',


        ]);

        $student = Student::create([
            'lastname' => $validatedData['lastname'],
            'firstname' => $validatedData['firstname']

        ]);
        if (isset($validatedData['sections'])) {
            $student->sections()->attach($validatedData['sections']);
        }

        session()->flash('flash.banner', 'Etudiant(e) ajouté(e) avec succès!');
    }
}
