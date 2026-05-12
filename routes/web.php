<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssistidoController;
use App\Http\Controllers\AlimentoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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

    // Ação de requisitar (Por enquanto vamos simular um alerta ou enviar um e-mail)
    Route::post('/excedentes/{id}/requisitar', [AlimentoController::class, 'requisitar'])->name('alimentos.requisitar');
});

require __DIR__.'/auth.php';
