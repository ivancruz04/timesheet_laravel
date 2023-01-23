<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipos; //llamada de referencia a su modelo
use App\Models\User; //llamada de referencia al modelo de usuarios
use Illuminate\Support\Facades\DB; //referencia para hacer operaciones con la clase DB
use DateTime;
use App\Mail\correosEquipoNuevo;
use Illuminate\Support\Facades\Mail;


 
class EquiposController extends Controller
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
     *  Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $miembros = DB::table('v_usuarios_puestos')
        ->select('*')
        ->get();

        $equipos = DB::table('equipos')
                ->select(DB::raw('DISTINCT(id_equipo), nombre_equipo, descripcion'))
                ->get();

        return view('equipos.index_equipos', [
                                                'miembros' => $miembros,
                                                'equipos' => $equipos
                                                ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //el modelo equipos es una clase y para ello hacemos una instancia para esa clase
        $equipos = new Equipos();
        //en esta variable se almacena el numero de equipos iguales
        $contador = verificar_si_existe_equipo($request->nombre);
        
        $nuevo_id = siguiente_id_equipo();

         if($contador == 0){ // si no hay proyectos con el mismo nombre entonces lo registra
            try {
                    // $longitud = count($request->seleccionados);
                    foreach($request->seleccionados as $usuario){
                        //se asigna a la variable equipos lo que recibe del formulario
                        $insertar_miembro = DB::table('equipos')->insert([
                            'id_equipo' => $nuevo_id,
                            'nombre_equipo' => $request->nombre,
                            'descripcion' => $request->descripcion,
                            'id_usuario' => $usuario
                        ]);
                    }//llave del foreach de insersion
                        if($insertar_miembro){
                            $datos_miembro = DB::table('v_equipos_usuarios')
                                        ->select(DB::raw('name, correo, nombre_equipo, descripcion'))
                                        ->where('id_equipo', '=', $nuevo_id)
                                        //->where('id_usuario', '=', $usuario)
                                        ->get();

                            foreach ($datos_miembro as $miembro) {
                                $e_nombre_miembro = $miembro->name;
                                $e_correo = $miembro->correo;
                                $e_equipo = $miembro->nombre_equipo;
                                $e_descripcion = $miembro->descripcion;

                                Mail::to($e_correo)->send(new correosEquipoNuevo($e_nombre_miembro, $e_equipo, $e_descripcion));
                            }
                            return response()->json([
                                'respuesta' => 1
                            ]);
                            
                        }//llave if insertar

                        if (count(Mail::failures()) > 0) {
                            return response()->json(array('error' => true, 'respuesta' => 'Ocurrió un error al enviar el correo', 'code' => 200));
                        }
                        return response()->json([
                            'respuesta' => 1
                        ]);
                    //return response()->json(array('error' => false, 'respuesta' => 'Correo enviado correctamente', 'code' => 200));
                //  return response()->json([
                //     'respuesta' => 2
                // ]);
            } catch (\Throwable $th) {
                 return response()->json([
                     'respuesta' => $th
                 ]);
            }
            return response()->json([
                'respuesta' => 1
            ]);
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
    public function eliminarMiembro(Request $request)
    {
        try {
            $eliminar_miembro = DB::delete('DELETE FROM equipos WHERE id_equipo = ? AND id_usuario = ?', [$request->id_equipo, $request->id_usuario]);

            return response()->json([
                'respuesta' => 1 
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'respuesta' => $th
            ]);
        }
    }

    public function destroy(Request $request){
        try {
            $eliminar_equipo = DB::table('equipos')
                        ->where('id_equipo', '=', $request->id_equipo)
                        ->delete();

            return response()->json([
                'respuesta' => 1
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'respuesta' => $th
            ]);
        }
    }

    
    public function verActualizarEquipo($idEquipo){
        try {
            $consulta_miembros_equipo = DB::table('v_equipos_usuarios')
                ->select('*')
                ->where('id_equipo', '=', $idEquipo)
                ->get();

        } catch (\Throwable $th) {
            dd($th);
        }
        $miembros_fuera_equipo = DB::select('SELECT * FROM 
                                            v_usuarios_puestos 
                                            WHERE NOT EXISTS 
                                            (SELECT * FROM equipos WHERE equipos.id_usuario = v_usuarios_puestos.id AND id_equipo = ?)', [$idEquipo]);

        return view('equipos.miembros_equipos', ["consulta_miembros_equipo" => $consulta_miembros_equipo,
                                                 "id_equipo" => $idEquipo,
                                                 "miembros_fuera_equipo" => $miembros_fuera_equipo]);
    }

    public function agregarOtroMiembro(Request $request){
            $consulta_datos_equipo = DB::table('equipos')
                                    ->select('*')
                                    ->where('id_equipo', '=', $request->id_equipo)
                                    ->get();
            
            foreach ($consulta_datos_equipo as $datos_equipo) {
                $nombre_equipo = $datos_equipo->nombre_equipo;
                $descripcion = $datos_equipo->descripcion;
            }
            try {
                // $longitud = count($request->seleccionados);
                 foreach($request->seleccionados as $usuario){
                //se asigna a la variable equipos lo que recibe del formulario
                DB::table('equipos')->insert([
                    'id_equipo' => $request->id_equipo,
                    'nombre_equipo' => $nombre_equipo,
                    'descripcion' => $descripcion,
                    'id_usuario' => $usuario
                ]);
                }
                 return response()->json([
                    'respuesta' => 1
                ]);
            } catch (\Throwable $th) {
                 return response()->json([
                     'respuesta' => $th
                 ]);
            }
    }
}

//Verifica si existe un equipo con el mismo nombre
function verificar_si_existe_equipo($nombre_equipo){
    $equipos_iguales = DB::table('equipos')
                ->select(DB::raw('count(*) as contador'))
                ->where('nombre_equipo', '=', $nombre_equipo)
                ->get();

    foreach ($equipos_iguales as $contador) {
        return $contador->contador;
    }
}

function siguiente_id_equipo(){
    $numero_equipos = DB::table('equipos')
                ->select(DB::raw('MAX(id_equipo) as contador'))
                ->get();

    foreach ($numero_equipos as $numero) {
        $cuantos = $numero->contador;
    }
    if($cuantos == 0){
        $id = 1;
        return $id;
    }else{
        $id = $cuantos + 1;
        return $id;
    }
}
