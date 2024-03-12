<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSkillRequest;
use Illuminate\Http\Request;
use App\Models\Criteria;
use App\Models\Lesson;
use App\Models\Skill;

class SkillController extends Controller
{
    public function store(StoreSkillRequest $request)
    {
        $lesson = Lesson::findOrFail($request->lesson_id);
        $validated = $request->validated();

        $lesson->skills()->create([
            'name' => $validated['name'],
            'notation' => $validated['notation'],
        ]);
        session()->flash('flash.banner', 'Skill ajoutée avec succès!');
    }

    public function destroy($id)
    {
        $skill = Skill::findOrFail($id);
        $skill->delete();

        // Utilisez Inertia::location pour forcer la redirection côté client
        session()->flash('flash.banner', 'Skill supprimé avec succès!');
    }
    public function edit($id)
    {
        $skill = Skill::find($id);
        // Ici, vous pouvez renvoyer une vue avec le formulaire de modification
    }
    public function update(StoreSkillRequest $request, $id)
    {
        $skill = Skill::findOrFail($id);
        $skill->update($request->validated());

        // Redirection côté client après la mise à jour réussie
        session()->flash('flash.banner', 'skill modifié avec succès!');
    }
}
