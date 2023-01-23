<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB; //referencia para hacer operaciones con la clase DB 
use App\Models\Home; //llamada de referencia a su modelo
use Carbon\Carbon; //importacion de la libreria de Carbon para las fechas
use DateTime;



class U_HomeController extends Controller
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

        $date = new DateTime(); // 2020-02-19 11:58:41.564592 
        $fecha_actual = $date->format('Y-m-d');  // 2020-02-19

        

        $proyectos_en_curso = DB::table('v_proyecto_asignado')
                ->select(DB::raw('count(*) as en_curso'))
                ->where('fecha_inicio', '<=', $fecha_actual)
                ->where('fecha_finalizacion', '>=', $fecha_actual)
                ->where('estado', '!=', 'CAN')
                ->where('estado', '!=', 'DES')
                ->where('estado', '!=', 'FIN')
                ->where('asignado_a', '=', Auth::user()->id)
                ->get();
        
        $proyectos_terminados = DB::table('v_proyecto_asignado')
                ->select(DB::raw('count(*) as terminados'))
                ->where('estado', '=', 'FIN')
                ->where('asignado_a', '=', Auth::user()->id)
                ->get();
        $proyectos_atrasados = DB::table('v_proyecto_asignado')
                ->select(DB::raw('count(*) as atrasados'))
                ->where('fecha_finalizacion', '<', $fecha_actual)
                ->where('estado', '!=', 'CAN')
                ->where('estado', '!=', 'FIN')
                ->where('asignado_a', '=', Auth::user()->id)
                ->get();
        $proyectos_cancelados = DB::table('v_proyecto_asignado')
                ->select(DB::raw('count(*) as cancelados'))
                ->where('estado', '=', 'CAN')
                ->where('asignado_a', '=', Auth::user()->id)
                ->get();

        ///////////// PROYECTOS EN EQUIPO ///////////////////////////////////

        $proyectos_en_curso_equipo = DB::table('v_proyecto_asignado_equipo')
                ->select(DB::raw('count(*) as en_curso'))
                ->where('fecha_inicio', '<=', $fecha_actual)
                ->where('fecha_finalizacion', '>=', $fecha_actual)
                ->where('estado', '!=', 'CAN')
                ->where('estado', '!=', 'DES')
                ->where('estado', '!=', 'FIN')
                ->where('id_usuario', '=', Auth::user()->id)
                ->get();
        
        $proyectos_terminados_equipo = DB::table('v_proyecto_asignado_equipo')
                ->select(DB::raw('count(*) as terminados'))
                ->where('estado', '=', 'FIN')
                ->where('id_usuario', '=', Auth::user()->id)
                ->get();
        $proyectos_atrasados_equipo = DB::table('v_proyecto_asignado_equipo')
                ->select(DB::raw('count(*) as atrasados'))
                ->where('fecha_finalizacion', '<', $fecha_actual)
                ->where('estado', '!=', 'CAN')
                ->where('estado', '!=', 'FIN')
                ->where('id_usuario', '=', Auth::user()->id)
                ->get();
        $proyectos_cancelados_equipo = DB::table('v_proyecto_asignado_equipo')
                ->select(DB::raw('count(*) as cancelados'))
                ->where('estado', '=', 'CAN')
                ->where('id_usuario', '=', Auth::user()->id)
                ->get();
        


        // TARJETAS GRANDES
        $actividades_usuario_individual = DB::table('v_actividades_individuales')
                ->select(DB::raw('count(*) as individuales'))
                ->where('estado', '!=', 'FIN')
                ->where('id_usuario', '=', Auth::user()->id)
                ->get();

        $actividades_usuario_equipo = DB::table('v_actividades_equipos')
                ->select(DB::raw('count(*) as equipo'))
                ->where('estado', '!=', 'FIN')
                ->where('id_usuario', '=', Auth::user()->id)
                ->get();

        foreach ($actividades_usuario_individual as $individual) {
            $act_individual = $individual->individuales;
        }
        foreach ($actividades_usuario_equipo as $equipo) {
            $act_equipo = $equipo->equipo;
        }
        $total_actividades = $act_individual + $act_equipo;



        $proyectos_usuario_individual = DB::table('v_proyecto_asignado')
                ->select(DB::raw('count(*) as proy_individual'))
                ->where('estado', '!=', 'FIN')
                ->where('estado', '!=', 'CAN')
                ->where('asignado_a', '=', Auth::user()->id)
                ->get();

        $proyectos_usuario_equipo = DB::table('v_proyecto_asignado_equipo')
                ->select(DB::raw('count(*) as proy_equipo'))
                ->where('estado', '!=', 'FIN')
                ->where('estado', '!=', 'CAN')
                ->where('id_equipo', '=', Auth::user()->id)
                ->get();

        foreach ($proyectos_usuario_individual as $individual_proy) {
            $proy_individual = $individual_proy->proy_individual;
        }
        foreach ($proyectos_usuario_equipo as $equipo_proy) {
            $proy_equipo = $equipo_proy->proy_equipo;
        }
        $total_proyectos = $proy_individual + $proy_equipo;
        
        
        $equipos_usuario = DB::table('v_equipos_usuarios')
                            ->select(DB::raw('count(DISTINCT(id_equipo)) as num_equipos'))
                            ->where('id_usuario', '=', Auth::user()->id)
                            ->get();
        
        foreach ($equipos_usuario as $equipos) {
            $total_equipos = $equipos->num_equipos;
        }
        
        return view('inicio.tablero_usuario', [
                                        'proyectos_en_curso' => $proyectos_en_curso,
                                        'proyectos_terminados' => $proyectos_terminados,
                                        'proyectos_atrasados' => $proyectos_atrasados,
                                        'proyectos_cancelados' => $proyectos_cancelados,
                                        'total_actividades' => $total_actividades,
                                        'total_proyectos' => $total_proyectos,
                                        'total_equipos' => $total_equipos,
                                        'proyectos_en_curso_equipo' => $proyectos_en_curso_equipo,
                                        'proyectos_terminados_equipo' => $proyectos_terminados_equipo,
                                        'proyectos_atrasados_equipo' => $proyectos_atrasados_equipo,
                                        'proyectos_cancelados_equipo' => $proyectos_cancelados_equipo,
                                        
                                        ]);

    }

}
