<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Producto;
use App\Http\Controllers\productoController;

Route::get('/productos', [productoController::class, 'index']);
Route::get('/productos/{id}', [productoController::class, 'show']);
Route::post('/productos/crear', [productoController::class, 'store']);
Route::delete('/productos/borrar/{id}', [productoController::class, 'destroy']);
Route::put('/productos/editar/{id}', [productoController::class, 'update']);