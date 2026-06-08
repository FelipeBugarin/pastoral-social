<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssistidoController;
use App\Http\Controllers\AlimentoController;
use App\Http\Controllers\Admin\CoordenadorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CestaController;
use App\Http\Controllers\EntregaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/assistidos', [AssistidoController::class, 'index'])->name('assistidos.index');
    Route::get('/assistidos/novo', [AssistidoController::class, 'create'])->name('assistidos.create');
    Route::post('/assistidos/salvar', [AssistidoController::class, 'store'])->name('assistidos.store');
    Route::get('/estoque', [AlimentoController::class, 'index'])->name('alimentos.index');
    Route::get('/estoque/novo', [AlimentoController::class, 'create'])->name('alimentos.create');
    Route::post('/estoque/salvar', [AlimentoController::class, 'store'])->name('alimentos.store');
    // Tela de excedentes (Listagem)
    Route::get('/excedentes', [AlimentoController::class, 'excedentes'])->name('alimentos.excedentes');
    //Tela de configuração da cesta (Listagem + Formulário)
    Route::get('/configurar-cesta', [CestaController::class, 'index'])->name('cesta.index');
    Route::post('/configurar-cesta', [CestaController::class, 'store'])->name('cesta.store');
    Route::delete('/configurar-cesta/{id}', [CestaController::class, 'destroy'])->name('cesta.destroy');
    // Tela de distribuição (Listagem dos assistidos e opção de distribuir a cesta)
    Route::get('/entregas', [EntregaController::class, 'index'])->name('entregas.index');
    Route::get('/entregas/nova', [EntregaController::class, 'create'])->name('entregas.create');
    Route::post('/entregas/salvar', [EntregaController::class, 'store'])->name('entregas.store');


    // Ação de requisitar (Por enquanto vamos simular um alerta ou enviar um e-mail)
    Route::post('/excedentes/{id}/requisitar', [AlimentoController::class, 'requisitar'])->name('alimentos.requisitar');

    Route::middleware('admin')->group(function () {
        Route::get('/gerenciar-coordenadores', [CoordenadorController::class, 'index'])->name('admin.coordenadores.index');
        Route::patch('/gerenciar-coordenadores/{id}/aprovar', [CoordenadorController::class, 'aprovar'])->name('admin.coordenadores.aprovar');
    });

});

require __DIR__.'/auth.php';
