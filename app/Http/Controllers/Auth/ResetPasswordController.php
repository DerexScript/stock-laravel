<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;


class ResetPasswordController extends Controller
{

    public function forgotPassword()
    {
        return view('auth.forgot-password', ['title' => 'Esqueci minha senha']);
    }

    public function sendPwResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ], [
            'email.required' => 'Você deve informar um endereço de e-mail.',
            'email.email' => 'Você deve informar um endereço de e-mail valido.'
        ]);
        /*
        \App\Jobs\SendResetLinkJob::dispatch(new \Illuminate\Support\Facades\Password(), $request->only('email'));
        return back()->with(['status' => 'Em alguns instante você recebera um e-mail, com instruções para redefinir sua senha.']);
        */

        $status = Password::sendResetLink(
            $request->only('email')
        );
        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);

    }

    public function showViewReset(Request $request, $token)
    {
        $email = $request->input('email');
        return view('auth.reset-password', ['title' => 'Redefinição de senha', 'email' => $email, 'token' => $token]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ], [
            'token.required' => 'Erro com o token.',
            'email.required' => 'Você precisa informar um email.',
            'email.email' => 'Você precisa informar um email valido.',
            'password.required' => 'Você precisa informar uma senha.',
            'password.min' => 'A senha deve ter no minimo 8 caracteres.',
            'password.confirmed' => 'O campo confirmação da senha não corresponde com o campo da senha.',
        ]);
        $credentials = $request->only('email', 'password', 'password_confirmation', 'token');
        $status = Password::reset($credentials, function ($user, $password) {
            $user->forceFill(['password' => Hash::make($password)])->setRememberToken(Str::random(60));
            $user->save();
            event(new PasswordReset($user));
        });
        return $status === Password::PASSWORD_RESET ? redirect()->route('login')->with('status',
            __($status)) : back()->withErrors(['email' => [__($status)]]);
    }


}
