<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🍎 Registrar Entrada de Alimento
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <form action="{{ route('alimentos.store') }}" method="POST">
                    @csrf
                    
                    <div class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Paróquia -->
                            <div>
                                <label class="block text-sm font-bold text-slate-700 uppercase mb-2">Paróquia Destino</label>
                                <select name="paroquia_id" class="w-full border-slate-200 rounded-xl" required>
                                    <option value="">Selecione a Igreja...</option>
                                    @foreach($paroquias as $p)
                                        <option value="{{ $p->id }}">{{ $p->nome }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Nome do Alimento -->
                            <div>
                                <label class="block text-sm font-bold text-slate-700 uppercase mb-2">Alimento</label>
                                <input type="text" name="nome" placeholder="Ex: Arroz, Feijão..." class="w-full border-slate-200 rounded-xl" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <!-- Quantidade -->
                            <div>
                                <label class="block text-sm font-bold text-slate-700 uppercase mb-2">Quantidade</label>
                                <input type="number" step="0.1" name="quantidade" class="w-full border-slate-200 rounded-xl" required>
                            </div>

                            <!-- Unidade -->
                            <div>
                                <label class="block text-sm font-bold text-slate-700 uppercase mb-2">Unidade</label>
                                <select name="unidade" class="w-full border-slate-200 rounded-xl" required>
                                    <option value="kg">Quilos (kg)</option>
                                    <option value="un">Unidades</option>
                                    <option value="litro">Litros</option>
                                    <option value="pacote">Pacotes</option>
                                </select>
                            </div>

                            <!-- Validade -->
                            <div>
                                <label class="block text-sm font-bold text-slate-700 uppercase mb-2">Validade</label>
                                <input type="date" name="validade" class="w-full border-slate-200 rounded-xl">
                            </div>
                        </div>

                        <!-- Opção Excedente -->
                        <div class="bg-orange-50 p-4 rounded-2xl border border-orange-100 flex items-center gap-3">
                            <input type="checkbox" name="excedente" value="1" class="rounded text-orange-600 focus:ring-orange-500 h-5 w-5">
                            <div>
                                <p class="text-sm font-bold text-orange-800">Disponibilizar como excedente?</p>
                                <p class="text-xs text-orange-600">Marque se este alimento puder ser doado para outras paróquias do Vicariato.</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end gap-4">
                        <a href="{{ route('alimentos.index') }}" class="px-6 py-3 text-slate-500 font-bold hover:text-slate-700 transition">Cancelar</a>
                        <button type="submit" class="bg-blue-700 text-white px-8 py-3 rounded-xl font-bold hover:bg-blue-800 transition shadow-lg">
                            Registrar no Estoque
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
