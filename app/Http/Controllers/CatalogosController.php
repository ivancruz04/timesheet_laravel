<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Puestos;



class CatalogosController extends Controller
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

    public function index_puestos(){

        $puestos = DB::table('puestos')
                    ->select(DB::raw('id_puesto, descripcion'))
                    ->get();

        return view('catalogos.puestos', ['puestos' => $puestos]);
    }

    public function registrarPuesto(Request $request){
        
        try {
            $puestos = new Puestos();
            $puestos->descripcion = $request->puesto_descripcion;
            $puestos->save();

            if($puestos->save()){
                return response()->json(['respuesta' => 1]);
            }
        } catch (\Throwable $th) {
            return response()->json(array('error' => true, 'respuesta' => 2, 'mensaje' => $th->getMessage(), /* 'Ocurrió un error al enviar el correo', */ 'code' => 500));
        }
    }

    public function eliminarPuesto(Request $request){

        try {
            $eliminar_puesto = DB::table('puestos')
                        ->where('id_puesto', '=', $request->id_puesto)
                        ->delete();

            
                return response()->json([
                    'respuesta' => 1
                ]);
            
        } catch (\Throwable $th) {
                        return response()->json(array('error' => true, 'respuesta' => 2, 'mensaje' => $th->getMessage(), /* 'Ocurrió un error al enviar el correo', */ 'code' => 500));

        }

    }
}
