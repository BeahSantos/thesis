<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Thesis;
use Illuminate\Http\Request;

class ThesisController extends Controller
{
    protected $thesis;
    protected $category;

    public function __construct(Thesis $thesis, Category $category)
    {
        $this->thesis = $thesis;
        $this->category = $category;
    }

    public function index(Request $request)
    {
        return view('admin.thesis.index')->with([
            'data' => $this->filter($request)->latest()->paginate(10),
            'request' => $request,
            'categories' => $this->category->select('id', 'category_name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'thesis_title' => 'required|min:1|max:250',
            'authors' => 'required|min:1|max:250',
            'course' => 'required|min:1|max:250',
            'publish_date' => 'required',
            'abstract' => 'required|min:1|max:250',
            'category' => 'required',
        ]);

        $data = $this->thesis;
        $data->title = $validated['thesis_title'];
        $data->author = $validated['authors'];
        $data->course = $validated['course'];
        $data->publish_date = $validated['publish_date'];
        $data->abstract = $validated['abstract'];
        $data->category_id = $validated['category'];
        $data->save();

        return redirect()->route('admin.thesis_archives.index')->with('success', 'Successfully Added!');
    }

    public function update(Request $request, Thesis $thesis)
    {
        $validated = $request->validate([
            'thesis_title' => 'required|min:1|max:250',
            'authors' => 'required|min:1|max:250',
            'course' => 'required|min:1|max:250',
            'publish_date' => 'required',
            'abstract' => 'required|min:1|max:250',
            'category' => 'nullable',
        ]);

        $data = $thesis;
        $data->title = $validated['thesis_title'];
        $data->author = $validated['authors'];
        $data->course = $validated['course'];
        $data->publish_date = $validated['publish_date'];
        $data->abstract = $validated['abstract'];
        $data->category_id = isset($validated['category']) ? $validated['category'] : $data->category_id;
        $data->save();

        return redirect()->route('admin.thesis_archives.index')->with('success', 'Successfully Updated!');
    }

    public function destroy(Thesis $thesis)
    {
        $thesis->delete();

        return redirect()->route('admin.thesis_archives.index')->with('success', 'Successfully Deleted!');
    }

    private function filter($request)
    {
        $data = $this->thesis->with('category:id,category_name');

        if (isset($request->search)) {
            $data->where('title', 'LIKE', "%{$request->search}%");
        }

        return $data;
    }
}
