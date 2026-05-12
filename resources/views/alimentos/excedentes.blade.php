<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📢 Alimentos Disponíveis para Redistribuição
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-t-4 border-orange-500">
                <p class="text-sm text-slate-500 mb-6 italic">
                    Estes itens foram marcados como excedentes por outras paróquias e estão disponíveis para retirada.
                </p>

                @if($excedentes->isEmpty())
                    <div class="text-center py-12">
                        <span class="text-5xl">🍃</span>
                        <p class="text-gray-500 mt-4">Não há alimentos excedentes disponíveis no momento.</p>
                    </div>
                @else
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="text-slate-400 text-xs uppercase border-b">
                                <th class="py-3 px-2">Alimento</th>
                                <th class="py-3 px-2 text-center">Quantidade</th>
                                <th class="py-3 px-2">Localidade (Paróquia)</th>
                                <th class="py-3 px-2 text-center">Ação</th>
                            </tr>
                        </thead>
                        <tbody class="text-slate-700">
                            @foreach($excedentes as $item)
                            <tr class="border-b hover:bg-orange-50 transition">
                                <td class="py-4 px-2 font-black text-slate-800">{{ $item->nome }}</td>
                                <td class="py-4 px-2 text-center font-bold">
                                    {{ number_format($item->quantidade, 1) }} {{ $item->unidade }}
                                </td>
                                <td class="py-4 px-2 text-sm">
                                    <div class="flex flex-col">
                                        <span class="font-bold text-blue-700">{{ $item->paroquia->nome }}</span>
                                        <span class="text-[10px] text-slate-400 uppercase">{{ $item->paroquia->endereco }}</span>
                                    </div>
                                </td>
                                <td class="py-4 px-2 text-center">
                                    <form action="{{ route('alimentos.requisitar', $item->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-orange-600 text-white px-4 py-2 rounded-xl text-xs font-bold hover:bg-orange-700 transition shadow-md">
                                            Requisitar Item
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
