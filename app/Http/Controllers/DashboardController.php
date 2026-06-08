<?php

namespace App\Http\Controllers;

use App\Models\Alimento;
use App\Models\CestaItem;
use App\Models\Assistido;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 1. Contagens básicas para os cards locais
        $totalAssistidos = Assistido::count(); // Ajustaremos para isolar por paróquia depois, se necessário
        $totalExcedentes = Alimento::where('excedente', true)->where('paroquia_id', '!=', $user->paroquia_id)->count();

        // 2. LÓGICA DAS CESTAS
        // Busca a "receita" da cesta desta paróquia
        $itensCesta = CestaItem::where('paroquia_id', $user->paroquia_id)->get();
        
        // Busca o estoque atual desta paróquia
        $estoqueLocal = Alimento::where('paroquia_id', $user->paroquia_id)->get();

        $possivelMontar = 0;

        if ($itensCesta->isNotEmpty()) {
            $limites = [];

            foreach ($itensCesta as $itemNecessario) {
                // Procura se tem esse alimento no estoque local (com o mesmo nome)
                $noEstoque = $estoqueLocal->where('nome', $itemNecessario->alimento_nome)->first();

                if ($noEstoque && $noEstoque->quantidade >= $itemNecessario->quantidade_necessaria) {
                    // Calcula quantas vezes esse ingrediente específico consegue atender a receita
                    $qtdCestasDesseItem = floor($noEstoque->quantidade / $itemNecessario->quantidade_necessaria);
                    $limites[] = $qtdCestasDesseItem;
                } else {
                    // Se faltar um único ingrediente da receita ou não tiver estoque suficiente, o limite cai para 0
                    $limites[] = 0;
                }
            }

            // O menor número da lista será o limite real de cestas completas que conseguimos fechar
            $possivelMontar = min($limites);
        }

        return view('dashboard', compact('totalAssistidos', 'totalExcedentes', 'possivelMontar', 'itensCesta'));
    }
}
