<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //referencia para hacer operaciones con la clase DB 
use Auth;
use App\Models\Comentarios; //llamada de referencia al modelo de comentarios



class ForoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idAct)
    {

        $comentarios = DB::table('v_comentario_general')
                     ->select('*')
                     ->where('id_actividad', '=', $idAct)
                     ->get();

        $num_comentarios = DB::table('v_comentario_general')
                     ->select(DB::raw('COUNT(id_comentario) as numero'))
                     ->where('id_actividad', '=', $idAct)
                     ->get();

        foreach ($num_comentarios as $total) {
            $num_com = $total->numero;
        }

        $quien_sesion = Auth::user()->id;

        return view('blogs.index_foro', ['idAct'            => $idAct,
                                         'comentarios'      => $comentarios,
                                         'num_com'          => $num_com,
                                         'quien_sesion'     => $quien_sesion
        ]);
    }

    public function guardarComentario(Request $request){

        return response()->json(['respuesta' => $request->hora]);
        
        // try {
        //     $comentarios = new Comentarios();

        //     $comentario ->id_actividad = $request->id_actividad;
        //     $comentario ->id_usuario   = $request->id_usuario;
        //     $comentario ->descripcion  = $request->descripcion;
        //     $comentario ->fecha        = $request->fecha;
        //     $comentario ->hora         = $request->hora;
        //     $comentario ->save();

        //     if($comentario->save()){
        //         return response()->json(['respuesta' => 1]);
        //     }
        // } catch (\Throwable $th) {
            
        //     return response()->json(array('error' => true, 'respuesta' => $th->getMessage(), /* 'Ocurrió un error al enviar el correo', */ 'code' => 500));

        // }
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blogs.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'titulo' => 'required',
            'contenido' => 'required'
        ]);
        Blog::create($request->all());
        return redirect()->route('blogs.index');
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
    public function edit(Blog $blog)
    {
         return view('blogs.editar', compact('blog'));     
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        request()->validate([
            'titulo' => 'required',
            'contenido' => 'required'
        ]);

        $blog->update($request->all());
        return redirect()->route('blogs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $blog ->delete();
        return redirect()->route('blogs.index');
    }
}
