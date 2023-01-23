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

class U_ActividadesController extends Controller
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

        //obtener fecha y hora actual ("Y-m-d h:i:s") con la libreria carbon
        $ahora = Carbon::now('America/Mexico_City');
        $ahora->toDateTimeString();//se convierte a string
 

        //consulta para obtener todos los proyectos
        $actividades = DB::table('actividades')
        ->select('*')
        ->get();

        //dentro del foreach se iteran todas las actividades para validar tiempos y asignarles su estatus
         foreach ($actividades as $actividad) {

            $fecha_asig =  strval($actividad->fecha_asignacion);
            $fecha_fin = strval($actividad->fecha_fin);
            
            
            if($fecha_asig <= $ahora && $fecha_fin >= $ahora && $actividad->estado != 'ENC' && $actividad->estado != 'FIN'){
                $estado = 'PEN';
                    $actualizacion = DB::table('actividades')
                    ->where('id_actividad', '=', $actividad -> id_actividad)
                    ->update([
                            'estado' => $estado,
                ]);
            }else if($actividad->estado != 'ENC' && $actividad->estado != 'FIN' && $actividad->estado == 'PEN' && $ahora > $fecha_fin){
                $estado = 'DES';
                    $actualizacion = DB::table('actividades')
                        ->where('id_actividad', '=', $actividad -> id_actividad)
                        ->update([
                                'estado' => $estado,
                    ]);
                    
            }else{
                
            }
         }
        //consultas para actividades individuales del usuario en sesion
        $atrasadas = DB::table('actividades')
             ->select('*')
             ->where('estado', '=', 'DES')
             ->where('id_usuario', '=', Auth::user()->id)
             ->get();

        $pendientes = DB::table('actividades')
             ->select('*')
             ->where('estado', '=', 'PEN')
             ->where('id_usuario', '=', Auth::user()->id)
             ->get();
        
        $haciendo = DB::table('actividades')
             ->select('*')
             ->where('estado', '=', 'ENC')
             ->where('id_usuario', '=', Auth::user()->id)
             ->get();

        $finalizadas = DB::table('actividades')
             ->select('*')
             ->where('estado', '=', 'FIN')
             ->where('id_usuario', '=', Auth::user()->id)
             ->get();

        //consultas para actividades en equipo del usuario en sesion
        $atrasadas_equipo = DB::table('v_actividades_equipos')
             ->select('*')
             ->where('estado', '=', 'DES')
             ->where('id_usuario', '=', Auth::user()->id)
             ->get();

        $pendientes_equipo = DB::table('v_actividades_equipos')
             ->select('*')
             ->where('estado', '=', 'PEN')
             ->where('id_usuario', '=', Auth::user()->id)
             ->get();
        
        $haciendo_equipo = DB::table('v_actividades_equipos')
             ->select('*')
             ->where('estado', '=', 'ENC')
             ->where('id_usuario', '=', Auth::user()->id)
             ->get();

        $finalizadas_equipo = DB::table('v_actividades_equipos')
             ->select('*')
             ->where('estado', '=', 'FIN')
             ->where('id_usuario', '=', Auth::user()->id)
             ->get();

        return view('actividades.index_actividades_usuario', [
                                                        'atrasadas' => $atrasadas,
                                                        'pendientes' => $pendientes,
                                                        'haciendo' => $haciendo,
                                                        'finalizadas' => $finalizadas,
                                                        'atrasadas_equipo' => $atrasadas_equipo,
                                                        'pendientes_equipo' => $pendientes_equipo,
                                                        'haciendo_equipo' => $haciendo_equipo,
                                                        'finalizadas_equipo' => $finalizadas_equipo
                                                     ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //consulta la actividad individual del kanban
    public function consultar_actividad_individual(Request $request){

        try {
            $consulta_actividad = DB::table('v_actividades_individuales')
             ->select('*')
             ->where('id_actividad', '=', $request->id_actividad)
             ->get();

             foreach ($consulta_actividad as $actividad) {
            
                if($actividad->fecha_inicio == '' && $actividad->fecha_entrega == ''){
                    $actividad_individual = [
                        "id_actividad" => $actividad->id_actividad,
                        "nombre_actividad" => $actividad->nombre_actividad,
                        "descripcion" => $actividad->descripcion,
                        "fecha_asignacion" => $actividad->fecha_asignacion,
                        "fecha_fin" => $actividad->fecha_fin,
                        "fecha_inicio" => 'Sin Iniciar',
                        "fecha_entrega" => 'Sin Entregar',
                        "estado" => $actividad->estado,
                        "id_prioridad" => $actividad->id_prioridad,
                        "descripcion_larga" => $actividad->descripcion_larga,
                        "id_usuario" => $actividad->id_usuario,
                        "name" => $actividad->name,
                        "id_proyecto" => $actividad->id_proyecto,
                        "nombre_proyecto" => $actividad->nombre_proyecto
                    ];
                }else{
                    $actividad_individual = [
                        "id_actividad" => $actividad->id_actividad,
                        "nombre_actividad" => $actividad->nombre_actividad,
                        "descripcion" => $actividad->descripcion,
                        "fecha_asignacion" => $actividad->fecha_asignacion,
                        "fecha_fin" => $actividad->fecha_fin,
                        "fecha_inicio" => $actividad->fecha_inicio,
                        "fecha_entrega" => $actividad->fecha_entrega,
                        "estado" => $actividad->estado,
                        "id_prioridad" => $actividad->id_prioridad,
                        "descripcion_larga" => $actividad->descripcion_larga,
                        "id_usuario" => $actividad->id_usuario,
                        "name" => $actividad->name,
                        "id_proyecto" => $actividad->id_proyecto,
                        "nombre_proyecto" => $actividad->nombre_proyecto
                    ];
                }
                
            }
            
            return response()->json([
                'respuesta' =>  $actividad_individual 
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'respuesta' =>  $th 
            ]);
        }
    }

    public function consultar_actividad_equipo(Request $request){
        try {
            $consulta_actividad = DB::table('v_actividades_equipos')
             ->select('*')
             ->where('id_actividad', '=', $request->id_actividad)
             ->get();

             foreach ($consulta_actividad as $actividad) {
            
                if($actividad->fecha_inicio == '' && $actividad->fecha_entrega == ''){

                $actividad_equipo = [
                    "id_actividad" => $actividad->id_actividad,
                    "nombre_actividad" => $actividad->nombre_actividad,
                    "descripcion" => $actividad->descripcion,
                    "fecha_asignacion" => $actividad->fecha_asignacion,
                    "fecha_fin" => $actividad->fecha_fin,
                    "fecha_inicio" => 'Sin Iniciar',
                    "fecha_entrega" => 'Sin Entregar',
                    "estado" => $actividad->estado,
                    "id_prioridad" => $actividad->id_prioridad,
                    "descripcion_larga" => $actividad->descripcion_larga,
                    "id_equipo" => $actividad->id_equipo,
                    "nombre_equipo" => $actividad->nombre_equipo,
                    "id_proyecto" => $actividad->id_proyecto,
                    "nombre_proyecto" => $actividad->nombre_proyecto
                ];
            }else{
                $actividad_equipo = [
                    "id_actividad" => $actividad->id_actividad,
                    "nombre_actividad" => $actividad->nombre_actividad,
                    "descripcion" => $actividad->descripcion,
                    "fecha_asignacion" => $actividad->fecha_asignacion,
                    "fecha_fin" => $actividad->fecha_fin,
                    "fecha_inicio" => $actividad->fecha_inicio,
                    "fecha_entrega" => $actividad->fecha_entrega,
                    "estado" => $actividad->estado,
                    "id_prioridad" => $actividad->id_prioridad,
                    "descripcion_larga" => $actividad->descripcion_larga,
                    "id_equipo" => $actividad->id_equipo,
                    "nombre_equipo" => $actividad->nombre_equipo,
                    "id_proyecto" => $actividad->id_proyecto,
                    "nombre_proyecto" => $actividad->nombre_proyecto
                ];
            }
            
                return response()->json([
                    'respuesta' =>  $actividad_equipo 
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'respuesta' =>  $th 
            ]);
        }
    }

    public function IniciarActividad(Request $request){

        

        try {
            $actividades = new Actividades();
            $estado = 'ENC';

            $actualizacion = DB::table('actividades')
            ->where('id_actividad', '=', $request->id_actividad)
            ->update([
                'estado' => $estado,
                'fecha_inicio' => $request->fecha_inicio
            ]);

            return response()->json([
                'respuesta' => 1
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'respuesta' => 2
            ]);
        }
    }

    public function FinalizarActividad(Request $request){
        try {
            $actividades = new Actividades();
            $estado = 'FIN';

            $fecha_fin_asignada = DB::table('actividades')
            ->select(DB::raw('fecha_fin'))
            ->where('id_actividad', '=', $request->id_actividad)
            ->get();

            foreach ($fecha_fin_asignada as $actividad) {
                $fecha_fin = $actividad->fecha_fin;
            }

            if($request->fecha_entrega > $fecha_fin){

                $actualizacion = DB::table('actividades')
                ->where('id_actividad', '=', $request->id_actividad)
                ->update([
                    'estado' => $estado,
                    'fecha_entrega' => $request->fecha_entrega,
                    'estado_entrega' => 'RETARDO'
                ]);

            }else{
                $actualizacion = DB::table('actividades')
                ->where('id_actividad', '=', $request->id_actividad)
                ->update([
                    'estado' => $estado,
                    'fecha_entrega' => $request->fecha_entrega,
                    'estado_entrega' => 'A-TIEMPO'
                ]);
            }

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


