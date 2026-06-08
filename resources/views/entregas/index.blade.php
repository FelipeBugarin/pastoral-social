<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                📋 Registro de Entregas Realizadas
            </h2>
            <a href="{{ route('entregas.create') }}" class="bg-purple-600 text-white px-4 py-2 rounded-lg font-bold hover:bg-purple-700 transition shadow-md">
                🎁 Registrar Entrega
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-3xl p-6">
                @if($entregas->isEmpty())
                    <p class="text-center text-gray-500 py-8 italic">Nenhuma entrega registrada nesta paróquia.</p>
                @else
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="text-slate-400 text-xs uppercase border-b">
                                <th class="py-3 px-2">Data</th>
                                <th class="py-3 px-2">Responsável Familiar</th>
                                <th class="py-3 px-2">Alimento Retirado</th>
                                <th class="py-3 px-2 text-center">Qtd. Baixada</th>
                            </tr>
                        </thead>
                        <tbody class="text-slate-700 text-sm">
                            @foreach($entregas as $e)
                            <tr class="border-b hover:bg-slate-50">
                                <td class="py-4 px-2 text-slate-500">{{ \Carbon\Carbon::parse($e->data_entrega)->format('d/m/Y') }}</td>
                                <td class="py-4 px-2 font-bold text-slate-800">{{ $e->assistido->nome }}</td>
                                <td class="py-4 px-2">{{ $e->alimento->nome }}</td>
                                <td class="py-4 px-2 text-center font-black text-red-600">- {{ number_format($e->quantidade_entregue, 1) }} {{ $e->alimento->unidade }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
