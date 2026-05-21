<?php

namespace App\Http\Controllers;

use App\Models\Alimento;
use App\Models\Paroquia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlimentoController extends Controller
{
    // Listagem do estoque
    public function index()
    {
        // Pegamos o usuário logado atualmente
        $user = Auth::user();

        // Buscamos APENAS os alimentos que pertencem à mesma paróquia do usuário
        $estoque = Alimento::where('paroquia_id', $user->paroquia_id)
            ->latest()
            ->get();
            
        return view('alimentos.index', compact('estoque'));
    }

    // Tela de formulário
    public function create()
    {
        // O coordenador não precisa mais selecionar a paróquia em um <select>
        // O sistema já sabe de qual paróquia ele faz parte!
        return view('alimentos.create');
    }

    // Salvar no banco
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'quantidade' => 'required|numeric|min:0',
            'unidade' => 'required|string',
        ]);

        $user = Auth::user();

        // Forçamos o paroquia_id a ser exatamente o do coordenador logado
        $dados = $request->only(['nome', 'quantidade', 'unidade', 'validade']);
        $dados['paroquia_id'] = $user->paroquia_id;
        $dados['excedente'] = $request->has('excedente');

        Alimento::create($dados);

        return redirect()->route('alimentos.index')->with('sucesso', 'Item registrado no estoque local!');
    }

    public function excedentes()
    {
        $user = Auth::user();

        // Busca alimentos marcados como excedente, que tenham estoque disponível,
        // e que PERTENÇAM A OUTRAS paróquias (diferentes da paróquia do usuário logado)
        $excedentes = Alimento::with('paroquia')
            ->where('excedente', true)
            ->where('quantidade', '>', 0)
            ->where('paroquia_id', '!=', $user->paroquia_id) // Regra de exclusão local
            ->latest()
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
