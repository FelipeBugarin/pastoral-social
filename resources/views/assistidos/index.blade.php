<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                👥 Famílias Assistidas
            </h2>
            <a href="{{ route('assistidos.create') }}" class="bg-blue-700 text-white px-4 py-2 rounded-lg font-bold hover:bg-blue-800 transition">
                + Novo Cadastro
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if($assistidos->isEmpty())
                    <p class="text-center text-gray-500 py-8 italic">Nenhuma família cadastrada ainda.</p>
                @else
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="text-slate-400 text-xs uppercase border-b">
                                <th class="py-3 px-2">Nome do Responsável</th>
                                <th class="py-3 px-2">CPF</th>
                                <th class="py-3 px-2 text-center">Dependentes</th>
                                <th class="py-3 px-2 text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="text-slate-700">
                            @foreach($assistidos as $a)
                            <tr class="border-b hover:bg-slate-50">
                                <td class="py-4 px-2 font-bold">{{ $a->nome }}</td>
                                <td class="py-4 px-2">{{ $a->cpf ?? '---' }}</td>
                                <td class="py-4 px-2 text-center">{{ $a->dependentes }} pessoas</td>
                                <td class="py-4 px-2 text-center text-gray-300">Em breve</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
