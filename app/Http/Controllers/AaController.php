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
        // Valider les données entrantes
        $validated = $request->validated();

        // Créer un nouveau AA avec les données validées
        $aa = AA::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            // Assurez-vous d'ajouter tous les champs nécessaires ici
        ]);

        // Si le AA a des critères associés
        if (!empty($validated['aacriteria'])) {
            foreach ($validated['aacriteria'] as $criteria) {
                // Créer les critères associés au AA
                $aa->criteria()->create([
                    'name' => $criteria['value'], // Assurez-vous que le front-end envoie 'value'
                    // Ajoutez d'autres champs nécessaires
                ]);
            }
        }

        // Rediriger l'utilisateur avec un message de succès
        return redirect()->route('aas.create')->with('success', 'AA créé avec succès.');
    }
}
