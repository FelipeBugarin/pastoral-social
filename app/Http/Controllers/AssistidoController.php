<?php

namespace App\Http\Controllers;

use App\Models\Assistido;
use Illuminate\Http\Request;

class AssistidoController extends Controller
{
    public function index()
    {
        $assistidos = Assistido::latest()->get();
        return view('assistidos.index', compact('assistidos'));
    }

    public function create()
    {
        return view('assistidos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'nullable|unique:assistidos,cpf',
            'dependentes' => 'required|integer|min:0',
        ]);

        Assistido::create($request->all());

        return redirect()->route('assistidos.index')->with('sucesso', 'Assistido cadastrado com sucesso!');
    }
}
