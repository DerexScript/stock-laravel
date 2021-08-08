<?php

namespace App\Http\Controllers;

use App\Http\Requests\VerifyLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function login()
    {
        return view('auth.login', ['title' => 'Login']);
    }

    public function verifyLogin(VerifyLoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember') ?? false;
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }
        return back()->withErrors([
            'loginFailed' => 'As credenciais fornecidas não correspondem aos nossos registros.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
