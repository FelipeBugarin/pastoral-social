<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Illuminate\Validation\Rules\Password; // Adicione esta linha junto com os outros 'use'

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        'password' => ['required', 'confirmed', Password::defaults()], // Simplificado aqui
        'paroquia_id' => ['required', 'exists:paroquias,id'], // Valida paróquia
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'paroquia_id' => $request->paroquia_id,
        'is_approved' => false, // Começa bloqueado
    ]);

    event(new \Illuminate\Auth\Events\Registered($user));

    return redirect()->route('login')->with('status', 'Cadastro realizado com sucesso! Aguarde a aprovação do administrador do Vicariato para acessar o painel.');
}
}
