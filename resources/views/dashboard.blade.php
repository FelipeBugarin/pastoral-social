<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Painel de Controle - Pastoral Social') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- SEÇÃO DE HIGHLIGHTS (CARDS) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <!-- Card 1: Cestas Disponíveis -->
                <a href="{{ route('entregas.index') }}" class="bg-white overflow-hidden shadow-sm sm:rounded-3xl border-l-4 border-purple-600 p-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-purple-100 rounded-full text-purple-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-slate-500 uppercase font-black tracking-wider">Cestas Disponíveis</p>
                            <p class="text-3xl font-black text-slate-800">{{ $possivelMontar }}</p>
                            <p class="text-xs text-slate-400 mt-1">Montáveis com o estoque atual</p>
                        </div>
                    </div>
                </a>

                <!-- Card 2: Assistidos -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-3xl border-l-4 border-emerald-500 p-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-emerald-100 rounded-full text-emerald-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-slate-500 uppercase font-black tracking-wider">Famílias Atendidas</p>
                            <p class="text-3xl font-black text-slate-800">{{ $totalAssistidos }}</p>
                            <p class="text-xs text-slate-400 mt-1">Cadastradas no Vicariato</p>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Excedentes Disponíveis -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-3xl border-l-4 border-orange-500 p-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-orange-100 rounded-full text-orange-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5a2 2 0 10-2 2h2zm0 0h4m-4 0H8m12 3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-slate-500 uppercase font-black tracking-wider">Doações de Fora</p>
                            <p class="text-3xl font-black text-slate-800">{{ $totalExcedentes }}</p>
                            <p class="text-xs text-slate-400 mt-1">Itens excedentes em outras igrejas</p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- SEÇÃO DE ACESSO RÁPIDO (BOTÕES) -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-3xl p-8">
                <h3 class="text-md font-bold text-slate-700 mb-6 uppercase tracking-wider border-b pb-2">🛠️ Painel Operacional</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Botão 1: Assistidos -->
                    <a href="{{ route('assistidos.index') }}" class="flex flex-col items-center p-4 bg-emerald-50 border-2 border-emerald-100 rounded-2xl hover:bg-emerald-100 transition group">
                        <span class="text-3xl mb-1 group-hover:scale-110 transition">👥</span>
                        <span class="font-bold text-emerald-800 text-sm">Assistidos</span>
                    </a>

                    <!-- Botão 2: Estoque Paroquial -->
                    <a href="{{ route('alimentos.index') }}" class="flex flex-col items-center p-4 bg-blue-50 border-2 border-blue-100 rounded-2xl hover:bg-blue-100 transition group">
                        <span class="text-3xl mb-1 group-hover:scale-110 transition">📦</span>
                        <span class="font-bold text-blue-800 text-sm">Estoque da Igreja</span>
                    </a>

                    <!-- Botão 3: Alimentos Excedentes -->
                    <a href="{{ route('alimentos.excedentes') }}" class="flex flex-col items-center p-4 bg-orange-50 border-2 border-orange-100 rounded-2xl hover:bg-orange-100 transition group">
                        <span class="text-3xl mb-1 group-hover:scale-110 transition">📢</span>
                        <span class="font-bold text-orange-800 text-sm">Bolsa de Excedentes</span>
                    </a>

                    <!-- NOVO Botão 4: Configurar Cesta Padrão -->
                    <a href="{{ route('cesta.index') }}" class="flex flex-col items-center p-4 bg-purple-50 border-2 border-purple-100 rounded-2xl hover:bg-purple-100 transition group">
                        <span class="text-3xl mb-1 group-hover:scale-110 transition">📝</span>
                        <span class="font-bold text-purple-800 text-sm">Configurar Cesta</span>
                    </a>
                </div>
            </div>

            <!-- SEÇÃO INFORMATIVA DA RECEITA ATUAL -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-3xl p-6">
                <h3 class="text-sm font-bold text-slate-500 uppercase mb-4 tracking-wider">📋 Composição da Cesta Básica Local</h3>
                @if($itensCesta->isEmpty())
                    <p class="text-slate-400 italic text-sm">Nenhuma receita de cesta configurada para esta paróquia. Clique em "Configurar Cesta" acima para definir os itens obrigatórios.</p>
                @else
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach($itensCesta as $item)
                            <div class="bg-slate-50 p-3 rounded-xl border text-center">
                                <p class="text-xs text-slate-400 uppercase font-bold">{{ $item->alimento_nome }}</p>
                                <p class="text-lg font-black text-slate-700 mt-1">{{ number_format($item->quantidade_necessaria, 1) }} {{ $item->unidade }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
