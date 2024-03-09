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
            'lesson_id' => $validated['lesson_id'],

        ]);
        session()->flash('flash.banner', 'Critère de maîtrise ajouté avec succès!');
    }

    public function destroy($id)
    {
        $skill = Skill::find($id);
        $skill->delete();

        session()->flash('flash.banner', 'Skill supprimé avec succès!');
    }
    public function edit($id)
    {
        $skill = Skill::find($id);
        // Ici, vous pouvez renvoyer une vue avec le formulaire de modification
    }
    public function update(StoreSkillRequest $request, $id)
    {
        $skill = Skill::find($id);
        $skill->update($request->all());

        session()->flash('flash.banner', 'Skill mis à jour avec succès!');
        return redirect()->route('skills.index');
    }
}
