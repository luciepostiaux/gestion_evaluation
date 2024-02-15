<?php

namespace App\Http\HomepageController;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class HomepageController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function index()
    {
        return view('homepage.index', []);
    }
}
