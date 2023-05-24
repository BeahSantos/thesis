<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Thesis;
use Illuminate\Http\Request;

class RecycleBinController extends Controller
{
    protected $thesis;

    public function __construct(Thesis $thesis)
    {
        $this->thesis = $thesis;
    }

    public function index(Request $request)
    {
        return view('admin.thesis.recycle-bin.index')->with([
            'data' => $this->filter($request)->paginate(10),
            'request' => $request,
        ]);
    }

    public function restore($thesis)
    {
        $data = $this->thesis->onlyTrashed()->findOrFail($thesis);
        $data->restore();

        return redirect()->route('admin.thesis_archives.recycle_bin.index')
            ->with('success', 'Successfully restored!');
    }

    public function delete($thesis)
    {
        $data = $this->thesis->onlyTrashed()->findOrFail($thesis);
        $data->forceDelete();

        return redirect()->route('admin.thesis_archives.recycle_bin.index')
            ->with('success', 'Successfully deleted!');
    }

    private function filter($request)
    {
        $data = $this->thesis->onlyTrashed()
            ->with('reason');

        if ($request->search) {
            $data->where('title', 'LIKE', "%{$request->search}%");
        }

        return $data;
    }
}
