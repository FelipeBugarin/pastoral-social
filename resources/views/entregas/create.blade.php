<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🎁 Nova Distribuição de Cesta Básica
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-3xl p-8 border-t-4 border-purple-600">
                
                <div class="bg-purple-50 p-4 rounded-2xl border border-purple-100 mb-6 text-center">
                    <p class="text-xs font-bold text-purple-500 uppercase tracking-wider">Cestas Prontas no Estoque</p>
                    <p class="text-3xl font-black text-purple-700 mt-1">{{ $cestasDisponiveis }}</p>
                </div>

                <form action="{{ route('entregas.store') }}" method="POST">
                    @csrf
                    
                    <div class="space-y-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Selecione o Assistido (Chefe de Família)</label>
                            <select name="assistido_id" class="w-full border-slate-200 rounded-xl focus:ring-purple-500 focus:border-purple-500" required>
                                <option value="">Escolha o beneficiário...</option>
                                @foreach($assistidos as $a)
                                    <option value="{{ $a->id }}">{{ $a->nome }} ({{ $a->dependentes }} dependentes)</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end gap-4">
                        <a href="{{ route('entregas.index') }}" class="px-6 py-3 text-slate-500 font-bold hover:text-slate-700 transition">Cancelar</a>
                        <button type="submit" {{ $cestasDisponiveis <= 0 ? 'disabled' : '' }} 
                                class="bg-purple-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-purple-700 transition shadow-lg disabled:opacity-50 disabled:cursor-not-allowed">
                            Confirmar Entrega e Dar Baixa
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
