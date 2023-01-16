<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrazaController extends Controller
{
    public function Index(Request $request) {

        $buscar = mb_strtoupper($request->search);

        if ($request->filled('search')) {
            $trazas = DB::connection('pgsql2')->table('traza_solicitud_peritos as tsp')
                ->join('estatus_solicitud_peritos as esp', 'tsp.id_estatus_solicitud', '=', 'esp.id')
                ->join('users as user', 'tsp.id_usuario', '=', 'user.id')
                ->join('solicitud_peritos as sop', 'tsp.id_perito_solicitud', '=', 'sop.id')
                ->select('tsp.*', 'esp.descripcion as estatus_name', 'user.name as usuario_name', 'sop.id_usuario as usuario_solicitud_id')
                ->where('tsp.id_perito_solicitud', 'LIKE', '%'.$buscar.'%')
                ->latest()
                ->paginate(20);
        } else {
            $trazas = DB::connection('pgsql2')->table('traza_solicitud_peritos as tsp')
                ->join('estatus_solicitud_peritos as esp', 'tsp.id_estatus_solicitud', '=', 'esp.id')
                ->join('users as user', 'tsp.id_usuario', '=', 'user.id')
                ->join('solicitud_peritos as sop', 'tsp.id_perito_solicitud', '=', 'sop.id')
                ->join('users as upe', 'sop.id_usuario', '=', 'upe.id')
                ->select('tsp.*', 'esp.descripcion as estatus_name', 'user.name as usuario_name', 'upe.name as usuario_solicitud_id')
                ->latest()
                ->paginate(20);
        }

        return view('admin.traza.index', compact('trazas'));
    }
}
