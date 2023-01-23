@extends('adminlte::page')

@section('title', 'Proyectos')

@section('content_header')
<h1>Mis proyectos</h1>

@stop

@section('content')

<?php
    $idquien = Auth::user()->id;
    $quien = Auth::user()->name;
    $emailquien = Auth::user()->email;
    $puestoquien = Auth::user()->id_puesto;
    $relativa = Auth::user()->foto_relativa;

    $puestos = DB::table('puestos')
                ->select('descripcion')
                ->where('id_puesto', '=', $puestoquien)
                ->get();
        
        foreach($puestos as $puesto){
         $puesto_quien = $puesto->descripcion;
        }


    $sesion = [$idquien, $quien, $emailquien, $puestoquien, $relativa];
    //var_dump($sesion);
    

?>



<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">

            <div class="card bg-default">
                <!-- <h4 class="card-header"> </h4> -->
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="card-body blue-hover">
                                    <div class="container-fluid">
                                        <div class="row">
                                            @foreach($proyectos_usuario_individual as $proyecto)
                                            <div class="col-3">
                                            @switch($proyecto->estado)
                                                @case('ENC')
                                                    <div class="card card-primary shadow-lg" id="{{ $proyecto->id}}"> 
                                                @break
                                                @case('FIN')
                                                    <div class="card card-success shadow-lg" id="{{ $proyecto->id}}">
                                                @break
                                                @case('DES')
                                                    <div class="card card-warning shadow-lg" id="{{ $proyecto->id}}">
                                                @break
                                                @case('CAN')
                                                    <div class="card card-danger shadow-lg" id="{{ $proyecto->id}}">
                                                @break
                                                @case('PEN')
                                                    <div class="card card-default shadow-lg" id="{{ $proyecto->id}}">
                                                @break
                                            @endswitch
                                                    <div class="card-header mx-auto">
                                                        <h3 class="card-title">
                                                            <div class="widget-user-image">
                                                                <img class="img-circle elevation-2"
                                                                    src="/img/proyecto.png"
                                                                    style="display: block; margin: 0 auto; width : 50%; height : 50%;">
                                                            </div>
                                                        </h3>
                                                        <div class="card-tools">
                                                        </div>
                                                    </div>

                                                    <div class="card-body text-center">
                                                        <font style="vertical-align: inherit;">
                                                            <font style="vertical-align: center;">
                                                                <h4 class="text-center text-bold text-dark">
                                                                    {{ $proyecto->nombre_proyecto}}</h4>
                                                            </font>
                                                        </font>
                                                        <a href="{{ url('/ver_proyecto_usuario',['idProyecto' => $proyecto->id])}}"
                                                            class="btn bg-gradient-primary">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            @foreach($proyectos_usuario_equipo as $proyecto)
                                            <div class="col-3">
                                            @switch($proyecto->estado)
                                                @case('ENC')
                                                    <div class="card card-primary shadow-lg" id="{{ $proyecto->id}}"> 
                                                @break
                                                @case('FIN')
                                                    <div class="card card-success shadow-lg" id="{{ $proyecto->id}}">
                                                @break
                                                @case('DES')
                                                    <div class="card card-warning shadow-lg" id="{{ $proyecto->id}}">
                                                @break
                                                @case('CAN')
                                                    <div class="card card-danger shadow-lg" id="{{ $proyecto->id}}">
                                                @break
                                                @case('PEN')
                                                    <div class="card card-default shadow-lg" id="{{ $proyecto->id}}">
                                                @break
                                            @endswitch
                                                    <div class="card-header mx-auto">
                                                        <h3 class="card-title">
                                                            <div class="widget-user-image">
                                                                <img class="img-circle elevation-2"
                                                                    src="/img/proyecto.png"
                                                                    style="display: block; margin: 0 auto; width : 50%; height : 50%;">
                                                            </div>
                                                        </h3>
                                                        <div class="card-tools">
                                                        </div>
                                                    </div>

                                                    <div class="card-body text-center">
                                                        <font style="vertical-align: inherit;">
                                                            <font style="vertical-align: center;">
                                                                <h4 class="text-center text-bold text-dark">
                                                                    {{ $proyecto->nombre_proyecto}}</h4>
                                                            </font>
                                                        </font>
                                                        <a href="{{ url('/ver_proyecto_usuario',['idProyecto' => $proyecto->id])}}"
                                                            class="btn bg-gradient-primary">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            
                                        </div>
                                    </div> <!-- div de los cards de usuarios -->
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">
                        </font>
                    </font>
                </div>
            </div>


        </div>
    </div>
</div>


<!-- <div class="row">
    <div class="col-md-4">



    </div>

    <div class="col-md-4">

        

    </div>

    <div class="col-md-4">


    </div>

</div> -->



@stop