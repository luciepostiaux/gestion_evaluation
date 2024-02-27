<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class AaController extends Controller
{
    public function create()
    {
        return Inertia::render('Aa/Create');
    }
}
