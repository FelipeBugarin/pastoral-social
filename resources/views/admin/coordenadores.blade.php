<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🛡️ Gerenciamento de Coordenadores
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- SEÇÃO: FILA DE ESPERA -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-3xl p-6 border-l-4 border-orange-500">
                <h3 class="text-md font-bold text-slate-700 mb-4 uppercase tracking-wider">⏳ Coordenadores Aguardando Aprovação</h3>
                
                @if($pendentes->isEmpty())
                    <p class="text-slate-400 italic text-sm py-4">Nenhum cadastro pendente de aprovação no momento.</p>
                @else
                    <table class="w-full text-left">
                        <thead>
                            <tr class="border-b text-slate-400 text-xs uppercase">
                                <th class="py-3 px-2">Nome</th>
                                <th class="py-3 px-2">E-mail</th>
                                <th class="py-3 px-2">Paróquia Alocada</th>
                                <th class="py-3 px-2 text-center">Ação</th>
                            </tr>
                        </thead>
                        <tbody class="text-slate-700 text-sm">
                            @foreach($pendentes as $p)
                            <tr class="border-b hover:bg-slate-50">
                                <td class="py-4 px-2 font-bold">{{ $p->name }}</td>
                                <td class="py-4 px-2 text-slate-500">{{ $p->email }}</td>
                                <td class="py-4 px-2 font-semibold text-blue-700">{{ $p->paroquia->nome ?? 'Não Informada' }}</td>
                                <td class="py-4 px-2 text-center">
                                    <form action="{{ route('admin.coordenadores.aprovar', $p->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="bg-emerald-600 text-white px-4 py-2 rounded-xl text-xs font-bold hover:bg-emerald-700 transition shadow-md">
                                            ✅ Autorizar Acesso
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

            <!-- SEÇÃO: COORDENADORES ATIVOS -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-3xl p-6 border-l-4 border-blue-600">
                <h3 class="text-md font-bold text-slate-700 mb-4 uppercase tracking-wider">✔️ Equipe Ativa no Vicariato</h3>
                
                @if($aprovados->isEmpty())
                    <p class="text-slate-400 italic text-sm py-4">Nenhum outro coordenador ativo além de você.</p>
                @else
                    <table class="w-full text-left">
                        <thead>
                            <tr class="border-b text-slate-400 text-xs uppercase">
                                <th class="py-3 px-2">Nome</th>
                                <th class="py-3 px-2">E-mail</th>
                                <th class="py-3 px-2">Paróquia</th>
                                <th class="py-3 px-2">Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-slate-700 text-sm">
                            @foreach($aprovados as $a)
                            <tr class="border-b">
                                <td class="py-3 px-2 font-bold text-slate-600">{{ $a->name }}</td>
                                <td class="py-3 px-2 text-slate-400">{{ $a->email }}</td>
                                <td class="py-3 px-2 text-slate-500">{{ $a->paroquia->nome ?? '---' }}</td>
                                <td class="py-3 px-2">
                                    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-[10px] font-black uppercase">Ativo</span>
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
