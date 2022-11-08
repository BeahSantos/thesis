<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Thesis;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    protected $category;
    protected $thesis;

    public function __construct(Category $category, Thesis $thesis)
    {
        $this->category = $category;
        $this->thesis = $thesis;
    }

    public function index(Request $request)
    {
        $data = $this->filter($request);

        return view('landing-page.welcome')->with([
            'request' => $request,
            'results' => $data->get(),
            'mostViewedThesis' => $data->orderBy('views', 'desc')->limit('9')->get(),
            'latestUpload' => $data->latest()->limit('9')->get(),
            'categories' => $this->category->get()
        ]);
    }

    private function filter($request)
    {
        $data = $this->thesis;

        if (isset($request->search)) {
            $data = $data->where('title', 'LIKE', "%{$request->search}%");
        }

        if (isset($request->category)) {
            $data = $data->whereHas('category', function($query) use ($request) {
                $query->where('id', $request->category);
            });
        }

        return $data;
    }
}
