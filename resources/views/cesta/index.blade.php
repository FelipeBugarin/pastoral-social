<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📝 Configurar Composição da Cesta Básica
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <!-- FORMULÁRIO DE ADIÇÃO (Esquerda) -->
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-200 h-fit">
                <h3 class="text-sm font-bold text-slate-700 uppercase mb-6 border-b pb-2">➕ Adicionar Alimento</h3>
                
                <form action="{{ route('cesta.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Nome do Alimento</label>
                        <select name="alimento_nome" class="w-full border-slate-200 rounded-xl focus:ring-purple-500 focus:border-purple-500" required>
                            <option value="">Selecione um item do estoque...</option>
                            @forelse($alimentosEstoque as $nomeAlimento)
                                <option value="{{ $nomeAlimento }}">{{ $nomeAlimento }}</option>
                            @empty
                                <option value="" disabled>Nenhum alimento cadastrado no estoque local</option>
                            @endforelse
                        </select>
                        
                        @if($alimentosEstoque->isEmpty())
                            <p class="text-[10px] text-red-500 font-bold mt-1">
                                ⚠️ Cadastre alimentos no estoque antes de montar a cesta.
                            </p>
                        @endif
                    </div>


                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Qtd. Necessária</label>
                            <input type="number" step="0.1" name="quantidade_necessaria" class="w-full border-slate-200 rounded-xl" required>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Unidade</label>
                            <select name="unidade" class="w-full border-slate-200 rounded-xl" required>
                                <option value="kg">kg</option>
                                <option value="un">Unidades</option>
                                <option value="pacote">Pacotes</option>
                                <option value="litro">Litros</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-purple-600 text-white py-3 rounded-xl font-bold hover:bg-purple-700 transition shadow-lg shadow-purple-100 mt-2">
                        Inserir na Receita
                    </button>
                </form>
            </div>

            <!-- TABELA DE COMPOSIÇÃO (Direita) -->
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-200 md:col-span-2">
                <h3 class="text-sm font-bold text-slate-700 uppercase mb-6 border-b pb-2">📋 Receita da Cesta Atual</h3>
                
                @if($itens->isEmpty())
                    <p class="text-slate-400 italic text-sm py-8 text-center">Nenhum item definido para a cesta básica ainda.</p>
                @else
                    <table class="w-full text-left">
                        <thead>
                            <tr class="border-b text-slate-400 text-xs uppercase">
                                <th class="py-3 px-2">Alimento</th>
                                <th class="py-3 px-2 text-center">Qtd. Exigida por Cesta</th>
                                <th class="py-3 px-2 text-center">Ação</th>
                            </tr>
                        </thead>
                        <tbody class="text-slate-700 text-sm">
                            @foreach($itens as $item)
                            <tr class="border-b hover:bg-slate-50">
                                <td class="py-4 px-2 font-bold">{{ $item->alimento_nome }}</td>
                                <td class="py-4 px-2 text-center font-black">
                                    <span class="bg-purple-50 text-purple-700 px-3 py-1 rounded-full text-xs">
                                        {{ number_format($item->quantidade_necessaria, 1) }} {{ $item->unidade }}
                                    </span>
                                </td>
                                <td class="py-4 px-2 text-center">
                                    <form action="{{ route('cesta.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 font-bold hover:text-red-700 text-xs uppercase">
                                            ❌ Remover
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
