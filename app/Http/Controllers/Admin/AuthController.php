<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthFormRequest;

class AuthController extends Controller
{
    public function index()
    {
        return view('admin.auth.login');
    }
    public function login(AuthFormRequest $request)
    {
        $validated = $request->validated();
        if (auth()->attempt($validated)) {
            return redirect()->intended('dashboard');
        }
        return redirect("login")->withErrors([
            'message' => 'Incorrect Credentials'
        ]);
    }
    public function logout()
    {
        auth()->logout();

        return redirect()->intended('login');
    }
}
