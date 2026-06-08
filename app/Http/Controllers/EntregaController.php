<?php

namespace App\Http\Controllers;

use App\Models\Entrega;
use App\Models\Assistido;
use App\Models\CestaItem;
use App\Models\Alimento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EntregaController extends Controller
{
    // Histórico de entregas da paróquia
    public function index()
    {
        $user = Auth::user();
        
        // Pega as entregas feitas pelos assistidos da paróquia
        $entregas = Entrega::with(['assistido', 'alimento'])
            ->whereHas('assistido', function($query) {
                // Filtro para relatórios futuros se necessário
            })
            ->latest()
            ->get();

        return view('entregas.index', compact('entregas'));
    }

    // Formulário de Nova Entrega
    public function create()
    {
        $user = Auth::user();

        // 1. REGRA DO MÊS ATUAL: Descobre quais assistidos JÁ RECEBERAM cesta este mês
        // O whereMonth e whereYear pegam a data atual do servidor
        $jaReceberamEsteMes = Entrega::whereMonth('data_entrega', now()->month)
            ->whereYear('data_entrega', now()->year)
            ->pluck('assistido_id')
            ->unique();

        // 2. Busca apenas os assistidos que NÃO estão na lista dos que já receberam
        $assistidos = Assistido::whereNotIn('id', $jaReceberamEsteMes)
            ->latest()
            ->get();
        
        // 3. Descobre quantas cestas estão disponíveis para entrega (Sua lógica de estoque)
        $itensCesta = CestaItem::where('paroquia_id', $user->paroquia_id)->get();
        $estoqueLocal = Alimento::where('paroquia_id', $user->paroquia_id)->get();
        $cestasDisponiveis = 0;

        if ($itensCesta->isNotEmpty()) {
            $limites = [];
            foreach ($itensCesta as $item) {
                $noEstoque = $estoqueLocal->where('nome', $item->alimento_nome)->first();
                if ($noEstoque && $noEstoque->quantidade >= $item->quantidade_necessaria) {
                    $limites[] = floor($noEstoque->quantidade / $item->quantidade_necessaria);
                } else {
                    $limites[] = 0;
                }
            }
            $cestasDisponiveis = min($limites);
        }

        return view('entregas.create', compact('assistidos', 'cestasDisponiveis'));
    }

    // Processa a entrega com trava de segurança dupla
    public function store(Request $request)
    {
        $request->validate([
            'assistido_id' => 'required|exists:assistidos,id',
        ]);

        $user = Auth::user();

        // TRAVA DE SEGURANÇA NO SERVIDOR:
        // Verifica se o assistido recebeu alguma cesta no mês atual
        $jaTemEntrega = Entrega::where('assistido_id', $request->assistido_id)
            ->whereMonth('data_entrega', now()->month)
            ->whereYear('data_entrega', now()->year)
            ->exists();

        if ($jaTemEntrega) {
            return redirect()->back()->with('erro', 'Este assistido já recebeu a cesta básica do mês atual.');
        }

        $itensCesta = CestaItem::where('paroquia_id', $user->paroquia_id)->get();

        if ($itensCesta->isEmpty()) {
            return redirect()->back()->with('erro', 'Configure a receita da cesta antes de realizar entregas.');
        }

        // Transação do banco para dar baixa (Sua lógica que já funciona)
        DB::transaction(function () use ($user, $itensCesta, $request) {
            foreach ($itensCesta as $itemCesta) {
                $alimentoEstoque = Alimento::where('paroquia_id', $user->paroquia_id)
                    ->where('nome', $itemCesta->alimento_nome)
                    ->first();

                if (!$alimentoEstoque || $alimentoEstoque->quantidade < $itemCesta->quantidade_necessaria) {
                    throw new \Exception("Estoque insuficiente para o item: {$itemCesta->alimento_nome}");
                }

                Entrega::create([
                    'assistido_id' => $request->assistido_id,
                    'alimento_id' => $alimentoEstoque->id,
                    'quantidade_entregue' => $itemCesta->quantidade_necessaria,
                    'data_entrega' => now()->today(),
                ]);

                $alimentoEstoque->quantidade -= $itemCesta->quantidade_necessaria;
                $alimentoEstoque->save();
            }
        });

        return redirect()->route('entregas.index')->with('sucesso', 'Cesta entregue e estoque atualizado com sucesso!');
    }
}
