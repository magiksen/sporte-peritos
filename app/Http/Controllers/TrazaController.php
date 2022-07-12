<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrazaController extends Controller
{
    public function Index() {
       $trazas = DB::connection('pgsql2')->table('traza_solicitud_peritos as tsp')
           ->join('estatus_solicitud_peritos as esp', 'tsp.id_estatus_solicitud', '=', 'esp.id')
           ->join('users as user', 'tsp.id_usuario', '=', 'user.id')
           ->select('tsp.*', 'esp.descripcion as estatus_name', 'user.name as usuario_name')
           ->latest()
           ->paginate(20);

        return view('admin.traza.index', compact('trazas'));
    }
}
