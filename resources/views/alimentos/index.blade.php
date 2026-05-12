<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                📦 Estoque de Alimentos
            </h2>
            <a href="{{ route('alimentos.create') }}" class="bg-blue-700 text-white px-4 py-2 rounded-lg font-bold hover:bg-blue-800 transition">
                + Entrada de Alimento
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if($estoque->isEmpty())
                    <p class="text-center text-gray-500 py-8 italic">O estoque está vazio no momento.</p>
                @else
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="text-slate-400 text-xs uppercase border-b">
                                <th class="py-3 px-2">Alimento</th>
                                <th class="py-3 px-2 text-center">Quantidade</th>
                                <th class="py-3 px-2">Paróquia</th>
                                <th class="py-3 px-2">Status</th>
                                <th class="py-3 px-2 text-center">Validade</th>
                            </tr>
                        </thead>
                        <tbody class="text-slate-700">
                            @foreach($estoque as $item)
                            <tr class="border-b hover:bg-slate-50">
                                <td class="py-4 px-2 font-bold">{{ $item->nome }}</td>
                                <td class="py-4 px-2 text-center">
                                    <span class="bg-slate-100 px-3 py-1 rounded-full font-black">
                                        {{ number_format($item->quantidade, 1) }} {{ $item->unidade }}
                                    </span>
                                </td>
                                <td class="py-4 px-2 text-sm text-slate-500">{{ $item->paroquia->nome }}</td>
                                <td class="py-4 px-2">
                                    @if($item->excedente)
                                        <span class="bg-orange-100 text-orange-700 px-2 py-1 rounded text-[10px] font-black uppercase">Excedente</span>
                                    @else
                                        <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-[10px] font-black uppercase">Uso Local</span>
                                    @endif
                                </td>
                                <td class="py-4 px-2 text-center text-sm {{ $item->validade && \Carbon\Carbon::parse($item->validade)->isPast() ? 'text-red-500 font-bold' : '' }}">
                                    {{ $item->validade ? \Carbon\Carbon::parse($item->validade)->format('d/m/Y') : '---' }}
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
