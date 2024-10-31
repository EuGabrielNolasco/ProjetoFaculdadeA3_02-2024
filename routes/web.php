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

    Route::get('/funcionarios', [FuncionariosController::class, 'index'])->name('funcionarios');
    Route::get('/getData-funcionarios', [FuncionariosController::class, 'getData'])->name('getdata-funcionarios');

    Route::get('/relatorios', [RelatoriosController::class, 'index'])->name('relatorios');
    Route::get('/cargos', [CargosController::class, 'index'])->name('cargos');
    Route::get('/turnos', [TurnosController::class, 'index'])->name('turnos');
    Route::get('/escalas', [EscalasController::class, 'index'])->name('escalas');
    Route::get('/departamentos', [DepartamentosController::class, 'index'])->name('departamentos');

});
