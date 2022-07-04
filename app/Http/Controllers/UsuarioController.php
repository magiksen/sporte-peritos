<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class UsuarioController extends Controller
{
    public function AllUsuarios() {
        //$usuarios = DB::connection('pgsql2')->table('users')->paginate(15);

        $buscar = false;
 
        return view('admin.usuarios.index', compact('buscar'));
    }

    public function BuscarUsuario(Request $request) {

        $tipo = $request->buscar_name;

        $busqueda = $request->usuario_name;

        $buscar = true;

        if ($tipo == 'cedula') {
            $resultado = DB::connection('pgsql2')->table('users')->where('cedula', 'LIKE','%'.$busqueda.'%')->get();
        } elseif ($tipo == 'correo') {
            $resultado = DB::connection('pgsql2')->table('users')->where('email', 'LIKE','%'.$busqueda.'%')->get(); 
        } else {
            $resultado = DB::connection('pgsql2')->table('users')->where('name', 'LIKE','%'.$busqueda.'%')->get();
        }

        $resultado = collect($resultado)->all();

        return view('admin.usuarios.index', compact('resultado', 'buscar'));
    }

    public function ActivarUsuario($id) {
        $affected = DB::connection('pgsql2')->table('users')
              ->where('id', $id)
              ->update(['status' => 'true']);

        return Redirect()->route('all.usuarios')->with('success', 'Usuario activado correctamente');        
    }
}