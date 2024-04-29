<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::post('/clientes', [ClienteController::class, 'store'])->withoutMiddleware(['web']);
Route::put('/clientes/{id}', [ClienteController::class, 'update'])->withoutMiddleware(['web']);
Route::delete('/clientes/{id}', [ClienteController::class, 'destroy'])->withoutMiddleware(['web']);
Route::get('/clientes', [ClienteController::class, 'index'])->withoutMiddleware(['web']);
Route::get('/clientes/ganador', [ClienteController::class, 'seleccionarGanador'])->withoutMiddleware(['web']);
Route::get('/clientes/by-status/{estado}', [ClienteController::class, 'obtenerClientesPorEstado'])->withoutMiddleware(['web']);
