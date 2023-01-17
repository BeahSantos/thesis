<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\Reason;
use App\Models\Thesis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ThesisController extends Controller
{
    protected $thesis;
    protected $category;
    protected $course;
    protected $reason;

    public function __construct(
        Thesis $thesis, 
        Category $category, 
        Course $course, 
        Reason $reason
    )
    {
        $this->thesis = $thesis;
        $this->category = $category;
        $this->course = $course;
        $this->reason = $reason;
    }

    public function index(Request $request)
    {
        return view('admin.thesis.index')->with([
            'data' => $this->filter($request)->latest()->paginate(10),
            'request' => $request,
            'categories' => $this->category->select('id', 'category_name')->get(),
            'courses' => $this->course->select('id', 'course_title')->get(),
            'reasons' => $this->reason->select('id', 'reason')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'thesis_title' => 'required|min:1|max:250',
            'authors' => 'required|min:1|max:250',
            'course' => 'required',
            'publish_date' => 'required',
            'abstract' => 'required|min:1|max:250',
            'category' => 'required',
            'thesis_file' => 'required'
        ]);

        $file = $validated['thesis_file'];

        $filename = time().'.'.$file->getClientOriginalExtension();

        $request->thesis_file->move('assets', $filename);

        $data = $this->thesis;
        $data->title = $validated['thesis_title'];
        $data->author = $validated['authors'];
        $data->course_id = $validated['course'];
        $data->publish_date = $validated['publish_date'];
        $data->abstract = $validated['abstract'];
        $data->category_id = $validated['category'];
        $data->thesis_file = $filename;
        $data->save();

        if (!$data->save()) {
            return redirect()->route('admin.thesis_archives.index')->with('error', 'Please complete the form');
        }

        return redirect()->route('admin.thesis_archives.index')->with('success', 'Successfully Added!');
    }

    public function update(Request $request, Thesis $thesis)
    {
        $validated = $request->validate([
            'thesis_title' => 'required|min:1|max:250',
            'authors' => 'required|min:1|max:250',
            'course' => 'nullable',
            'publish_date' => 'required',
            'abstract' => 'required|min:1|max:250',
            'category' => 'nullable',
            'thesis_file' => 'nullable'
        ]);

        if (isset($validated['thesis_file'])) {
            $file = $validated['thesis_file'];
            $filename = time().'.'.$file->getClientOriginalExtension();
            $request->thesis_file->move('assets', $filename);
        }

        $data = $thesis;
        $data->title = $validated['thesis_title'];
        $data->author = $validated['authors'];
        $data->course_id = $validated['course'] ?? $data->course_id;
        $data->publish_date = $validated['publish_date'];
        $data->abstract = $validated['abstract'];
        $data->category_id = isset($validated['category']) ? $validated['category'] : $data->category_id;
        $data->thesis_file = isset($validated['thesis_file']) ? $filename : $data->thesis_file;
        $data->save();

        return redirect()->route('admin.thesis_archives.index')->with('success', 'Successfully Updated!');
    }

    public function destroy(Request $request, Thesis $thesis)
    {
        if ($request->reason == null) {
            return redirect()->route('admin.thesis_archives.index')->with('error', 'Please select a reason to delete');
        }

        $thesis->delete();

        return redirect()->route('admin.thesis_archives.index')->with('success', 'Successfully Deleted!');
    }

    private function filter($request)
    {
        $data = $this->thesis->with('category:id,category_name', 'course:id,course_title');

        if (isset($request->search)) {
            $data = $data->where('title', 'LIKE', "%{$request->search}%");
        }

        if ($request->from_date && $request->to_date) {
            $data = $data->whereBetween('publish_date', [$request->from_date, $request->to_date]);
        }

        return $data;
    }
}
