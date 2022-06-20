<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ContrasenaController extends Controller
{
     public function Index($id) {

        $usuario = DB::connection('pgsql2')->table('users')->where('id', $id)->first();
 
        return view('admin.contrasena.index', compact('usuario'));
    }

    public function CambiarContra(Request $request, $id) {

        $new_password = Hash::make($request->nueva_contra);

        $affected = DB::connection('pgsql2')->table('users')
              ->where('id', $id)
              ->update(['password' => $new_password]);

        return Redirect()->route('all.usuarios')->with('success', 'Contraseña cambiada correctamente');      

    }
}
