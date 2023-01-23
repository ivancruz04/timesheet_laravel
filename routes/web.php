<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;

//controladores
 use App\Http\Controllers\HomeController;
 use App\Http\Controllers\RolController;
 use App\Http\Controllers\UsuarioController;
 use App\Http\Controllers\BlogController;
 use App\Http\Controllers\MiembrosController;
 use App\Http\Controllers\ProyectosController;
 use App\Http\Controllers\ActividadesController;
 use App\Http\Controllers\EquiposController;
 use App\Http\Controllers\Auth\RegisterController;
 use App\Http\Controllers\Auth\LoginController;
 use App\Http\Controllers\Auth\LogoutController;
 
 use App\Http\Controllers\ForoController;
 use App\Http\Controllers\CatalogosController;



 use App\Http\Controllers\BienvenidoController;
 use App\Http\Controllers\PruebasController;


 //controladores de usuario
 use App\Http\Controllers\U_HomeController;
 use App\Http\Controllers\U_ActividadesController;
 use App\Http\Controllers\U_ProyectosController;
 use App\Http\Controllers\U_EquiposController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('registro', [App\Http\Controllers\PruebasController::class, 'index'])->name('/registro');
Route::post('registrar', [App\Http\Controllers\PruebasController::class, 'store'])->name('/registrar');

 Auth::routes(); 

Route::group(['middleware' => ['auth']], function(){
     Route::resource('roles', RolController::class);
     Route::resource('usuario', UsuarioController::class);
    //  Route::resource('blogs', BlogController::class); 

     

    //rutas para acceder a INICIO O HOME
    Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/', [App\Http\Controllers\BienvenidoController::class, 'index'])->name('/');
    
    //correo
    Route::post('/enviar_correo', [App\Http\Controllers\HomeController::class, 'enviarCorreo'])->name('/enviar_correo');

    //FORO DE DUDAS
    Route::get('/forodudas/{idAct}', [App\Http\Controllers\ForoController::class, 'index'])->name('forodudas');
    Route::post('guardar_comentario', [App\Http\Controllers\ForoController::class, 'guardarComentario'])->name('guardar_comentario');

//RUTAS PARA MIEMBROS
    Route::get('miembros', [App\Http\Controllers\MiembrosController::class, 'index'])->name('miembros');
    //Route::get('mostrar_miembros', [App\Http\Controllers\AdMiembrosController::class, ''])->name('miembros');
    Route::post('/registrar_miembro', [App\Http\Controllers\MiembrosController::class, 'store'])->name('/registrar_miembro');
    Route::post('/eliminar_miembro', [App\Http\Controllers\MiembrosController::class, 'destroy'])->name('/eliminar_miembro');
    Route::post('/consultar_miembro', [App\Http\Controllers\MiembrosController::class, 'consultarMiembro'])->name('/consultar_miembro');
    Route::post('/actualizar_miembro', [App\Http\Controllers\MiembrosController::class, 'update'])->name('/actualizar_miembro');
    Route::post('/eliminar_usuario', [App\Http\Controllers\MiembrosController::class, 'eliminarMiembro'])->name('/eliminar_usuario');

 
//RUTAS PARA ACTIVIDADES
    Route::get('actividades', [App\Http\Controllers\ActividadesController::class, 'index'])->name('actividades');
    //Route::post('/asignar_actividades_act', [App\Http\Controllers\ActividadesController::class, 'asignarActividad'])->name('/asignar_actividades_act');
    Route::post('/consultar_actividades', [App\Http\Controllers\ActividadesController::class, 'consultarActividades'])->name('/consultar_actividades');


//RUTAS PARA EQUIPOS
    Route::get('equipos', [App\Http\Controllers\EquiposController::class, 'index'])->name('equipos');
    Route::post('/registrar_equipo', [App\Http\Controllers\EquiposController::class, 'store'])->name('/registrar_equipo');
    Route::get('/v_veractualizar_equipo/{idEquipo}', [App\Http\Controllers\EquiposController::class, 'verActualizarEquipo'])->name('/v_veractualizar_equipo');
    Route::post('/eliminar_miembro', [App\Http\Controllers\EquiposController::class, 'eliminarMiembro'])->name('/eliminar_miembro');
    Route::post('/agregar_masMiembros', [App\Http\Controllers\EquiposController::class, 'agregarOtroMiembro'])->name('/agregar_masMiembros');
    Route::post('/eliminar_equipo', [App\Http\Controllers\EquiposController::class, 'destroy'])->name('/eliminar_equipo');

//RUTAS PARA PROYECTOS
    Route::get('proyectos', [App\Http\Controllers\ProyectosController::class, 'index'])->name('proyectos');
    Route::post('registrar_proyecto', [App\Http\Controllers\ProyectosController::class, 'store'])->name('registrar_proyecto');
    Route::post('cancelar_proyecto', [App\Http\Controllers\ProyectosController::class, 'destroy'])->name('/cancelar_proyecto');
    Route::get('/v_actualizar_proyecto/{idProy}', [App\Http\Controllers\ProyectosController::class, 'show'])->name('/v_actualizar_proyecto');
    Route::get('/v_actualizar_proyecto_equipo/{idProy}', [App\Http\Controllers\ProyectosController::class, 'show_equipo'])->name('/actualizar_proyecto_equipo');
    Route::post('/actualizar_proyecto', [App\Http\Controllers\ProyectosController::class, 'update'])->name('/actualizar_proyecto');
    Route::post('/actualizar_proyecto_equipo', [App\Http\Controllers\ProyectosController::class, 'update_proyecto_equipo'])->name('/actualizar_proyecto_equipo');
    Route::post('/finalizar_proyecto', [App\Http\Controllers\ProyectosController::class, 'finalizarProyecto'])->name('/finalizar_proyecto');
    Route::post('/asignar_actividades', [App\Http\Controllers\ProyectosController::class, 'asignarActividad'])->name('/asignar_actividades');

//RUTAS PARA REPORTES
    Route::get('reportes', [App\Http\Controllers\ReportesController::class, 'index'])->name('reportes');
    Route::get('exportar_individuales/{User}&{desde}&{hasta}', [App\Http\Controllers\ReportesController::class, 'exportarIndividuales'])->name('exportar_individuales');
    Route::get('exportar_equipo/{equipo}&{desde}&{hasta}', [App\Http\Controllers\ReportesController::class, 'exportarEquipo'])->name('exportar_equipo');
    Route::get('imprimir', [App\Http\Controllers\ReportesController::class, 'imprimir'])->name('imprimir');


//CATALOGOOOOSSS
        //PUESTOS
        Route::get('cat_puestos', [App\Http\Controllers\CatalogosController::class, 'index_puestos'])->name('cat_puestos');
        Route::post('registrar_puesto', [App\Http\Controllers\CatalogosController::class, 'registrarPuesto'])->name('registrar_puesto');
        Route::post('eliminar_puesto', [App\Http\Controllers\CatalogosController::class, 'eliminarPuesto'])->name('eliminar_puesto');


    //RUTAS DE USUARIO-----------------------------------------------------------------------------------------------------------------------------
    //RUTAS PARA INICIO DE USUARIO
    Route::get('home_usuario', [App\Http\Controllers\U_HomeController::class, 'index'])->name('home_usuario');
    
    //RUTA PARA ACTIVIDADES DE USUARIOS
    Route::get('actividades_usuario', [App\Http\Controllers\U_ActividadesController::class, 'index'])->name('actividades_usuario');
    Route::post('consultar_actividad_individual', [App\Http\Controllers\U_ActividadesController::class, 'consultar_actividad_individual'])->name('consultar_actividad_individual');
    Route::post('consultar_actividad_equipo', [App\Http\Controllers\U_ActividadesController::class, 'consultar_actividad_equipo'])->name('consultar_actividad_equipo');
    Route::post('iniciar_actividad', [App\Http\Controllers\U_ActividadesController::class, 'IniciarActividad'])->name('iniciar_actividad');
    Route::post('finalizar_actividad', [App\Http\Controllers\U_ActividadesController::class, 'FinalizarActividad'])->name('finalizar_actividad');
    

    //RUTAS PARA EQUIPOS DE USUARIOS
    Route::get('equipos_usuario', [App\Http\Controllers\U_EquiposController::class, 'index'])->name('equipos_usuario');
    Route::get('/ver_equipo_usuario/{idEquipo}', [App\Http\Controllers\U_EquiposController::class, 'verEquipoUsuario'])->name('/ver_equipo_usuario');

    //RUTAS PARA PROYECTOS DE USUARIO
    Route::get('proyectos_usuario', [App\Http\Controllers\U_ProyectosController::class, 'index'])->name('proyectos_usuario');
    Route::get('ver_proyecto_usuario/{idProyecto}', [App\Http\Controllers\U_ProyectosController::class, 'verProyecto'])->name('ver_proyecto_usuario');


});
