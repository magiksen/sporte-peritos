<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SolicitudesController extends Controller
{
    public function Index() {
        $solicitudes = DB::connection('pgsql2')->table('estatus_solicitud_peritos')->get();

        return view('admin.solicitudes.index', compact('solicitudes'));
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
        ->where('id', $id)->first(); // Falta el join para mostrar el nombe del estatus


        return view('admin.solicitudes.estatus', compact('estatus', 'estatu'));
    }

    public function CambiarEstatus(Request $request, $id) {
        $nuevo_estatus = $request->nuevo_estatus;

        $affected = DB::connection('pgsql2')->table('solicitud_peritos')
              ->where('id', $id)
              ->update(['id_estatus_solicitud' => $nuevo_estatus]);

        return Redirect()->back()->with('success', 'Estatus cambiado correctamente');
    }
}
