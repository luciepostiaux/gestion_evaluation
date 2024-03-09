<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAaRequest;
use App\Http\Requests\StoreCriteriaRequest;
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
        $aas = $lesson->aas;
        $aas->load('criteria');
        // dd($aas);
        return Inertia::render('Aas/Create', [
            'lesson' => $lesson,
            'skills' => $skills,
            'aas' => $aas,
            // 'criterias' => $criterias,

        ]);
    }

    public function store(StoreAaRequest $request)
    {
        $lesson = Lesson::findOrFail($request->lesson_id);
        $validated = $request->validated();

        $lesson->aas()->create([
            'name' => $validated['name'],
        ]);
        session()->flash('flash.banner', 'AA ajoutée avec succès!');
    }

    public function storeCriteria(StoreCriteriaRequest $request)
    {
        $validated = $request->validated();

        $criteria = new Criteria();
        $criteria->name = $validated['name'];
        $criteria->aa_id = $validated['aa_id'];
        $criteria->save();

        session()->flash('flash.banner', 'Critère ajouté avec succès!');
    }
    public function destroy($id)
    {
        $aa = AA::findOrFail($id);
        $aa->delete();

        // Utilisez Inertia::location pour forcer la redirection côté client
        session()->flash('flash.banner', 'AA supprimé avec succès!');
    }
    public function destroyCriteria($id)
    {
        $criteria = Criteria::findOrFail($id);
        $criteria->delete();

        // Utilisez Inertia::location pour forcer la redirection côté client
        session()->flash('flash.banner', 'AA supprimé avec succès!');
    }
    public function update(StoreAaRequest $request, $id)
    {
        $aa = Aa::findOrFail($id);
        $aa->update($request->validated());

        // Redirection côté client après la mise à jour réussie
        session()->flash('flash.banner', 'Aa renommée avec succès!');
    }

    public function addCriteria(StoreCriteriaRequest $request, $id)
    {
        $aa = Aa::find($id);
        $aa->criteria()->create($request->all());
        session()->flash('flash.banner', 'Critère créé avec succès!');
    }
    public function updateCriteria(StoreCriteriaRequest $request, $id)
    {
        $criteria = Criteria::findOrFail($id);
        if ($criteria->a_a_s_id != $request->input('aa_id')) {
            abort(403, 'Operation non autorisée.');
        }
        $criteria->update($request->validated());
        session()->flash('flash.banner', 'Critère renommé avec succès!');
    }
}
