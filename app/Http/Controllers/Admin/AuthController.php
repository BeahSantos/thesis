<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $admin;

    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }

    public function index()
    {
        return view('admin.auth.index');
    }

    public function authenticate(Request $request)
    {
        $validated = $request->validate([
            'email' => 'email',
            'password' => 'required|string|min:1|max:250'
        ]);

        if (Auth::guard('admin')->attempt($validated)) {
            $request->session()->regenerate();

            return redirect()->intended('/admin/thesis-archives');
        }

        return back()->onlyInput('email');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect()->route('welcome.index');
    }
}
