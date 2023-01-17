<?php

namespace App\Http\Controllers;

use App\Models\Thesis;
use Illuminate\Http\Request;

class MostViewedController extends Controller
{
    protected $thesis;

    public function __construct(Thesis $thesis)
    {
        $this->thesis = $thesis;
    }

    public function index(Request $request)
    {
        return view('landing-page.most-viewed.index')->with([
            'data' => $this->thesis
                ->select('id','title','views')
                ->orderBy('views', 'desc')
                ->limit('9')
                ->get(),
            'request' => $request
        ]);
    }
}
