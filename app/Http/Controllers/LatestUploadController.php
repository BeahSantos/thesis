<?php

namespace App\Http\Controllers;

use App\Models\Thesis;
use Illuminate\Http\Request;

class LatestUploadController extends Controller
{
    protected $thesis;

    public function __construct(Thesis $thesis)
    {
        $this->thesis = $thesis;
    }

    public function index(Request $request)
    {
        if ($request->is_accepted != 1) {
            return redirect()->route('welcome.index');
        } else if (!$request->is_accepted) {
            return redirect()->route('welcome.index');
        }

        return view('landing-page.latest-upload.index')->with([
            'data' => $this->thesis
                ->select('id','title','views')
                ->latest()
                ->limit('9')
                ->get(),
        ]);
    }
}
