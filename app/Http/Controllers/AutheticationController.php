<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AutheticationController extends Controller
{
    /**
     * Mostra o formulário de login
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * Realiza login com os dados enviados
     *
     * @param Request $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function logar(Request $request)
    {
        $dados = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($dados, $request->filled('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended('home');
        }

        return back()->withErrors([
            'email' => 'O email e/ou senha não são invalidos'
        ]);
    }

    /**
     * Realiza logout do usuário
     *
     * @param Request $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
