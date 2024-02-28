<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Criteria;
use App\Http\Requests\StoreCriteriaRequest; // Assurez-vous que cette classe existe et est correctement définie

class CriteriaController extends Controller
{
    public function store(StoreCriteriaRequest $request)
    {
        // Valider les données entrantes (si vous avez une classe de demande spécifique)
        $validated = $request->validated();

        // Créer un nouveau critère avec les données validées
        $criteria = Criteria::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            // Ajoutez d'autres champs nécessaires ici
            'lesson_id' => $validated['lesson_id'], // Assurez-vous que cela est inclus si c'est nécessaire pour vos critères
            // Vous pouvez avoir besoin d'autres champs en fonction de votre base de données et de vos besoins d'application
        ]);

        // Vous pouvez choisir de rediriger l'utilisateur ou de renvoyer une réponse JSON
        return response()->json(['success' => 'Critère créé avec succès.', 'data' => $criteria], 200);
    }
}
