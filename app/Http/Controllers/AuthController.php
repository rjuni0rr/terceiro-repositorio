<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }


    public function loginSubmit(Request $request)
    {

        $credentials = $request->validate(
            [
                'email' => 'required', 'email',
                'password' => 'required', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{6,16}$/'
            ],
            // error messages
            [
                'email.required' => 'O usuário é obrigatório.',
                'email.email' => 'O usuário deve ser um e-mail válido.',

                'password.required' => 'A senha é obrigatória.',
                'password.regex' => 'A senha deve conter entre 6 e 16 caracteres, ter uma maiúscula, uma minúscula e um algarismo.'
            ]
        );

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();
            return redirect()->intended('/');

        }

        return back()->withErrors([
            'email' => 'Credenciais inválidas.'
        ])->onlyInput('email');

    }


    public function register()
    {
        return view('auth.register');
    }


    public function registerSubmit(Request $request)
    {

        $validated = $request->validate(
            [
                'name' => ['required', 'max:255'],
                'email' => ['required', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{6,16}$/', 'confirmed']
            ],
            [
                'name.required' => 'O nome de usuário é obrigatório',
                'name.max' => 'O nome de usuário deve ter no máximo 255 caracteres.',

                'email.required' => 'O email é obrigatório.',
                'email.email' => 'O e-mail inserido não é válido.',
                'email.max' => 'O e-mail deve ter no máximo 255 caracteres.',

                'password.required' => 'A senha é obrigatória.',
                'password.regex' => 'A senha deve conter entre 6 e 16 caracteres, ter uma maiúscula, uma minúscula e um algarismo.',
                'password.confirmed' => 'A nova senha e a repetição não estão iguais.',
            ]
        );

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'])
        ]);

        Auth::login($user);

        return redirect('/')->with('success','Conta criada com sucesso!');

    }


    public function logout(Request $request)
    {

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login')->with('success','Logout realizado com sucesso');

    }
}
