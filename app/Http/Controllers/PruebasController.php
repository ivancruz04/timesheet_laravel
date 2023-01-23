<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Miembros; //llamada de referencia a su modelo
use App\Models\User; //llamada de referencia al modelo de usuarios
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Hash;
use DateTime;

class PruebasController extends Controller
{
    
    
    //registro inicial de primer usuario
    public function index(){

        $puestos = DB::table('puestos')
                    ->select('*')
                    ->get();

        $roles = DB::table('roles')
                    ->select('*')
                    ->get();

        return view('miembros.registro' , [
                                                 'puestos' => $puestos,
                                                 'roles' => $roles           
                                                ]);  

    }

    public function store(Request $request)
    {
        $miembro = new User();

        try {
            $miembro->name = $request->nombre;
            $miembro->email = $request->correo;
            $miembro->password =  Hash::make($request->contra);
            $miembro->id_puesto = $request->puesto;
            $miembro->id_puesto = $request->puesto;
            $miembro->assignRole($request->rol);
            $miembro->save();

            return response()->json([
                'respuesta' => 1
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'respuesta' => 2
            ]);
        }
    }
}
