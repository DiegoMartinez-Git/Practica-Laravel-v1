<?php

use App\Http\Controllers\EquipoController;
use App\Http\Controllers\SedeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [EquipoController::class, 'index'])->name('vista_equipos');
Route::get('/equipo/{id}', [EquipoController::class, 'show'])->name('vista_detalle_equipo');
Route::get('/sedes', [SedeController::class, 'index'])->name('vista_sedes');
Route::get('/formulario', [EquipoController::class, 'create'])->name('vista_fomulario_crear_equipo');
Route::post('/equipos', [EquipoController::class, 'store'])->name('guardar_equipo');




