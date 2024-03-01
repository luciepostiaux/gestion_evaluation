<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class ResultController extends Controller
{
    public function adjournement()
    {
        return Inertia::render('Results/Adjournement');
    }

    public function refuse()
    {
        return Inertia::render('Results/Refuse');
    }
}

