<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ContrasenaController;
use App\Http\Controllers\SolicitudesController;
use App\Http\Controllers\ProfesionesController;


Route::get('/', function () {
    return view('auth.login');
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
    Route::controller(UsuarioController::class)->group(function () {
        Route::get('/usuarios/all', 'AllUsuarios')->name('all.usuarios');
        Route::post('/usuarios/buscar', 'BuscarUsuario')->name('buscar.usuarios');
        /* Activar Usuario */
        Route::get('/activarusuario/{id}', 'ActivarUsuario');
    });

    /* Contraseñas */
    Route::controller(ContrasenaController::class)->group(function () {
        Route::get('/contrasena/{id}', 'Index');
        Route::post('/contrasena/update/{id}', 'CambiarContra');
    });


    /* Solicitudes */
    Route::controller(SolicitudesController::class)->group(function () {
        Route::get('/solicitudes', 'Index')->name('all.solicitudes');
        Route::get('/solicitudes/buscar/{id}', 'Buscar');
        Route::get('/solicitudes/estatus/{id}', 'ListarEstatus');
        Route::post('/solicitudes/estatus/cambiar/{id}', 'CambiarEstatus');
    });

    /* Profesiones */
    Route::controller(ProfesionesController::class)->group(function () {
        Route::get('/profesiones', 'Index')->name('all.profesiones');
        Route::post('/profesiones/insertar/', 'Store')->name('store.profesion');
    });

    /* Especialidades */
});
