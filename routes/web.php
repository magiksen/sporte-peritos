<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ContrasenaController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    /* Usuarios */
    Route::get('/usuarios/all', [UsuarioController::class, 'AllUsuarios'])->name('all.usuarios');

    Route::post('/usuarios/buscar', [UsuarioController::class, 'BuscarUsuario'])->name('buscar.usuarios');

    /* Contraseñas */

    Route::get('/contrasena/{id}', [ContrasenaController::class, 'Index']);

    Route::post('/contrasena/update/{id}', [ContrasenaController::class, 'CambiarContra']);
});
