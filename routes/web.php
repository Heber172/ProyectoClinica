<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('login', function(){
//     return view('login');
// });
// Route::get('main', function(){
//     return view('main');
// });

// Rutas alternas BACKEND LARAVEL
use App\Http\Controllers\PdfController;
Route::prefix('extra')->group(function () {
    Route::get('historial-clinico/{cod_paciente}', [PdfController::class, 'generarHistorialClinico']);
    Route::get('planificacion-servicio/{cod_planificacion}', [PdfController::class, 'generarPlanificacionServicio']);
    Route::get('pago-servicio/{cod_pago_servicio}', [PdfController::class, 'generarPagoServicio']);
});

// Ruta FRONTEND - VUE
Route::get('{any}', function(){
    return view('main');
})->where('any', '.*');
