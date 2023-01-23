<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Proyectos;//llamada de referencia a su modelo
use App\Models\User;//llamada de referencia al modelo de usuarios
use App\Models\Actividades;//llamada de referencia al modelo de actividades
use Illuminate\Support\Facades\DB;//referencia para hacer operaciones con la clase DB 
use DateTime;
use Carbon\Carbon;

class ReportesController extends Controller
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

        $equipos = DB::table('equipos')
                ->select(DB::raw('DISTINCT(id_equipo), nombre_equipo'))
                ->get();

        $usuarios = DB::table('users')
                ->select(DB::raw('id, name'))
                ->get();

        return view('reportes.index_reportes', ['equipos' => $equipos,
                                                'usuarios' => $usuarios]);
    }

    public function exportarIndividuales($usuario, $desde, $hasta){
        
        $actividades_select = DB::table('v_actividades_individuales')
                ->select('*')
                ->where('id_usuario', '=', $usuario)
                ->where('fecha_asignacion', '>=', $desde)
                ->where('fecha_fin', '<=', $hasta)
                ->get();

        $act_total = DB::table('v_actividades_individuales')
                ->select(DB::raw('COUNT(id_actividad) as totales'))
                ->where('id_usuario', '=', $usuario)
                ->where('fecha_asignacion', '>=', $desde)
                ->where('fecha_fin', '<=', $hasta)
                ->get();

        $act_pendientes = DB::table('v_actividades_individuales')
                ->select(DB::raw('COUNT(id_actividad) as pendientes'))
                ->where('id_usuario', '=', $usuario)
                ->where('fecha_asignacion', '>=', $desde)
                ->where('fecha_fin', '<=', $hasta)
                ->where('estado', '=', 'PEN')
                ->get();

        $act_atrasadas = DB::table('v_actividades_individuales')
                ->select(DB::raw('COUNT(id_actividad) as atrasadas'))
                ->where('id_usuario', '=', $usuario)
                ->where('fecha_asignacion', '>=', $desde)
                ->where('fecha_fin', '<=', $hasta)
                ->where('estado', '=', 'DES')
                ->get();

        foreach ($actividades_select as $act) {
                    $nombre = $act->name;
                }
        foreach ($act_total as $actividadtotal) {
                    $totales = $actividadtotal->totales;
        }

        foreach ($act_pendientes as $actividadpen) {
            $pendientes = $actividadpen->pendientes;
        }
        foreach ($act_atrasadas as $actividadatras) {
            $atrasadas = $actividadatras->atrasadas;
        }
        
        $pdf = \PDF::loadView('reportes.reporte_act_individuales', ['actividades_select' => $actividades_select,
                                                                    'nombre' => $nombre,
                                                                    'desde' => $desde,
                                                                    'hasta' => $hasta,
                                                                    'pendientes' => $pendientes,
                                                                    'atrasadas' => $atrasadas,
                                                                    'totales' => $totales])->setPaper('a4', 'landscape');
        return $pdf->download('actividadesindividuales.pdf');            
    }

    public function exportarEquipo($equipo, $desde, $hasta){

        $actividades_select = DB::table('v_actividades_equipos')
                ->select(DB::raw('DISTINCT(id_actividad), nombre_actividad, descripcion, fecha_asignacion, 
                                    fecha_fin, fecha_inicio, fecha_entrega, estado, estado_entrega, descripcion_larga, 
                                    nombre_equipo, nombre_proyecto'))
                ->where('id_equipo', '=', $equipo)
                ->where('fecha_asignacion', '>=', $desde)
                ->where('fecha_fin', '<=', $hasta)
                ->get();

        $nombre_equipo = DB::table('v_actividades_equipos')
                ->select('*')
                ->where('id_equipo', '=', $equipo)
                ->where('fecha_asignacion', '>=', $desde)
                ->where('fecha_fin', '<=', $hasta)
                ->get();


        $act_total = DB::table('v_actividades_equipos')
                ->select(DB::raw('COUNT(DISTINCT(id_actividad)) as totales'))
                ->where('id_equipo', '=', $equipo)
                ->where('fecha_asignacion', '>=', $desde)
                ->where('fecha_fin', '<=', $hasta)
                ->get();

        $act_pendientes = DB::table('v_actividades_equipos')
                ->select(DB::raw('COUNT(id_actividad) as pendientes'))
                ->where('id_equipo', '=', $equipo)
                ->where('fecha_asignacion', '>=', $desde)
                ->where('fecha_fin', '<=', $hasta)
                ->where('estado', '=', 'PEN')
                ->get();

        $act_atrasadas = DB::table('v_actividades_equipos')
                ->select(DB::raw('COUNT(id_actividad) as atrasadas'))
                ->where('id_equipo', '=', $equipo)
                ->where('fecha_asignacion', '>=', $desde)
                ->where('fecha_fin', '<=', $hasta)
                ->where('estado', '=', 'DES')
                ->get();

        $miembros_equipo = DB::table('v_actividades_equipos')
                ->select(DB::raw('name'))
                ->where('id_equipo', '=', $equipo)
                ->get();
        
        foreach ($nombre_equipo as $act) {
                    $nombre_equipo = $act->nombre_equipo;
        }
        foreach ($act_total as $actividadtotal) {
                    $totales = $actividadtotal->totales;
        }

        foreach ($act_pendientes as $actividadpen) {
            $pendientes = $actividadpen->pendientes;
        }
        foreach ($act_atrasadas as $actividadatras) {
            $atrasadas = $actividadatras->atrasadas;
        }

        $pdf = \PDF::loadView('reportes.reporte_act_equipo', ['actividades_select' => $actividades_select,
                                                                    'nombre_equipo' => $nombre_equipo,
                                                                    'desde' => $desde,
                                                                    'hasta' => $hasta,
                                                                    'pendientes' => $pendientes,
                                                                    'atrasadas' => $atrasadas,
                                                                    'totales' => $totales,
                                                                    'miembros_equipo' => $miembros_equipo])->setPaper('a4', 'landscape');
        return $pdf->download('actividadesEquipo.pdf');  
        
    }

    // public function imprimir(){

    //     $actividades = DB::table('v_actividades_individuales')
    //             ->select('*')
    //             ->where('id_usuario', '=', 2)
    //             ->get();

    //     foreach ($actividades as $usuario) {
    //         $nombre_usuario = $usuario->name;
    //     }

    //     $pdf = \PDF::loadView('reportes.reporte_act_individuales', ['actividades' => $actividades,
    //                                                                 'nombre_usuario' => $nombre_usuario])->setPaper('a4', 'landscape');
    //     return $pdf->download('imprimir.pdf');

    //     //return response()->json(['respuesta' => 1]);
    // }
}
