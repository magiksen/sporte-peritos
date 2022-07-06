<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProfesionesController extends Controller
{
    public function Index() {
        $profesiones = DB::connection('pgsql2')->table('profesion_personas')->paginate(15);

        return view('admin.profesiones.index', compact('profesiones'));
    }
}
