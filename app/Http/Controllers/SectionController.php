<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSectionRequest;
use App\Models\Section;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;
use Inertia\Inertia;

class SectionController extends Controller
{
    public function __construct()
    {
        $this->middleware(HandlePrecognitiveRequests::class)->only('store');
    }

    public function create()
    {
        return Inertia::render('Sections/Create',);
    }
    public function store(StoreSectionRequest $request)
    {

        $validated = $request->validated();
        Section::create([
            'name' => $validated['name'],
        ]);
        session()->flash('flash.banner', 'Section ajoutée avec succès!');
    }



    public function index()
    {
        $sections = Section::all();
        return Inertia::render('Sections/Index', [
            'sections' => $sections,
        ]);
    }
    // public function destroy($id)
    // {
    //     $section = Section::findOrFail($id);
    //     $section->delete();

    //     return redirect()->route('sections.index')->with('success', 'Section deleted successfully.');
    // }
    public function destroy($id)
    {
        $section = Section::findOrFail($id);
        $section->delete();

        // Utilisez Inertia::location pour forcer la redirection côté client
        return Inertia::location(route('sections.index'));
    }

    public function edit($id)
    {
        $section = Section::findOrFail($id);
        return Inertia::render('Sections/Edit', ['section' => $section]);
    }

    public function update(StoreSectionRequest $request, $id)
    {
        $section = Section::findOrFail($id);
        $section->update($request->validated());

        // Redirection côté client après la mise à jour réussie
        return Inertia::location(route('sections.index'));
    }
}
