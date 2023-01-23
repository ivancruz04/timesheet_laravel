<?php
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyectos; //llamada de referencia a su modelo
use App\Models\User; //llamada de referencia al modelo de usuarios
use App\Models\Actividades; //llamada de referencia al modelo de actividades
use Illuminate\Support\Facades\DB; //referencia para hacer operaciones con la clase DB 
use DateTime;
use Carbon\Carbon;
use App\Mail\correosActividades;
use App\Mail\correosActividadesEquipo;
use App\Mail\correosProyectos;
use App\Mail\correosProyectosEquipo;
use Illuminate\Support\Facades\Mail;

class ProyectosController extends Controller
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

        $date = new DateTime(); // 
        $fecha_actual = $date->format('Y-m-d');  // 

        //consulta para mostrar todos los usuarios existentes en la DB
        $miembros = User::all();

        //consulta para obtener los tipos de prioridad que se pueden asignar a una actividad
        $prioridad_act = DB::table('prioridad_actividad')
        ->select('*')
        ->get();
        
        //consulta para mostrar todos los proyectos
        $proyectos = DB::table('proyectos')
        ->select('*')
        ->get();
        
        //dentro del foreach guarda en la base de datos el estado del proyecto de acuerdo a las fechas establecidas
        foreach($proyectos as $proyecto){
            if($proyecto->fecha_inicio <= $fecha_actual && $proyecto->fecha_finalizacion >= $fecha_actual && $proyecto->estado != 'CAN' && $proyecto->estado != 'FIN'){
                $estado = 'ENC';
                //$proyecto->estado = 'ENC';
                $actualizacion = DB::table('proyectos')
            ->where('id', '=', $proyecto -> id)
            ->update([
                'estado' => $estado,
            ]);

            }else if($proyecto->fecha_inicio < $fecha_actual && $proyecto->fecha_finalizacion < $fecha_actual && $proyecto->estado != 'CAN' && $proyecto->estado != 'FIN'){
                // $proyecto->estado = 'DES';
                $estado = 'DES';
                //$proyecto->estado = 'ENC';
                $actualizacion = DB::table('proyectos')
            ->where('id', '=', $proyecto -> id)
            ->update([
                'estado' => $estado,
            ]);
            }else if($proyecto->estado != 'CAN' && $proyecto->estado != 'FIN'){
                // $proyecto->estado = 'PEN';
                $estado = 'PEN';
                //$proyecto->estado = 'ENC';
                $actualizacion = DB::table('proyectos')
            ->where('id', '=', $proyecto -> id)
            ->update([
                'estado' => $estado,
            ]);
            }
        }

        //consulta para motrar tabla de los proyectos asignados a usuarios en el index
        $proyectos_consulta_usuarios = Proyectos::join("users", "proyectos.asignado_a", "=", "users.id")
                            ->select("proyectos.id",
                                     "proyectos.nombre_proyecto",
                                      "proyectos.fecha_inicio",
                                      "proyectos.fecha_finalizacion",
                                      "proyectos.descripcion",
                                      "users.name",
                                      "proyectos.estado",
                                      "proyectos.fecha_asignacion")
                            ->get();
        
        //consulta para mostrar tabla de los proyectos asignados a equipos en el index
        $proyectos_consulta_equipos = DB::table('proyectos')
                                ->distinct()
                                ->join("equipos", "proyectos.id_equipo", "=", "equipos.id_equipo")
                                ->select("proyectos.id",
                                     "proyectos.nombre_proyecto",
                                      "proyectos.fecha_inicio",
                                      "proyectos.fecha_finalizacion",
                                      "proyectos.descripcion",
                                      "equipos.nombre_equipo",
                                      "proyectos.estado",
                                      "proyectos.fecha_asignacion")
                                ->get();
 
        
        //funcion para que muestre en el select los diferentes equipos que hay registrados
        $equipos = DB::table('equipos')
             ->select(DB::raw('DISTINCT id_equipo, nombre_equipo'))
             ->get();
            //  var_dump($proyectos_consulta);
        return view('proyectos.index_proyectos', [
                                                    'miembros'                      => $miembros,
                                                    'proyectos_consulta_usuarios'   => $proyectos_consulta_usuarios,
                                                    'proyectos_consulta_equipos'    => $proyectos_consulta_equipos,
                                                    'equipos'                       => $equipos,
                                                    'prioridad_act'                 => $prioridad_act
                                                ]);

    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){   
    }

    /** 
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        // var_dump($request);
        //el modelo proyectos es una clase y para ello hacemos una instancia para esa clase
        $proyectos = new Proyectos();
        //en esta variable se almacena el numero de proyectos iguales
        $contador = verificar_si_existe_proyecto($request->nombre);

        if($contador == 0){ // si no hay proyectos con el mismo nombre entonces lo registra
            try {
                //se asigna a la variable proyectos lo que recibe del formulario
                $proyectos  ->nombre_proyecto       = $request  ->nombre; 
                $proyectos  ->fecha_inicio          = $request  ->fecha_ini; 
                $proyectos  ->fecha_finalizacion    = $request  ->fecha_fin; 
                $proyectos  ->descripcion           = $request  ->descripcion; 
                $proyectos  ->asignado_a            = $request  ->asignado_usuario;
                $proyectos  ->id_equipo             = $request  ->asignado_equipo;
                $proyectos  ->fecha_asignacion      = $request  ->fecha_asignacion;
                
                $proyectos->save();

                if($proyectos->save()){
                    if($request->asignado_equipo  == '' || $request->asignado_equipo == null){ //es proyecto individual
                        try {
                            $correo_usuario_individual = DB::table('users')
                                        ->select(DB::raw('name, email'))
                                        ->where('id', '=', $request->asignado_usuario)
                                        ->get();
        
                            foreach ($correo_usuario_individual as $usuario) {
                                $correo = $usuario->email;
                                $nombre_usuario = $usuario->name;
                            }
                            Mail::to($correo)->send(new correosProyectos($request->nombre, $request->descripcion, $request->fecha_ini, $request->fecha_fin, $nombre_usuario));
                             
                            if (count(Mail::failures()) > 0) {
                                return response()->json(array('error' => true, 'respuesta' => 'Ocurrió un error al enviar el correo', 'code' => 200));
                            }
                            //return response()->json(array('error' => false, 'respuesta' => 'Correo enviado correctamente', 'code' => 200));
                            return response()->json([
                                'respuesta' => 1
                            ]);
                        } catch (\Throwable $th) {
                            return response()->json(array('error' => true, 'respuesta' => $th->getMessage(), /* 'Ocurrió un error al enviar el correo', */ 'code' => 500));
                        }//try catch

                    }else{
                        //proyecto en equipo
                        try {
                            $consulta_id_proyecto = DB::table('v_proyecto_asignado_equipo')
                                                        ->select(DB::raw('MAX(id) as id_proyecto'))
                                                        ->get();

                            foreach ($consulta_id_proyecto as $proyecto) {
                                $id_proyecto = $proyecto->id_proyecto;
                            }
                            $correos_usuarios_equipo = DB::table('v_proyecto_asignado_equipo')
                                                        ->select(DB::raw('correo, name, nombre_equipo, nombre_proyecto'))
                                                        ->where('id_equipo', '=', $request->asignado_equipo)
                                                        ->where('id', '=', $id_proyecto)
                                                        ->get();
                            foreach ($correos_usuarios_equipo as $usuario) {
                                    $e_correo   = $usuario->correo;
                                    $e_nombre   = $usuario->name;
                                    $e_equipo   = $usuario->nombre_equipo;
                                    $e_proyecto = $usuario->nombre_proyecto;
                                    //$correos[$index] = $e_correo;
                                    Mail::to($e_correo)->send(new correosProyectosEquipo($request->nombre, $request->descripcion, $request->fecha_ini, $request->fecha_fin, $e_nombre, $e_equipo, $e_proyecto));
                            }
                            if (count(Mail::failures()) > 0) {
                                return response()->json(array('error' => true, 'respuesta' => 'Ocurrió un error al enviar el correo', 'code' => 200));
                            }
                            //return response()->json(array('error' => false, 'respuesta' => 'Correo enviado correctamente', 'code' => 200));
                            return response()->json([
                                'respuesta' => 1
                            ]);
                        } catch (\Throwable $th) {
                            return response()->json(array('error' => true, 'respuesta' => $th->getMessage(), /* 'Ocurrió un error al enviar el correo', */ 'code' => 500));
                        }

                    }
                    
                }
                return response()->json([
                    'respuesta' => 2
                ]);
            } catch (\Throwable $th) {
                return response()->json([
                    'respuesta' => 3
                ]);
            }
       }else{
            return response()->json([
                'respuesta' => 2
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $consulta_actualizacion = DB::table('v_proyecto_asignado')
        ->select('*')
        ->where('id', '=', $id)
        ->get();

        $consulta_responsable_proy = DB::table('v_proyecto_asignado')
        ->select('*')
        ->where('id', '=', $id)
        ->get();

        foreach ($consulta_responsable_proy as $responsable) {
            $asignado = $responsable -> asignado_a;
        }

        
        $otros_miembros = DB::table('users')
                              ->select('*')
                              ->where('id', '!=', $asignado)
                              ->get();

        
    
        return view('proyectos.actualizar_proyectos', ['consulta_actualizacion' => $consulta_actualizacion])->with('otros_miembros',$otros_miembros);
    }

    public function show_equipo($id){
        
        //funcion para traer los datos del proyecto a editar
        $consulta_actualizacion_equipo = DB::table('v_proyecto_asignado_equipo')
        ->select('*')
        ->where('id', '=', $id)
        ->limit(1)
        ->get();


        foreach ($consulta_actualizacion_equipo as $responsable) {
            $asignado = $responsable -> id_equipo;
        }

        //funcion para que muestre en el select los diferentes equipos que hay registrados
        $otros_equipos = DB::table('equipos')
                    ->select(DB::raw('DISTINCT id_equipo, nombre_equipo'))
                    ->where('id_equipo', '!=', $asignado)
                    ->get();

        
        return view('proyectos.actualizar_proyectos_equipo', 
                                                                ['consulta_actualizacion_equipo' => $consulta_actualizacion_equipo,
                                                                 'otros_equipos' => $otros_equipos]); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        return $id;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     //funcion para actualizar proyecto
    public function update(Request $request){

        //consulta para recuperar aquien esta asignado el proyecto antes de actualizar
            $consulta_asignado_anterior = DB::table('proyectos')
                            ->select(DB::raw('asignado_a'))
                            ->where('id', '=', $request->id )
                            ->get();

            foreach ($consulta_asignado_anterior as $usuario_anterior) {
                $id_usuario_anterior = $usuario_anterior->asignado_a;
            }

            //actualizacion de proyecto
            try { 
            $actualizacion = DB::table('proyectos')
                ->where('id', '=', $request -> id)
                ->update([
                    'nombre_proyecto'       => $request -> nombre,
                    'fecha_inicio'          => $request -> fecha_ini,
                    'fecha_finalizacion'    => $request -> fecha_fin,
                    'descripcion'           => $request -> descripcion,
                    'asignado_a'            => $request -> asignado
                ]);
        

                //actualizacion de actividades
                if($actualizacion){

                    $actualizacion_actividades = DB::table('actividades')
                    ->where('id_proyecto', '=', $request -> id)
                    ->where('id_usuario', '=', $id_usuario_anterior)
                    ->update([
                    'id_usuario' => $request -> asignado
                ]);

                    return response()->json([
                        'respuesta' => 1
                    ]);
            }   
            } catch (\Throwable $th) {
                return response()->json([
                    'respuesta' => 2
                ]);
            }
        
    }

    //funcion para actualizar proyecto
    public function update_proyecto_equipo(Request $request){
        
        
        //consulta para recuperar aquien esta asignado el proyecto antes de actualizar
        $consulta_asignado_anterior = DB::table('proyectos')
        ->select(DB::raw('id_equipo'))
        ->where('id', '=', $request->id )
        ->get();

        foreach ($consulta_asignado_anterior as $equipo_anterior) {
        $id_equipo_anterior = $equipo_anterior->id_equipo;
        }
        
        
        try {
            $actualizacion = DB::table('proyectos')
                ->where('id', '=', $request -> id)
                ->update([
                    'nombre_proyecto'       => $request -> nombre,
                    'fecha_inicio'          => $request -> fecha_ini,
                    'fecha_finalizacion'    => $request -> fecha_fin,
                    'descripcion'           => $request -> descripcion,
                    'id_equipo'             => $request -> asignado_eq
                ]);
        
                //actualizacion de actividades
                if($actualizacion){

                    $actualizacion_actividades = DB::table('actividades')
                    ->where('id_proyecto', '=', $request -> id)
                    ->where('id_equipo', '=', $id_equipo_anterior)
                    ->update([
                    'id_equipo' => $request -> asignado_eq
                ]);

                    return response()->json([
                        'respuesta' => 1
                    ]);
            }   
            } catch (\Throwable $th) {
                return response()->json([
                    'respuesta' => 2
                ]);
            }
       
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     //funcion para cancelar el proyecto 
    public function destroy(Request $request){
        $nuevo_estado = 'CAN';
        
        //en esta variable se almacena el estado actual del proyecto
        $estado_proyecto = verificar_estado_proyecto($request->id);

        switch($estado_proyecto){
            case 'ENC':
                    DB::table('proyectos')
                    ->where('id', '=', $request -> id)
                    ->update([
                        'estado' => $nuevo_estado
                    ]);
                    return response()->json([
                        'respuesta' => 1
                     ]);
            break;
            case 'DES':
                DB::table('proyectos')
                ->where('id', '=', $request -> id)
                ->update([
                    'estado' => $nuevo_estado
                ]);
                return response()->json([
                    'respuesta' => 1
                 ]);
            break;
            case 'PEN':
                DB::table('proyectos')
                ->where('id', '=', $request -> id)
                ->update([
                    'estado' => $nuevo_estado
                ]);
                return response()->json([
                    'respuesta' => 1
                 ]);
            break;
            case 'FIN':
                return response()->json([
                    'respuesta' => 2
                 ]);
            break;
            case 'CAN':
                return response()->json([
                    'respuesta' => 3
                ]);
            break;
            default:
                return response()->json([
                    'respuesta' => 4
                ]);
        }
    }

    //Funcion para finalizar el proyecto
    public function finalizarProyecto(Request $request){
        $nuevo_estado = 'FIN';
        //en esta variable se almacena el estado actual del proyecto
        $estado_proyecto = verificar_estado_proyecto($request->id);
        //var_dump($estado_proyecto);

        switch($estado_proyecto){
            case 'ENC': 
                    $query = DB::table('proyectos')
                        ->where('id', '=', $request -> id)
                        ->update([
                            'estado'        => $nuevo_estado,
                            'fecha_entrega' => $request->fecha_fin
                        ]);
                return response()->json([
                            'respuesta' => 1
                ]);
            break;
            case 'DES':
                $query =  DB::table('proyectos')
                        ->where('id', '=', $request -> id)
                        ->update([
                            'estado'        => $nuevo_estado,
                            'fecha_entrega' => $request->fecha_fin
                        ]);
                return response()->json([
                            'respuesta' => 1
                ]);
            break;
            case 'PEN':
                $query =   DB::table('proyectos')
                    ->where('id', '=', $request -> id)
                    ->update([
                        'estado'        => $nuevo_estado,
                        'fecha_entrega' => $request->fecha_fin
                    ]);
            return response()->json([
                        'respuesta' => 1
            ]);
        break;
            case 'FIN':
                return response()->json([
                    'respuesta' => 2
                ]);
            break;

            case 'CAN':
                return response()->json([
                    'respuesta' => 3
                ]);
            break;
            default:
                return response()->json([
                    'respuesta' => 4
                ]);
        }
        
    }

    public function asignarActividad(Request $request){
        
        //consulta para recuperar a que usuario o equipo esta asignado el proyecto
        $asignado = DB::table('proyectos')
             ->select('*')
             ->where('id', '=', $request->idProyecto)
             ->get();
        
        foreach ($asignado as $quien) {
            $id_usuario = $quien->asignado_a;
            $id_equipo  = $quien->id_equipo;
        }

        //funcion para verificar si la fecha fin de la actividad sea mayor a la fecha de asignacion
        //retorna true/false
        $fecha_valida = validarFechas($request->fecha_fin);


         //el modelo proyectos es una clase y para ello hacemos una instancia para esa clase
         $actividades = new Actividades();
         //si la fecha fin es valida entonces inserta
        if ($fecha_valida == true) {
            try {
                //se asigna a la variable proyectos lo que recibe del formulario
                $actividades    ->nombre_actividad = $request->nombre;
                $actividades    ->descripcion      = $request->descripcion;
                $actividades    ->fecha_asignacion = $request->fecha_asig;
                $actividades    ->fecha_fin        = $request->fecha_fin;
                $actividades    ->id_usuario       = $id_usuario; 
                $actividades    ->id_equipo        = $id_equipo;
                $actividades    ->id_proyecto      = $request->idProyecto;
                $actividades    ->id_prioridad     = $request->prioridad;
                $actividades    ->estado = 'PEN'; 

                $actividades->save();
                
                if($actividades->save()){

                    //correoActividadNueva($request->nombre, $request->descripcion, $request->fecha_asig,  $request->fecha_fin, $request->id_usuario, $request->id_equipo);
   
                    if($id_equipo  == '' || $id_equipo == null){
                        //es actividad individual
                            try {
                                $correo_usuario_individual = DB::table('users')
                                            ->select(DB::raw('name, email'))
                                            ->where('id', '=', $id_usuario)
                                            ->get();
            
                                foreach ($correo_usuario_individual as $usuario) {
                     
                                    $correo         = $usuario->email;
                                    $nombre_usuario = $usuario->name;
                                }
                                Mail::to($correo)->send(new correosActividades($request->nombre, $request->descripcion, $request->fecha_asig, $request->fecha_fin, $nombre_usuario));
                                // return response()->json([
                                //     'respuesta' => Mail::failures()
                                // ]);
                                if (count(Mail::failures()) > 0) {
                                    return response()->json(array('error' => true, 'respuesta' => 'Ocurrió un error al enviar el correo', 'code' => 200));
                                }
                                //return response()->json(array('error' => false, 'respuesta' => 'Correo enviado correctamente', 'code' => 200));
                            
                                return response()->json([
                                    'respuesta' => 1
                                ]);
                            } catch (\Throwable $th) {
                                return response()->json(array('error' => true, 'respuesta' => $th->getMessage(), /* 'Ocurrió un error al enviar el correo', */ 'code' => 500));
                            }//try catch
                    }else{
                        //es en equipo
                        try {
                            $consulta_id_actividad = DB::table('v_actividades_equipos')
                                                        ->select(DB::raw('MAX(id_actividad) as id_actividad'))
                                                        ->get();

                            foreach ($consulta_id_actividad as $actividad) {
                                $id_actividad = $actividad->id_actividad;
                            }
                            //return response()->json([ 'respuesta' => $id_actividad]);
                            $correos_usuarios_equipo = DB::table('v_actividades_equipos')
                                                        ->select(DB::raw('correo, name, nombre_equipo, nombre_proyecto'))
                                                        ->where('id_equipo', '=', $id_equipo)
                                                        ->where('id_actividad', '=', $id_actividad)
                                                        ->get();

                            foreach ($correos_usuarios_equipo as $usuario) {
                            
                                    $e_correo   = $usuario->correo;
                                    $e_nombre   = $usuario->name;
                                    $e_equipo   = $usuario->nombre_equipo;
                                    $e_proyecto = $usuario->nombre_proyecto;

                                    Mail::to($e_correo)->send(new correosActividadesEquipo($request->nombre, $request->descripcion, $request->fecha_asig,
                                                                                             $request->fecha_fin, $e_nombre, $e_equipo, $e_proyecto ));
                            }
                            //return response()->json([ 'respuesta' => $correos]);
                            
                            
                            
                            if (count(Mail::failures()) > 0) {
                                return response()->json(array('error' => true, 'respuesta' => 'Ocurrió un error al enviar el correo', 'code' => 200));
                            }
                            //return response()->json(array('error' => false, 'respuesta' => 'Correo enviado correctamente', 'code' => 200));
                        
                            return response()->json([
                                'respuesta' => 1
                            ]);
                        } catch (\Throwable $th) {
                            return response()->json(array('error' => true, 'respuesta' => $th->getMessage(), /* 'Ocurrió un error al enviar el correo', */ 'code' => 500));
                        }
                                

                    }

                }//llave if save

                return response()->json([
                    'respuesta' => 2
                ]);
                
            } catch (\Throwable $th) {
                return response()->json([
                    'respuesta' =>$th
                ]);
            }
        } else {
            return response()->json([
                'respuesta' => 3
            ]);
        }//llave del else de validacion de fechas

    }

    

}//llave de la clase principal

//esta funcion consulta el estado del proyecto seleccionado
 function verificar_estado_proyecto($id_proyecto){
    //validar estatus del proyecto
    $consulta_estado = DB::table('proyectos')
    ->select('estado')
    ->where('id', '=', $id_proyecto)
    ->get();

    foreach ($consulta_estado as $estado) {
        return $estado->estado;
    }
}

function verificar_si_existe_proyecto($nombre_proyecto){
    
    $proyectos_iguales = DB::table('proyectos')
                ->select(DB::raw('count(*) as contador'))
                ->where('nombre_proyecto', '=', $nombre_proyecto)
                ->get();

    foreach ($proyectos_iguales as $contador) {
        return $contador->contador;
    }
    
}

//funcion que valida si las fechas de asignacion y fin son validas
function validarFechas($fecha_final){
    
    $ahora = Carbon::now('America/Mexico_City');
    $ahora->toDateTimeString();//se convierte a string

    if($fecha_final >= $ahora){
        return true;
    }else{
        return false;
    }

}