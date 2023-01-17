<?php

namespace App\Http\Controllers;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class SolicitudesController extends Controller
{
    public function Index() {
        $listado = DB::connection('pgsql2')->table('estatus_solicitud_peritos')->get();

        return view('admin.solicitudes.index', compact('listado'));
    }

    public function Buscar($id) {
        // Buscar solicitudes del usuario
        $solicitudes = DB::connection('pgsql2')->table('solicitud_peritos')
            ->join('users', 'solicitud_peritos.id_usuario', '=', 'users.id')
            ->join('estatus_solicitud_peritos', 'solicitud_peritos.id_estatus_solicitud', '=', 'estatus_solicitud_peritos.id')
            ->select('solicitud_peritos.*', 'users.name as nombe_usuario', 'estatus_solicitud_peritos.descripcion as descripcion', 'solicitud_peritos.activo as estado_solicitud')
            ->where('id_usuario', $id)->get();

        //dd($solicitudes);

        return view('admin.solicitudes.buscar', compact('solicitudes'));
    }

    public function ListarEstatus($id) {
        $estatus = DB::connection('pgsql2')->table('estatus_solicitud_peritos')->get();

        $estatu = DB::connection('pgsql2')->table('solicitud_peritos')
            ->join('estatus_solicitud_peritos', 'solicitud_peritos.id_estatus_solicitud', '=', 'estatus_solicitud_peritos.id')
            ->select('solicitud_peritos.*', 'estatus_solicitud_peritos.descripcion as estatus_descripcion')
            ->where('solicitud_peritos.id', $id)->first();

        $id_solicitud = $id;

        return view('admin.solicitudes.estatus', compact('estatus', 'estatu', 'id_solicitud'));
    }

    public function CambiarEstatus(Request $request, $id) {
        $nuevo_estatus = $request->nuevo_estatus;

        $affected = DB::connection('pgsql2')->table('solicitud_peritos')
              ->where('id', $id)
              ->update(['id_estatus_solicitud' => $nuevo_estatus]);

        return Redirect()->back()->with('success', 'Estatus cambiado correctamente');
    }

    public function GetProfesion($id) {
        $profesion = DB::connection('pgsql2')->table('solicitud_profesion_peritos')->where('id_perito_solicitud',$id)->first();

        $id_solicitud = $id;

        return view('admin.solicitudes.profesion', compact('profesion','id_solicitud'));
    }

    public function UpdateProfesion(Request $request, $id) {
        $nueva_profesion_id= $request->nueva_profesion_id;
        $nueva_profesion = ucwords($request->nueva_profesion);

        $affected = DB::connection('pgsql2')->table('solicitud_profesion_peritos')
            ->where('id', $id)
            ->update([
                'id_profesions' => $nueva_profesion_id,
                'descripcion' => $nueva_profesion
            ]);

        return Redirect()->back()->with('success', 'Profesion de la solicitud actualizada correctamente');
    }

    public function GetEspecialidad($id) {
        $especialidades = DB::connection('pgsql2')->table('solicitud_especialidad_peritos')
            ->join('especialidad_personas', 'solicitud_especialidad_peritos.id_especialidad', '=', 'especialidad_personas.id')
            ->select('solicitud_especialidad_peritos.*', 'especialidad_personas.descripcion as especialidad_descripcion')
            ->where('id_perito_solicitud',$id)
            ->get();

        $id_solicitud = $id;

//        dd($especialidades);

        return view('admin.solicitudes.especialidad', compact('especialidades', 'id_solicitud'));
    }

    public function AgregarEspecialidad(Request $request, $id) {
        $nueva_especialidad_id= $request->nueva_especialidad_id;

        $last_record = DB::connection('pgsql2')->table('solicitud_especialidad_peritos')->latest('id')->first();
        $last_id = $last_record->id;

        DB::connection('pgsql2')->table('solicitud_especialidad_peritos')->insert([
            'id' => $last_id + 1,
            'id_perito_solicitud' => $id,
            'id_especialidad' => $nueva_especialidad_id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        return Redirect()->back()->with('success', 'Especialidad de la solicitud agregada correctamente');
    }

    public function UpdateEspecialidad(Request $request, $id) {
        $nueva_especialidad_id= $request->nueva_especialidad_id;

        $affected = DB::connection('pgsql2')->table('solicitud_especialidad_peritos')
            ->where('id', $id)
            ->update([
                'id_especialidad' => $nueva_especialidad_id,
            ]);

        return Redirect()->back()->with('success', 'Especialidad de la solicitud actualizada correctamente');
    }

    public function EliminarEspecialidad($id) {

        $affected = DB::connection('pgsql2')->table('solicitud_especialidad_peritos')
            ->where('id', $id)
            ->delete();

        return Redirect()->back()->with('success', 'Especialidad de la solicitud eliminada correctamente');
    }

    public function GetRecaudos($id) {
        $recaudos = DB::connection('pgsql2')->table('solicitud_recaudo_peritos')
            ->join('recaudo_personas', 'solicitud_recaudo_peritos.id_recaudo', '=', 'recaudo_personas.id')
            ->select('solicitud_recaudo_peritos.*', 'recaudo_personas.descripcion as descripcion')
            ->where('id_perito_solicitud',$id)->get();

        $nombres_recaudos = DB::connection('pgsql2')->table('recaudo_personas')->get();

        $id_solicitud = $id;

        $id_usuario = DB::connection('pgsql2')->table('solicitud_peritos')
            ->where('id', $id_solicitud)
            ->first();

        return view('admin.solicitudes.recaudos', compact('recaudos', 'nombres_recaudos', 'id_solicitud','id_usuario'));
    }

    public function HabilitarRecaudo($id) {
        $affected = DB::connection('pgsql2')->table('solicitud_recaudo_peritos')
            ->where('id', $id)
            ->update([
                'correccion' => '0',
            ]);

        return Redirect()->back()->with('success', 'Recaudo habilitado para montarlo');
    }

    public function EliminarRecaudo($id) {
        $affected = DB::connection('pgsql2')->table('solicitud_recaudo_peritos')
            ->where('id', $id)
            ->delete();

        return Redirect()->back()->with('success', 'Recaudo eliminado correctamente');
    }

    public function GuardarRecaudo(Request $request) {

        $last_record = DB::connection('pgsql2')->table('solicitud_recaudo_peritos')->latest('id')->first();
        $last_id = $last_record->id;

        DB::connection('pgsql2')->table('solicitud_recaudo_peritos')->insert([
            'id' => $last_id + 1,
            'id_perito_solicitud' => $request->solicitud,
            'id_recaudo' => $request->recaudo,
            'aprobado' => 'false',
            'comentario' => '',
            'formato' => '',
            'id_usuario' => $request->usuario,
            'correccion' => '0',
            'adjunto' => 'borrador.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        return Redirect()->back()->with('success', 'Recaudo agregado correctamente');
    }

    public function EliminarSolicitud($id) {
        $eliminarcredencial = DB::connection('pgsql2')->table('traza_solicitud_peritos')
            ->where('id_perito_solicitud', $id)
            ->delete();
        $eliminartraza = DB::connection('pgsql2')->table('credencial_peritos')
            ->where('id_perito_solicitud', $id)
            ->delete();
        $eliminarrecaudo = DB::connection('pgsql2')->table('solicitud_recaudo_peritos')
            ->where('id_perito_solicitud', $id)
            ->delete();
        $eliminarasociacion = DB::connection('pgsql2')->table('solicitud_asociacion_peritos')
            ->where('id_perito_solicitud', $id)
            ->delete();
        $eliminarejercicio = DB::connection('pgsql2')->table('solicitud_ejercicio_peritos')
            ->where('id_perito_solicitud', $id)
            ->delete();
        $eliminarespecialidad = DB::connection('pgsql2')->table('solicitud_especialidad_peritos')
            ->where('id_perito_solicitud', $id)
            ->delete();
        $eliminarpofesion = DB::connection('pgsql2')->table('solicitud_profesion_peritos')
            ->where('id_perito_solicitud', $id)
            ->delete();
        $eliminarsolicitud = DB::connection('pgsql2')->table('solicitud_peritos')
            ->where('id', $id)
            ->delete();

        return Redirect()->back()->with('success', 'Solicitud eliminada correctamente');
    }

    public function TrazaSolicitud($id) {
        $trazas = DB::connection('pgsql2')->table('traza_solicitud_peritos as tsp')
            ->join('estatus_solicitud_peritos as esp', 'tsp.id_estatus_solicitud', '=', 'esp.id')
            ->join('users as user', 'tsp.id_usuario', '=', 'user.id')
            ->select('tsp.*', 'esp.descripcion as estatus_name', 'user.name as usuario_name')
            ->where('id_perito_solicitud', $id)
            ->orderBy('tsp.created_at', 'desc')
            ->get();

        $solicitud_id = $id;

        $datos_usuario = DB::connection('pgsql2')->table('solicitud_peritos as sp')
            ->join('users as usuario', 'sp.id_usuario', '=', 'usuario.id')
            ->select('sp.*', 'usuario.name as nombre', 'usuario.email as correo', 'usuario.cedula as cedula', 'usuario.created_at as creado')
            ->where('sp.id', $id)
            ->first();

        // Credenciales (Preguntar si updated_at es la fecha de vencimiento)
        $credencial = DB::connection('pgsql2')->table('credencial_peritos as cp')
            ->join('peritos as p', 'cp.id_perito', '=', 'p.id')
            ->select('cp.*', 'p.rnp as ncredencial', 'p.updated_at as fcredencial')
            ->where('cp.id_perito_solicitud', $id)
            ->first();

        return view('admin.solicitudes.traza', compact('trazas', 'solicitud_id', 'datos_usuario', 'credencial'));
    }

    public function TrazaDescargar($id) {
        $trazas = DB::connection('pgsql2')->table('traza_solicitud_peritos as tsp')
            ->join('estatus_solicitud_peritos as esp', 'tsp.id_estatus_solicitud', '=', 'esp.id')
            ->join('users as user', 'tsp.id_usuario', '=', 'user.id')
            ->select('tsp.*', 'esp.descripcion as estatus_name', 'user.name as usuario_name')
            ->where('id_perito_solicitud', $id)
            ->orderBy('tsp.created_at', 'desc')
            ->get();

        $solicitud_id = $id;

        $datos_usuario = DB::connection('pgsql2')->table('solicitud_peritos as sp')
            ->join('users as usuario', 'sp.id_usuario', '=', 'usuario.id')
            ->select('sp.*', 'usuario.name as nombre', 'usuario.email as correo', 'usuario.cedula as cedula', 'usuario.created_at as creado')
            ->where('sp.id', $id)
            ->first();

        // Credenciales (Preguntar si updated_at es la fecha de vencimiento)
        $credencial = DB::connection('pgsql2')->table('credencial_peritos as cp')
            ->join('peritos as p', 'cp.id_perito', '=', 'p.id')
            ->select('cp.*', 'p.rnp as ncredencial', 'p.updated_at as fcredencial')
            ->where('cp.id_perito_solicitud', $id)
            ->first();

        $data = compact('trazas', 'solicitud_id', 'datos_usuario', 'credencial');

        $pdf = Pdf::loadView('pdf.traza', $data);
        return $pdf->download('traza-'.$datos_usuario->cedula.'.pdf');
    }

    public function GetExperiencia($id) {
        $profesion = DB::connection('pgsql2')->table('solicitud_profesion_peritos')->where('id_perito_solicitud',$id)->first();

        $id_solicitud = $id;

        return view('admin.solicitudes.experiencia', compact('profesion','id_solicitud'));
    }

    public function UpdateExperiencia(Request $request, $id) {
        $nueva_experiencia = $request->nueva_experiencia;

        $affected = DB::connection('pgsql2')->table('solicitud_profesion_peritos')
            ->where('id', $id)
            ->update([
                'experiencia' => $nueva_experiencia,
            ]);

        return Redirect()->back()->with('success', 'Experiencia como tasador actualizada correctamente');
    }
}
