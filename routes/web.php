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

    Route::get('/funcionarios', [FuncionariosController::class, 'index'])->name('funcionarios');
    Route::get('/getData-funcionarios', [FuncionariosController::class, 'getData'])->name('getdata-funcionarios');

    Route::get('/cargos', [CargosController::class, 'index'])->name('cargos');
    Route::get('/getData-cargos', [CargosController::class, 'getData'])->name('getdata-cargos');

    Route::get('/turnos', [TurnosController::class, 'index'])->name('turnos');
    Route::get('/getData-turnos', [TurnosController::class, 'getData'])->name('getdata-turnos');

    Route::get('/departamentos', [DepartamentosController::class, 'index'])->name('departamentos');
    Route::get('/getData-departamentos', [DepartamentosController::class, 'getData'])->name('getdata-departamentos');

    Route::get('/escalas', [EscalasController::class, 'index'])->name('escalas');
});
