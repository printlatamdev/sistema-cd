<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\OrdenProduccionController;
use App\Http\Controllers\MuebleController;


Route::get('/', function () {
    return view('welcome');
});

// Rutas para proyectos

Route::resource('proyectos', ProyectoController::class);
Route::get('proyectos/{proyecto}', [ProyectoController::class, 'show'])->name('proyectos.show');
Route::resource('recetas', RecetaController::class);


Route::resource('empresas', EmpresaController::class);
Route::resource('marcas', MarcaController::class);
// Ruta para almacenar muebles
Route::post('muebles', [MuebleController::class, 'store'])->name('muebles.store');
// routes/web.php
Route::resource('muebles', MuebleController::class);

