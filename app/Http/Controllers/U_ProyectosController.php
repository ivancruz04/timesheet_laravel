<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //referencia para hacer operaciones con la clase DB 
use Auth;

class U_ProyectosController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function index(){

        $proyectos_usuario_individual = DB::table('v_proyecto_asignado')
                            ->select('*')
                            ->where('asignado_a', '=', Auth::user()->id)
                            ->get();
        
        $proyectos_usuario_equipo = DB::table('v_proyecto_asignado_equipo')
                            ->select('*')
                            ->where('id_usuario', '=', Auth::user()->id)
                            ->get();

        return view('proyectos.index_proyectos_usuario', [
                                                          'proyectos_usuario_individual' => $proyectos_usuario_individual,
                                                          'proyectos_usuario_equipo' => $proyectos_usuario_equipo
        ]);

    }

    public function verProyecto($idProyecto){

        $proyecto_info = DB::table('proyectos')
                            ->select('*')
                            ->where('id', '=', $idProyecto)
                            ->get();

        foreach ($proyecto_info as $proyecto) {
            $estado = $proyecto->estado;
            $asignado = $proyecto->asignado_a;
        }

 
        //si el campo de asignado individual es nulo o vacio entonces es en equipo
        if($asignado == '' || $asignado == null){
            //consulta a la vista de proyecto individual
            $proyectos_seleccionado = DB::table('v_proyecto_asignado_equipo')
                            ->select('*')
                            ->where('id', '=', $idProyecto)
                            ->limit(1)
                            ->get();

            $miembros_proyecto = DB::table('v_proyecto_asignado_equipo')
                            ->select('*')
                            ->where('id', '=', $idProyecto)
                            ->get();

            $tipo_proyecto = 2; //variable para validar en la vista si es en equipo o individual 1 = individual / 2 = equipo

            return view('proyectos.ver_proyecto_usuario', [
                'proyectos_seleccionado' => $proyectos_seleccionado,
                'estado' => $estado,
                'tipo_proyecto' => $tipo_proyecto,
                'miembros_proyecto' => $miembros_proyecto
                
            ]);
        }else{ //si no es individual
            //consulta a la vista de proyecto en equipo
            $proyectos_seleccionado = DB::table('v_proyecto_asignado')
                            ->select('*')
                            ->where('id', '=', $idProyecto)
                            ->get();
            $tipo_proyecto = 1; //variable para validar en la vista si es en equipo o individual 1 = individual / 2 = equipo

            return view('proyectos.ver_proyecto_usuario', [
                'proyectos_seleccionado' => $proyectos_seleccionado,
                'estado' => $estado,
                'tipo_proyecto' => $tipo_proyecto
                
            ]);
        }
        
        

        

    }
}