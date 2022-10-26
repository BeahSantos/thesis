<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MostViewedThesisController extends Controller
{
    public function index()
    {
        return view('landing-page.most-viewed-thesis.index');
    }
}
