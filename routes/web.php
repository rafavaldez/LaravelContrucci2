<?php

use Illuminate\Support\Facades\Route;

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


Route::prefix('autenticacion')->name('autenticacion.')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('gestionar-usuario', [UsuarioController::class, 'index'])->name('gestionar_usuario');
    Route::post('registrar', [UsuarioController::class, 'registrar'])->name('registrar');
    Route::get('editar/{usuario}', [UsuarioController::class, 'editar'])->name('editar');
    Route::put('actualizar/{usuario}', [UsuarioController::class, 'actualizar'])->name('actualizar');
    Route::delete('eliminar/{usuario}', [UsuarioController::class, 'eliminar'])->name('eliminar');
});

Route::post('/upload', [FileUploadController::class, 'uploadFile']);
Route::post('/api/registrar_tramite', [TramiteController::class, 'registrarTramite']);
Route::get('/admin/destino', [AdminController::class, 'adminDestino']);
Route::post('/admin/destino', [AdminController::class, 'destino']);

Route::match(['get', 'post'], '/historial-anomalias', [AnomaliasController::class, 'adminHistorialAnomalias'])->name('historial-anomalias');
Route::post('/admin/ResultadosInforme', [AdminController::class, 'adminResultadosInforme']);