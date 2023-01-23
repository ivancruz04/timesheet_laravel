<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //referencia para hacer operaciones con la clase DB 
use App\Models\Home; //llamada de referencia a su modelo
use Carbon\Carbon; //importacion de la libreria de Carbon para las fechas
use DateTime;
use App\Mail\PruebaCorreo;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
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
        $date = new DateTime(); // 2020-02-19 11:58:41.564592 
        $fecha_actual = $date->format('Y-m-d');  // 2020-02-19

        $proyectos_en_curso = DB::table('proyectos')
                ->select(DB::raw('count(*) as en_curso'))
                ->where('fecha_inicio', '<=', $fecha_actual)
                ->where('fecha_finalizacion', '>=', $fecha_actual)
                ->where('estado', '!=', 'CAN')
                ->where('estado', '!=', 'DES')
                ->where('estado', '!=', 'FIN')
                ->get();
        $proyectos_terminados = DB::table('proyectos')
                ->select(DB::raw('count(*) as terminados'))
                ->where('estado', '=', 'FIN')
                ->get();
        $proyectos_atrasados = DB::table('proyectos')
                ->select(DB::raw('count(*) as atrasados'))
                ->where('fecha_finalizacion', '<', $fecha_actual)
                ->where('estado', '!=', 'FIN')
                ->where('estado', '!=', 'CAN')
                ->get();
        $proyectos_cancelados = DB::table('proyectos')
                ->select(DB::raw('count(*) as cancelados'))
                ->where('estado', '=', 'CAN')
                ->get();        
        $proyectos_registrados = DB::table('proyectos')
                ->select(DB::raw('count(*) as registrados'))
                ->where('estado', '!=', 'CAN')
                ->where('estado', '!=', 'FIN')
                ->get();
        $usuarios_registrados = DB::table('users')
                ->select(DB::raw('count(*) as usuarios_registrados'))
                ->get();
        $equipos_registrados = DB::table('equipos')
                ->select(DB::raw('COUNT(DISTINCT(id_equipo)) as equipos_registrados'))
                ->get();

        return view('inicio.tablero', [
                                        'proyectos_en_curso' => $proyectos_en_curso,
                                        'proyectos_terminados' => $proyectos_terminados,
                                        'proyectos_atrasados' => $proyectos_atrasados,
                                        'proyectos_cancelados' => $proyectos_cancelados,
                                        'usuarios_registrados' => $usuarios_registrados,
                                        'proyectos_registrados' => $proyectos_registrados,
                                        'equipos_registrados' => $equipos_registrados
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

    public function enviarCorreo(Request $request){
        try{
            $nombreActividad = 'actividad de prueba';
            $descripcionActividad = 'prueba desde home';
            $asigActividad = 'hoy';
            $finActividad = 'manana';

            $correo_usuario = DB::table('users')
                            ->select(DB::raw('email'))
                            ->where('id', '=', $request->id_usuario)
                            ->get();

            foreach ($correo_usuario as $usuario) {
                $correo = $usuario->email;
            }

            Mail::to($correo)->send(new PruebaCorreo($nombreActividad, $descripcionActividad, $asigActividad, $finActividad));

            return response()->json([
                'respuesta' => Mail::failures()
            ]);

            if (count(Mail::failures()) > 0) {
                return response()->json(array('error' => true, 'respuesta' => 'Ocurrió un error al enviar el correo', 'code' => 200));
            }
            return response()->json(array('error' => false, 'respuesta' => 'Correo enviado correctamente', 'code' => 200));


        } catch (\Throwable $th) {
              return response()->json(array('error' => true, 'respuesta' => $th->getMessage(), /* 'Ocurrió un error al enviar el correo', */ 'code' => 500));
        }
        
                            
    }
}