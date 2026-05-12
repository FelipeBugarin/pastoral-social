<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pastoral Social - Vicariato Anchieta</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 font-sans antialiased text-slate-900">

    <!-- Navbar -->
    <nav class="bg-white border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex flex-col">
                    <span class="text-2xl font-black text-blue-800 leading-none">VICARIATO ANCHIETA</span>
                    <span class="text-sm font-bold text-slate-500 tracking-widest uppercase">Pastoral Social</span>
                </div>
                
                <div class="flex gap-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="font-bold text-slate-600 hover:text-blue-800 transition">Painel Administrativo</a>
                        @else
                            <a href="{{ route('login') }}" class="bg-blue-700 text-white px-8 py-3 rounded-xl font-bold hover:bg-blue-800 transition shadow-lg shadow-blue-200">
                                Login Coordenador
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-blue-700 text-white px-8 py-3 rounded-xl font-bold hover:bg-blue-800 transition shadow-lg shadow-blue-200">
                                    Cadastrar Coordenador
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="py-16 px-4 bg-white border-b border-slate-100">
        <div class="max-w-7xl mx-auto text-center">
            <h1 class="text-5xl font-extrabold text-slate-900 mb-6">Bem-vindo à Gestão Solidária</h1>
            <p class="text-xl text-slate-600 max-w-3xl mx-auto leading-relaxed">
                Centralizamos a arrecadação e distribuição de alimentos para apoiar as famílias atendidas pelas paróquias do nosso vicariato.
            </p>
        </div>
    </header>

    <!-- Grid de Informações -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 grid grid-cols-1 md:grid-cols-2 gap-8">
        
        <!-- Espaço de Eventos -->
        <section class="bg-white p-8 rounded-3xl shadow-sm border border-slate-200">
            <div class="flex items-center gap-3 mb-6">
                <span class="text-2xl">📅</span>
                <h2 class="text-xl font-black text-slate-800 uppercase tracking-tight">Próximos Eventos</h2>
            </div>
            <div class="space-y-6">
                <div class="flex gap-4 p-4 rounded-2xl bg-blue-50 border border-blue-100">
                    <div class="bg-blue-600 text-white p-3 rounded-xl font-bold flex flex-col items-center justify-center min-w-[60px]">
                        <span class="text-lg leading-none">12</span>
                        <span class="text-xs uppercase">Jun</span>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-800">Coleta de Alimentos - Paróquia Matriz</h4>
                        <p class="text-sm text-slate-500">Ação conjunta para arrecadação de cestas básicas.</p>
                    </div>
                </div>
                <p class="text-slate-400 italic text-sm text-center">Em breve mais eventos...</p>
            </div>
        </section>

        <!-- Espaço de Parceiros -->
        <section class="bg-white p-8 rounded-3xl shadow-sm border border-slate-200">
            <div class="flex items-center gap-3 mb-6">
                <span class="text-2xl">🤝</span>
                <h2 class="text-xl font-black text-slate-800 uppercase tracking-tight">Parceiros Sociais</h2>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="p-6 border border-slate-100 rounded-2xl bg-slate-50 flex items-center justify-center grayscale opacity-60 hover:grayscale-0 hover:opacity-100 transition duration-300">
                    <span class="font-black text-slate-400">BANCO DE ALIMENTOS</span>
                </div>
                <div class="p-6 border border-slate-100 rounded-2xl bg-slate-50 flex items-center justify-center grayscale opacity-60 hover:grayscale-0 hover:opacity-100 transition duration-300">
                    <span class="font-black text-slate-400">MESA BRASIL</span>
                </div>
                <div class="p-6 border border-slate-100 rounded-2xl bg-slate-50 flex items-center justify-center grayscale opacity-60 hover:grayscale-0 hover:opacity-100 transition duration-300">
                    <span class="font-black text-slate-400">PARÓQUIA SÃO JOSÉ</span>
                </div>
                <div class="p-6 border border-slate-100 rounded-2xl bg-slate-50 flex items-center justify-center grayscale opacity-60 hover:grayscale-0 hover:opacity-100 transition duration-300">
                    <span class="font-black text-slate-400">MERCADO SOLIDÁRIO</span>
                </div>
            </div>
        </section>

    </main>

    <footer class="text-center py-12 text-slate-400 text-sm">
        &copy; {{ date('Y') }} Vicariato Anchieta - Pastoral Social. Desenvolvido para a comunidade.
    </footer>
</body>
</html>
