<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAaRequest;
use App\Models\AA;
use App\Models\Criteria;
use App\Models\Lesson;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;
use Inertia\Inertia;

class AaController extends Controller
{
    public function __construct()
    {
        $this->middleware(HandlePrecognitiveRequests::class)->only('store');
    }

    public function edit(int $id)
    {
        $lesson = Lesson::findOrFail($id);
        $skills = $lesson->skills;
        $aa = $lesson->aas;
        // $criterias = $aa->criteria;
        return Inertia::render('Aas/Create', [
            'lesson' => $lesson,
            'skills' => $skills,
            'aa' => $aa,
            // 'criterias' => $criterias,

        ]);
    }

    public function store(StoreAaRequest $request)
    {
        $lesson = Lesson::findOrFail($request->lesson_id);
        $validated = $request->validated();

        $lesson->aa()->create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'lesson_id' => $validated['lesson_id'],
        ]);
        // $lesson->criterias()->create([
        //     'name' => $validated['name'],
        //     // 'description' => $validated['description'],
        //     'lesson_id' => $validated['lesson_id'],
        // ]);
        session()->flash('flash.banner', 'AA ajoutée avec succès!');
    }
}
