<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Thesis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Session;

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
            'latestUpload' => $data->latest()->limit('2')->get(),
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
            $data = $data->whereHas('category', function ($query) use ($request) {
                $query->where('id', $request->category);
            });
        }

        if ($request->from_date && $request->to_date) {
            $data = $data->whereBetween('publish_date', [$request->from_date, $request->to_date]);
        }
        
        return $data;
    }

    public function showThesis($thesis)
    {
        $data = $this->thesis->where('id', $thesis)->select('id','thesis_file','views', 'title')->first();
        $data->increment('views');

        return view('landing-page.show-thesis-file')->with([
            'data' => $data
        ]);
    }

    public function storeStudentInfo(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|min:1|max:250',
            'middle_name' => 'required|min:1|max:250',
            'last_name' => 'required|min:1|max:250',
            'year' => 'required|min:1|max:2',
            'course' => 'required|min:1|max:250',
            'student_number' => 'required|min:1|max:250'
        ]);

        $data[] = array(
            'First Name' => isset($validated['first_name']) ? $validated['first_name'] : '',
            'Middle Name' => isset($validated['middle_name']) ? $validated['last_name'] : '',
            'Last Name' => isset($validated['last_name']) ? $validated['last_name'] : '',
            'Year' => isset($validated['year']) ? $validated['year'] : '',
            'Course' => isset($validated['course']) ? $validated['course'] : '',
            'Student Number' => isset($validated['student_number']) ? $validated['student_number'] : '',
        );

        Session::put('student-info', $data); //Putting student's data into session

        return back()->with('success', 'You can now download the file!');
    }

    public function download($file)
    {
            $filename = $this->thesis->where('id', $file)->select('thesis_file')->first();

            return response()->download(public_path('assets/'. $filename->thesis_file));
    }
}
