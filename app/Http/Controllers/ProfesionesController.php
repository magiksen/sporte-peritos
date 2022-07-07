<?php

namespace App\Http\Controllers;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProfesionesController extends Controller
{
    public function Index() {
        $profesiones = DB::connection('pgsql2')->table('profesion_personas')->latest()->paginate();

        return view('admin.profesiones.index', compact('profesiones'));
    }

    public function Store(Request $request) {

        $last_record = DB::connection('pgsql2')->table('profesion_personas')->latest('id')->first();
        $last_id = $last_record->id;

        DB::connection('pgsql2')->table('profesion_personas')->insert([
            'id' => $last_id + 1,
            'descripcion' => $request->profesion_nombre,
            'activo' => true,
            'created_at' => Carbon::now(),
        ]);

        return Redirect()->back()->with('success', 'Profesion registrada correctamente');
    }
}
