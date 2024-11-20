<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Producto;
use App\Http\Controllers\productoController;

Route::get('/productos', [productoController::class, 'index']);
Route::post('/productos', [productoController::class, 'store']);
