<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Miembros; //llamada de referencia a su modelo
use App\Models\User; //llamada de referencia al modelo de usuarios
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Hash;
use DateTime;



class MiembrosController extends Controller
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
    public function index()
    { 
        $puestos = DB::table('puestos')
                    ->select('*')
                    ->get();

        $miembros = User::join("puestos", "puestos.id_puesto", "=", "users.id_puesto")
                            ->select("users.id", "users.name", "users.email", "puestos.descripcion")
                            ->get();

        $roles = DB::table('roles')
                    ->select('*')
                    ->get();

        return view('miembros.index_miembros' , [
                                                 'puestos'  => $puestos,
                                                 'miembros' => $miembros,
                                                 'roles'    => $roles           
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
        $miembro = new User();

        try {
            $miembro    ->  name        = $request->nombre;
            $miembro    ->  email       = $request->correo;
            $miembro    ->  password    =  Hash::make($request->contra);
            $miembro    ->  id_puesto   = $request->puesto;
            $miembro    ->  id_puesto   = $request->puesto;
            $miembro    ->  assignRole($request->rol);
            $miembro    ->  save();

            return response()->json([
                'respuesta' => 1
            ]);
        } catch (\Throwable $th) {
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
    //no se utiliza esta funcion
    public function show($id)
    {
        $consulta_actualizacion = DB::table('v_usuarios_puestos')
        ->select('*')
        ->where('id', '=', $id)
        ->get();
        
        return view('miembros.actualizar_miembro');
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
    public function update(Request $request)
    {
        try {
            $actualizacion_usuario = DB::table('users')
                ->where('id', '=', $request -> id)
                ->update([
                    'name'      => $request -> name,
                    'email'     => $request -> email,
                    'id_puesto' => $request -> id_puesto
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    { 
        // return response()->json([
        //                 'respuesta' => $request->id_usuario
        //             ]);
 
        

        
    }

    
    public function consultarMiembro(Request $request){

        try {
            $consulta_miembro = DB::table('v_usuarios_puestos')
             ->select('*')
             ->where('id', '=', $request->id_usuario)
             ->get();

             foreach ($consulta_miembro as $c_miembro) {
                    $miembro_consulta = [
                        "id"                 => $c_miembro->id,
                        "name"               => $c_miembro->name,
                        "email"              => $c_miembro->email,
                        "contra"             => $c_miembro->contraseña,
                        "id_puesto"          => $c_miembro->id_puesto,
                        "descripcion_puesto" => $c_miembro->descripcion_puesto
                    ];       
                    return response()->json([
                        'respuesta' =>  $miembro_consulta 
                    ]);    
                }
                
            } catch (\Throwable $th) {
                return response()->json([
                    'respuesta' =>  $th 
                ]);
            }
    }
 
    public function eliminarMiembro(Request $request){

        //verificarProyectos($request->id_usuario);

        try {
            $eliminar_usuario = DB::delete('delete from users where id = ?',[$request->id_usuario]);
            
            if($eliminar_usuario){
                return response()->json([
                    'respuesta' => 1
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'respuesta' => $th
            ]);
        }
    }

}



