<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //referencia para hacer operaciones con la clase DB 
use Auth;


class U_EquiposController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void  
     */ 
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $mis_equipos = DB::table('v_equipos_usuarios')
                    ->select('*')
                    ->where('id_usuario', '=', Auth::user()->id)
                    ->get();

        return view('equipos.index_equipos_usuario', ['mis_equipos' => $mis_equipos]);
    }

    public function verEquipoUsuario($idEquipo){

        $equipo_seleccionado_info = DB::table('v_equipos_usuarios')
                    ->select('*')
                    ->where('id_equipo', '=', $idEquipo)
                    ->limit(1)
                    ->get();

        $equipo_seleccionado = DB::table('v_equipos_usuarios')
                    ->select('*')
                    ->where('id_equipo', '=', $idEquipo)
                    ->get();

        return view('equipos.ver_equipo_usuario', ['equipo_seleccionado' => $equipo_seleccionado,
                                                   'equipo_seleccionado_info' => $equipo_seleccionado_info]);
    }
}
