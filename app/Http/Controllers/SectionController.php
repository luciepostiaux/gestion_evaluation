<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;

class SectionController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:50'
        ]);

        $section = Section::create([
            'name' => $validatedData['name']
        ]);

        session()->flash('flash.banner', 'Classe ajoutée avec succès!');
    }
}
