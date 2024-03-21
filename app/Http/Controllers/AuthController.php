<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function logout()
    {
        Auth::logout();
        return to_route('link.index');
    }

    public function doLogin(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            session()->regenerate();
            return redirect()->route('link.index');
        }

        return redirect()->route('login.get')->withErrors([
            'credentials' => 'Identifiants invalides. Veuillez réessayer.',
        ]);
    }
}
