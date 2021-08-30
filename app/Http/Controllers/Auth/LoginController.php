<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\VerifyLoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    public function login()
    {
        //if (!Auth()->check()) {
        return view('auth.login', ['title' => 'Login']);
        //} else {
        //return redirect()->route('dashboard');
        //}
    }

    public function verifyLogin(VerifyLoginRequest $request)
    {
        $credentials = $request->only('credential', 'password');
        $remember = $request->has('remember') ?? false;

        $user = User::query()->where('email', $credentials["credential"])->orWhere('username',
            $credentials["credential"])->first();

        //if(Auth::attempt($credentials, $remember)){
        if ($user) {
            $pwIsCorrect = Hash::check($credentials["password"], $user->password);
            //dd(Hash::make("password1"));

            if ($pwIsCorrect) {
                Auth::login($user, $remember);
                $request->session()->regenerate();
                //intended tenta redirecionar o usuario para rota que estava tentando acessar antes de ser interceptado pelo middleware
                //uma uri pode ser passada como parametro em caso de falha..
                return redirect()->intended('dashboard');
            }
        }

        return back()->withErrors([
            'loginFailed' => 'As credenciais fornecidas não correspondem aos nossos registros.',
        ]);
    }

    public function logout(Request $request)
    {
        if (Auth()->check()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            //return redirect('/');
            return redirect()->route('home');
        } else {
            //return redirect('/');
            return redirect()->route('home');
        }
    }
}
