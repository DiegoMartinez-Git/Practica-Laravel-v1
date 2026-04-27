<?php

use App\Http\Controllers\EquipoController;
use App\Http\Controllers\SedeController;
use Illuminate\Support\Facades\Route;


// ─── Rutas Publicas ─────────────────────────────────────────────────────



// ─── Rutas Index ─────────────────────────────────────────────────────
Route::get('/', [EquipoController::class, 'index'])->name('vista_equipos');
// ─── Rutas Equipo ────────────────────────────────────────────────────

/* 
Route::prefix('equipo')->name('equipo.')
    ->group(function () {
        Route::get('/', [EquipoController::class, 'index'])->name('vista_equipos');
        Route::get('/detalle/{id}', [EquipoController::class, 'show'])->name('vista_detalle_equipo');
        Route::get('/crear', [EquipoController::class, 'create'])->name('vista_fomulario_crear_equipo');
        Route::post('/guardado', [EquipoController::class, 'store'])->name('guardar_equipo');
        Route::get('/borrar', [EquipoController::class, 'store'])->name('vista_fselect_borrar_equipo');

    }); */


Route::resource('equipo', EquipoController::class);
// ─── Rutas Sede ─────────────────────────────────────────────────────

Route::resource('sede', SedeController::class);

/* Route::prefix('sede')->name('sede.')
    ->group(function () {
        Route::get('/', [SedeController::class, 'index'])->name('vista_sedes');
        Route::get('/detalle/{id}', [EquipoController::class, 'show'])->name('vista_detalle_equipo');
        Route::get('/crear', [EquipoController::class, 'create'])->name('vista_fomulario_crear_equipo');

        Route::delete('/borrar', [EquipoController::class, 'store'])->name('vista_fomulario_borrar_equipo');



    });

Route::get('/equipo/{id}', [EquipoController::class, 'show'])->name('vista_detalle_equipo');
Route::get('/sedes', [SedeController::class, 'index'])->name('vista_sedes');
Route::get('/formulario', [EquipoController::class, 'create'])->name('vista_fomulario_crear_equipo');
Route::post('/equipos', [EquipoController::class, 'store'])->name('guardar_equipo');
Route::delete('/equipos', [EquipoController::class, 'store'])->name('vista_fomulario_borrar_equipo'); */




