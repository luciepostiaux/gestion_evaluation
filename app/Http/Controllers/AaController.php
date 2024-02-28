<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAaRequest;
use App\Models\AA;
use App\Models\Criteria;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;
use Inertia\Inertia;

class AaController extends Controller
{
    public function __construct()
    {
        $this->middleware(HandlePrecognitiveRequests::class)->only('store');
    }

    public function create()
    {
        return Inertia::render('Aas/Create');
    }

    public function store(StoreAaRequest $request)
    {

        $validated = $request->validated();

        AA::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'lesson_id' => $validated['lesson_id'],
        ]);

        session()->flash('flash.banner', 'AA ajoutée avec succès!');
    }
}
