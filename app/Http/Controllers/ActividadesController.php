<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Proyectos; //llamada de referencia a su modelo
use App\Models\User; //llamada de referencia al modelo de usuarios
use App\Models\Actividades; //llamada de referencia al modelo de actividades
use Illuminate\Support\Facades\DB; //referencia para hacer operaciones con la clase DB 
use DateTime;
use Carbon\Carbon;


class ActividadesController extends Controller
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
     * 
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $proyectos = DB::table('proyectos')
        //     ->select('*')
        //     ->get();

        $act_individuales = DB::table('v_actividades_individuales')
                ->select('*')
                ->get();
        $act_equipo = DB::table('v_actividades_equipos')
                ->select('*')
                ->get();

        return view('actividades.index_actividades', [
                                                        'act_individuales' => $act_individuales,
                                                        'act_equipo'       => $act_equipo
                                                     ]);
    }

    public function asignarActividad(Request $request){
        
        $hecho = 0;

        //funcion para verificar si la fecha fin de la actividad sea mayor a la fecha de asignacion
        //retorna true/false
        $fecha_valida = validarFechas($request->fecha_fin);

         //el modelo actividades es una clase y para ello hacemos una instancia para esa clase
        $actividades = new Actividades();
        //  //si la fecha fin es valida entonces inserta
        if ($fecha_valida == true) {
            try {
                //se asigna a la variable proyectos lo que recibe del formulario
                $actividades    ->  nombre_actividad = $request->nombre;
                $actividades    ->  descripcion      = $request->descripcion;
                $actividades    ->  fecha_asignacion = $request->fecha_asig; 
                $actividades    ->  fecha_fin        = $request->fecha_fin;
                $actividades    ->  id_usuario       = $request->id_usuario; 
                $actividades    ->  id_equipo        = $request->id_equipo;
                $actividades    ->  id_prioridad     = $request->prioridad;
                $actividades    ->  estado           = 'PEN'; 

                $actividades->save();


                $hecho = 1;

                return response()->json([
                    'respuesta' => 1
                ]);
            } catch (\Throwable $th) {
                return response()->json([
                    'respuesta' =>$th
                ]);
            }
        } else {
            return response()->json([
                'respuesta' => 2
            ]);
        }

        if($hecho == 1){
            //enviar correo
            correoActividadNueva($request->nombre, $request->descripcion, $request->fecha_asig,  $request->fecha_fin, $request->id_usuario, $request->id_equipo);
        }
    }

    public function consultarActividades(Request $request){

        //consulta para recuperar a que usuario o equipo esta asignado el proyecto
        $asignado = DB::table('proyectos')
             ->select('*')
             ->where('id', '=', $request->id_proyecto)
             ->get();
        
        foreach ($asignado as $quien) {
            $id_usuario = $quien->asignado_a;
            $id_equipo = $quien->id_equipo;
        }

        //si el el campo id_usuario de la tabla proyecto esta vacio entonces el proyecto esta asignado a un equipo
        if($id_usuario == '' || $id_usuario == null){
            //asignado a equipo
            $actividad_usuario_equipo = DB::table('v_actividades_equipos')
                            ->select(DB::raw('DISTINCT(id_actividad), nombre_actividad, descripcion, fecha_asignacion, 
                            fecha_fin, fecha_inicio, fecha_entrega, estado, descripcion_larga, nombre_equipo, nombre_proyecto'))
                            ->where('id_proyecto', '=', $request->id_proyecto)
                            ->get();

            $tipo_actividad = 2; //actividad en equipo es 2
            return response()->json([
                                    'datos'          => $actividad_usuario_equipo,
                                    'tipo_actividad' => $tipo_actividad

            ]);

        }else{
            //asignado a usuario
            $actividad_usuario_individual = DB::table('v_actividades_individuales')
                            ->select('*')
                            ->where('id_proyecto', '=', $request->id_proyecto)
                            ->get();

            $tipo_actividad = 1; //actividad en equipo es 1
            

            return response()->json([
                                    'datos'          => $actividad_usuario_individual,
                                    'tipo_actividad' => $tipo_actividad
            ]);

        }

    }

    public function correoActividadNueva($nombreActividad, $descripcionActividad, $asigActividad, $finActividad, $idUsuario, $idEquipo){

        $correos = [];

        if($idUsuario  == '' || $idUsuario == null){
            //es actividad en equipo
            $correo_usuario_equipo = DB::table('v_equipos_usuarios')
                                ->select(DB::raw('id_usuario, name, correo'))
                                ->where('id_equipo', '=', $idEquipo)
                                ->get();
            
            foreach ($correo_usuario_equipo as $i => $usuario) {

                $correos[i] = $usuario->correo;
            }


        }else{
            //es actividad individual

            $correo_usuario_individual = DB::table('users')
                                ->select(DB::raw('email'))
                                ->where('id', '=', $idUsuario)
                                ->get();

            foreach ($correo_usuario_individual as $usuario) {

                $correo = $usuario->email;
            }
            
            Mail::to($correo)->send(new PruebaCorreo($nombreActividad, $descripcionActividad, $asigActividad, $finActividad));
                            
        }



    }

}

function validarFechas($fecha_final){
    
    $ahora = Carbon::now('America/Mexico_City');
    $ahora->toDateTimeString();//se convierte a string

    if($fecha_final >= $ahora){
        return true;
    }else{
        return false;
    }

}