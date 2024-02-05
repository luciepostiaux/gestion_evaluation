<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Lesson;
use Inertia\Inertia;

class LessonController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:50',
            'description' => 'required',
        ]);

        $lesson = Lesson::create([
            'user_id' => Auth::id(),
            'name' => $validatedData['name'],
            'description' => $validatedData['description']
        ]);

        session()->flash('flash.banner', 'Cours ajouté avec succès!');
    }

    // Dans DashboardController ou un contrôleur similaire


    public function index()
    {
        $user = Auth::user();
        $lessons = $user->lessons; // Assurez-vous que la relation 'courses' est définie dans le modèle User

        return Inertia::render('ListingLesson', [
            'lesson' => $lessons
        ]);
    }
}
