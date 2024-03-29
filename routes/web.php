<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ContrasenaController;
use App\Http\Controllers\SolicitudesController;
use App\Http\Controllers\ProfesionesController;
use App\Http\Controllers\EspecialidadesController;
use App\Http\Controllers\TrazaController;



Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        $buscar = false;

        return view('admin.usuarios.index', compact('buscar'));
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
        Route::get('/solicitudes/profesion/{id}', 'GetProfesion');
        Route::post('/solicitudes/profesion/cambiar/{id}', 'UpdateProfesion');
        Route::get('/solicitudes/especialidad/{id}', 'GetEspecialidad');
        Route::post('/solicitudes/especialidad/cambiar/{id}', 'UpdateEspecialidad');
        Route::post('/solicitudes/especialidad/agregar/{id}', 'AgregarEspecialidad');
        Route::get('/solicitudes/especialidad/eliminar/{id}', 'EliminarEspecialidad');
        Route::get('/solicitudes/recaudos/{id}', 'GetRecaudos');
        Route::get('/solicitudes/recaudos/habilitar/{id}', 'HabilitarRecaudo');
        Route::get('/solicitudes/recaudos/eliminar/{id}', 'EliminarRecaudo');
        Route::post('/solicitudes/recaudos/insertar', 'GuardarRecaudo')->name('store.recaudo');
        Route::get('/solicitudes/eliminar/{id}', 'EliminarSolicitud');
        Route::get('/solicitudes/traza/{id}', 'TrazaSolicitud')->name('solicitud.traza');
        Route::get('/solicitudes/traza/descargar/{id}', 'TrazaDescargar')->name('descargar.traza');
        Route::get('/solicitudes/experiencia/{id}', 'GetExperiencia');
        Route::post('/solicitudes/experiencia/cambiar/{id}', 'UpdateExperiencia');

    });

    /* Profesiones */
    Route::controller(ProfesionesController::class)->group(function () {
        Route::get('/profesiones', 'Index')->name('all.profesiones');
        Route::post('/profesiones/insertar/', 'Store')->name('store.profesion');
        Route::get('/profesiones/editar/{id}', 'Edit');
        Route::post('/profesiones/cambiar/{id}', 'Update');
    });

    /* Especialidades */
    Route::controller(EspecialidadesController::class)->group(function () {
        Route::get('/especialidades', 'Index')->name('all.especialidades');
        Route::post('/especialidades/insertar/', 'Store')->name('store.especialidad');
        Route::get('/especialidades/editar/{id}', 'Edit');
        Route::post('/especialidades/cambiar/{id}', 'Update');
        Route::get('/especialidades/eliminar/{id}', 'Delete');
    });

    /* Traza */
    Route::controller(TrazaController::class)->group(function () {
        Route::get('/seguimiento', 'Index')->name('trazas');
    });
});
