<?php

use App\Http\Controllers\AusenciaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SessoesController;
use App\Http\Middleware\CheckStatusForUser;
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

Route::middleware('guest')->group(function() {
    Route::get('/', function () {
        return redirect('/usuarios');
    });

});

Auth::routes([
    'register' => false, 'reset' => false,
]);

Route::middleware([CheckStatusForUser::class])->group(function() {
    Route::get('/oauth/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/auth/microsoft/redirect', [LoginController::class, 'loginMicrosoft'])->name('login.microsoft');
    Route::get('/auth/microsoft/callback', [LoginController::class, 'loginMicrosoftCallback'])->name('login.microsoft.callback');

    Route::get('/usuarios', [HomeController::class, 'usuarios'])->name('usuarios.listar');
    Route::get('/usuarios/tokens/{id}', [HomeController::class, 'tokens'])->name('usuarios.tokens');
    Route::get('/usuarios/{usuarioId}', [HomeController::class, 'editar'])->name('usuarios.editar');
    Route::get('/usuario/logout', [HomeController::class, 'logout'])->name('usuarios.logout');

    Route::get('/ausencias', [AusenciaController::class, 'ausencias'])->name('ausencias.listar');
    Route::get('/ausencias/editar/{id}', [AusenciaController::class, 'editar'])->name('ausencias.editar');

    Route::get('/ausencias/importacoes', [AusenciaController::class, 'importacoes'])->name('ausencias.importacoes.listar');

    Route::get('/clientes', [ClienteController::class, 'clientes'])->name('clientes.listar');
    Route::get('/clientes/{clienteId}/perfis', [ClienteController::class, 'perfis'])->name('clientes.perfis');
    Route::get('/clientes/perfis/{perfilId}', [ClienteController::class, 'permissoes'])->name('clientes.perfis.permissoes');
    Route::get('/clientes/{clienteId}/permissoes', [ClienteController::class, 'roles'])->name('clientes.roles');

    Route::get('/sessoes', [SessoesController::class, 'sessoes'])->name('sessoes.listar');
});
