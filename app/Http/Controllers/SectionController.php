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
}
