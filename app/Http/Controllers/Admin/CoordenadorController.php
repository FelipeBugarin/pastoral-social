<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CoordenadorController extends Controller
{
    // Lista os usuários que aguardam aprovação e os já ativos
    public function index()
    {
        // O with('paroquia') carrega o nome da igreja do coordenador automaticamente
        $pendentes = User::with('paroquia')->where('is_approved', false)->get();
        $aprovados = User::with('paroquia')->where('is_approved', true)->where('id', '!=', 1)->get();

        return view('admin.coordenadores', compact('pendentes', 'aprovados'));
    }

    // Altera o status para aprovado
    public function aprovar($id)
    {
        $user = User::findOrFail($id);
        $user->is_approved = true;
        $user->save();

        return redirect()->back()->with('sucesso', "O coordenador {$user->name} foi aprovado com sucesso!");
    }
}
