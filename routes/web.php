<?php

use App\Http\Controllers\CargosController;
use App\Http\Controllers\DepartamentosController;
use App\Http\Controllers\EscalasController;
use App\Http\Controllers\FuncionariosController;    
use App\Http\Controllers\PdfController;
use App\Http\Controllers\RelatoriosController;
use App\Http\Controllers\TurnosController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/menu', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/pdf', [PdfController::class, 'index'])->name('pdf');
    Route::get('/relatorios', [RelatoriosController::class, 'index'])->name('relatorios');

    //FUNCIONARIOS
        Route::get('/funcionarios', [FuncionariosController::class, 'index'])->name('funcionarios');
        Route::get('/getData-funcionarios', [FuncionariosController::class, 'getData'])->name('getdata-funcionarios');
        // Rota para exibir a view de criação de funcionários
        Route::get('/funcionarios/create', [FuncionariosController::class, 'create'])->name('funcionarios.create');
        // Rota para editar um funcionário existente
        Route::get('/funcionarios/{id}/edit', [FuncionariosController::class, 'edit'])->name('funcionarios.edit');
        // Rota para armazenar novos funcionários
        Route::post('/funcionarios', [FuncionariosController::class, 'store'])->name('funcionarios.store');
        // Rota para atualizar funcionários existentes
        Route::put('/funcionarios/{id}', [FuncionariosController::class, 'update'])->name('funcionarios.update');
        // Rota para excluir funcionários
        Route::delete('/funcionarios/{id}', [FuncionariosController::class, 'destroy'])->name('funcionarios.destroy');

    // CARGOS
        Route::get('/cargos', [CargosController::class, 'index'])->name('cargos');
        Route::get('/cargos/data', [CargosController::class, 'getData'])->name('getdata-cargos');
        // Rota para exibir a view de criação de funcionários
        Route::get('/cargos/create', [CargosController::class, 'create'])->name('cargos.create');
        // Rota para editar um funcionário existente
        Route::get('/cargos/{id}/edit', [CargosController::class, 'edit'])->name('cargos.edit');
        // Rota para armazenar novos funcionários
        Route::post('/cargos', [CargosController::class, 'store'])->name('cargos.store');
        // Rota para atualizar funcionários existentes
        Route::put('/cargos/{id}', [CargosController::class, 'update'])->name('cargos.update');
        // Rota para excluir funcionários
        Route::delete('/cargos/{id}', [CargosController::class, 'destroy'])->name('cargos.destroy');

    // TURNOS
        Route::get('/turnos', [TurnosController::class, 'index'])->name('turnos');
        Route::get('/turnos/data', [TurnosController::class, 'getData'])->name('getdata-turnos');

    // DEPARTAMENTOS
        Route::get('/departamentos', [DepartamentosController::class, 'index'])->name('departamentos');
        Route::get('/departamentos/data', [DepartamentosController::class, 'getData'])->name('getdata-departamentos');

    // ESCALAS
        Route::get('/escalas', [EscalasController::class, 'index'])->name('escalas');
});