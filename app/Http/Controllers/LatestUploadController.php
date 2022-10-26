<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LatestUploadController extends Controller
{
    public function index()
    {
        return view('landing-page.latest-upload.index');
    }
}
