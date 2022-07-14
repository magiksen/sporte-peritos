<?php

namespace App\Http\Controllers;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

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


        return view('admin.solicitudes.estatus', compact('estatus', 'estatu'));
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

        return view('admin.solicitudes.profesion', compact('profesion'));
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
        $especialidad = DB::connection('pgsql2')->table('solicitud_especialidad_peritos')
            ->join('especialidad_personas', 'solicitud_especialidad_peritos.id_especialidad', '=', 'especialidad_personas.id')
            ->select('solicitud_especialidad_peritos.*', 'especialidad_personas.descripcion as especialidad_descripcion')
            ->where('id_perito_solicitud',$id)
            ->first();

        return view('admin.solicitudes.especialidad', compact('especialidad'));
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
}
