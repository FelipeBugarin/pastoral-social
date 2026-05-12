<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Painel de Controle - Pastoral Social') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                
                <h3 class="text-lg font-bold text-slate-700 mb-6 uppercase tracking-wider">🛠️ Gestão de Recursos</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Botão 1: Assistidos -->
                    <a href="{{ route('assistidos.index') }}" class="flex flex-col items-center p-6 bg-emerald-50 border-2 border-emerald-100 rounded-3xl hover:bg-emerald-100 transition group">
                        <span class="text-4xl mb-2 group-hover:scale-110 transition">👥</span>
                        <span class="font-black text-emerald-800 uppercase text-center">Cadastrar Assistidos</span>
                        <span class="text-xs text-emerald-600 text-center mt-2">Famílias e pessoas atendidas</span>
                    </a>

                    <!-- Botão 2: Alimentos Excedentes -->
                    <a href="{{ route('alimentos.excedentes') }}" class="flex flex-col items-center p-6 bg-orange-50 border-2 border-orange-100 rounded-3xl hover:bg-orange-100 transition group">
                        <span class="text-4xl mb-2 group-hover:scale-110 transition">🍎</span>
                        <span class="font-black text-orange-800 uppercase text-center">Alimentos Excedentes</span>
                        <span class="text-xs text-orange-600 text-center mt-2">Disponibilizar para outras paróquias</span>
                    </a>

                    <!-- Botão 3: Estoque Paroquial -->
                    <a href="{{ route('alimentos.index') }}" class="flex flex-col items-center p-6 bg-blue-50 border-2 border-blue-100 rounded-3xl hover:bg-blue-100 transition group">
                        <span class="text-4xl mb-2 group-hover:scale-110 transition">📦</span>
                        <span class="font-black text-blue-800 uppercase text-center">Estoque da Paróquia</span>
                        <span class="text-xs text-blue-600 text-center mt-2">Entrada de novos alimentos</span>
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
