<?php

namespace App\Http\Controllers;

use App\Models\CestaItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CestaController extends Controller
{
    // Tela com o formulário e a lista dos itens da cesta
    public function index()
    {
        $user = Auth::user();
        
        // 1. Pega os itens já configurados para a paróquia
        $itens = CestaItem::where('paroquia_id', $user->paroquia_id)->get();

        // 2. NOVO: Busca apenas os NOMES ÚNICOS dos alimentos do estoque local
        $alimentosEstoque = \App\Models\Alimento::where('paroquia_id', $user->paroquia_id)
            ->pluck('nome')
            ->unique();

        return view('cesta.index', compact('itens', 'alimentosEstoque'));
    }

    // Salva um novo item na receita da cesta
    public function store(Request $request)
    {
        $request->validate([
            'alimento_nome' => 'required|string|max:255',
            'quantidade_necessaria' => 'required|numeric|min:0.1',
            'unidade' => 'required|string',
        ]);

        $user = Auth::user();

        // Evita duplicar o mesmo alimento na receita da paróquia
        $existe = CestaItem::where('paroquia_id', $user->paroquia_id)
            ->where('alimento_nome', $request->alimento_nome)
            ->first();

        if ($existe) {
            return redirect()->back()->with('erro', 'Este alimento já está na receita da cesta.');
        }

        CestaItem::create([
            'paroquia_id' => $user->paroquia_id,
            'alimento_nome' => $request->alimento_nome,
            'quantidade_necessaria' => $request->quantidade_necessaria,
            'unidade' => $request->unidade,
        ]);

        return redirect()->route('cesta.index')->with('sucesso', 'Item adicionado à receita da cesta!');
    }

    // Remove um item da receita da cesta
    public function destroy($id)
    {
        $item = CestaItem::findOrFail($id);
        
        // Segurança: garante que o coordenador só delete itens da própria paróquia
        if ($item->paroquia_id === Auth::user()->paroquia_id) {
            $item->delete();
            return redirect()->route('cesta.index')->with('sucesso', 'Item removido da receita!');
        }

        return redirect()->route('cesta.index')->with('erro', 'Ação não autorizada.');
    }
}
