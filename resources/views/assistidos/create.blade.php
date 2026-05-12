<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📝 Novo Cadastro de Assistido
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <form action="{{ route('assistidos.store') }}" method="POST">
                    @csrf
                    
                    <div class="space-y-6">
                        <!-- Nome -->
                        <div>
                            <label class="block text-sm font-bold text-slate-700 uppercase mb-2">Nome Completo do Responsável</label>
                            <input type="text" name="nome" class="w-full border-slate-200 rounded-xl focus:ring-blue-500 focus:border-blue-500" required>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- CPF -->
                            <div>
                                <label class="block text-sm font-bold text-slate-700 uppercase mb-2">CPF (Opcional)</label>
                                <input type="text" name="cpf" placeholder="000.000.000-00" class="w-full border-slate-200 rounded-xl">
                            </div>
                            
                            <!-- Dependentes -->
                            <div>
                                <label class="block text-sm font-bold text-slate-700 uppercase mb-2">Pessoas na Casa</label>
                                <input type="number" name="dependentes" min="0" value="1" class="w-full border-slate-200 rounded-xl" required>
                            </div>
                        </div>

                        <!-- Observações -->
                        <div>
                            <label class="block text-sm font-bold text-slate-700 uppercase mb-2">Observações Importantes</label>
                            <textarea name="observacoes" rows="3" class="w-full border-slate-200 rounded-xl" placeholder="Ex: Alergias, situação de moradia..."></textarea>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end gap-4">
                        <a href="{{ route('assistidos.index') }}" class="px-6 py-3 text-slate-500 font-bold hover:text-slate-700">Cancelar</a>
                        <button type="submit" class="bg-blue-700 text-white px-8 py-3 rounded-xl font-bold hover:bg-blue-800 transition shadow-lg">
                            Salvar Assistido
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
