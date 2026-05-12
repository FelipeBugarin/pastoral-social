<?php

namespace App\Http\Controllers;

use App\Models\Alimento;
use App\Models\Paroquia;
use Illuminate\Http\Request;

class AlimentoController extends Controller
{
    // Listagem do estoque
    public function index()
    {
        // Buscamos os alimentos e o relacionamento com a paróquia
        $estoque = Alimento::with('paroquia')->latest()->get();
        return view('alimentos.index', compact('estoque'));
    }

    // Tela de formulário
    public function create()
    {
        // Precisamos das paróquias para preencher o <select> do formulário
        $paroquias = Paroquia::all();
        return view('alimentos.create', compact('paroquias'));
    }

    // Salvar no banco
    public function store(Request $request)
    {
        $request->validate([
            'paroquia_id' => 'required|exists:paroquias,id',
            'nome' => 'required|string|max:255',
            'quantidade' => 'required|numeric|min:0',
            'unidade' => 'required|string',
        ]);

        // Tratamento para o checkbox do excedente
        $dados = $request->all();
        $dados['excedente'] = $request->has('excedente');

        Alimento::create($dados);

        return redirect()->route('alimentos.index')->with('sucesso', 'Item registrado no estoque!');
    }

    public function excedentes()
    {
        $excedentes = Alimento::with('paroquia')
            ->where('excedente', true)
            ->where('quantidade', '>', 0)
            ->get();

        return view('alimentos.excedentes', compact('excedentes'));
    }

    // Lógica inicial de requisição
    public function requisitar($id)
    {
        $alimento = Alimento::with('paroquia')->findOrFail($id);
        
        // Por enquanto, apenas retornamos uma mensagem. 
        // Futuramente podemos criar uma tabela 'solicitacoes'
        return redirect()->back()->with('sucesso', "Solicitação de {$alimento->nome} enviada para a {$alimento->paroquia->nome}!");
    }
}
