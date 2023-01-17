<?php

namespace App\Http\Controllers;

use App\Models\Thesis;
use Illuminate\Http\Request;

class AlphabeticalThesisController extends Controller
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

        return view('landing-page.alphabetical-thesis.index')->with([
            'data' => $this->filter($request)
                ->orderBy('title', 'asc')
                ->paginate(9),
            'request' => $request,
        ]);
    }

    private function filter($request)
    {
        $data = $this->thesis
            ->select('*');

        if ($request->search) {
            $data = $data->where('title', 'LIKE', "%{$request->search}%");
        }

        if ($request->category) {
            $data = $data->where('category_id', $request->category);
        }

        if ($request->from_date && $request->to_date) {
            $data = $data->whereBetween('created_at', [$request->from_date, $request->to_date]);
        }

        return $data;
    }
}
