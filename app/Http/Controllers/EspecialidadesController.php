<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class EspecialidadesController extends Controller
{
    public function Index(Request $request) {

        $buscar = mb_strtoupper($request->search);

        if ($request->filled('search')) {
            $especialidades = DB::connection('pgsql2')->table('especialidad_personas')
                ->where('descripcion', 'LIKE', '%'.$buscar.'%')
                ->latest()
                ->paginate();
        } else {
            $especialidades = DB::connection('pgsql2')->table('especialidad_personas')->latest()->paginate();
        }

        return view('admin.especialidades.index', compact('especialidades'));
    }

    public function Store(Request $request) {

        $last_record = DB::connection('pgsql2')->table('especialidad_personas')->latest('id')->first();
        $last_id = $last_record->id;

        DB::connection('pgsql2')->table('especialidad_personas')->insert([
            'id' => $last_id + 1,
            'descripcion' => strtoupper($request->especialidad_nombre),
            'activo' => true,
            'created_at' => Carbon::now(),
        ]);

        return Redirect()->back()->with('success', 'Especialidad registrada correctamente');
    }

    public function Edit($id) {
        $especialidades = DB::connection('pgsql2')->table('especialidad_personas')->where('id',$id)->first();

        return view('admin.especialidades.editar', ['especialidades' => $especialidades]);
    }

    public function Update(Request $request, $id) {
        $nueva_descripcion = strtoupper($request->nueva_descripcion);

        $affected = DB::connection('pgsql2')->table('especialidad_personas')
            ->where('id', $id)
            ->update(['descripcion' => $nueva_descripcion]);

        return Redirect()->route('all.especialidades')->with('success', 'Especialidad actualizada correctamente');
    }

    public function Delete($id) {
        DB::connection('pgsql2')->table('especialidad_personas')
            ->where('id', $id)
            ->delete();

        return Redirect()->route('all.especialidades')->with('success', 'Especialidad eliminada correctamente');
    }
}
