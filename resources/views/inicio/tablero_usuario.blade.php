@extends('adminlte::page')

@section('title', 'Tablero')

@section('Sweetalert2', true)

@section('content_header')
<h1 class="text-bold">Inicio</h1>

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
            <div class="card">
                <div class="card-header">
                    <h4>Proyectos individuales</h4>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box"">
            <span class=" info-box-icon bg-info"><i class='fa fa-rocket'></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Proyectos en curso</span>
                                    @foreach($proyectos_en_curso as $p_en_curso)
                                    <span class="info-box-number">{{ $p_en_curso->en_curso}}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-success"><i class="fa fa-check-circle"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Proyectos finalizados</span>
                                    @foreach($proyectos_terminados as $p_terminados)
                                    <span class="info-box-number">{{ $p_terminados->terminados}}</span>
                                    @endforeach
                                </div>

                            </div>

                        </div>

                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning"><i class='fa fa-exclamation-circle'></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Proyectos atrasados</span>
                                    @foreach($proyectos_atrasados as $p_atrasados)
                                    <span class="info-box-number">{{ $p_atrasados->atrasados}}</span>
                                    @endforeach
                                </div>

                            </div>

                        </div>

                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-danger"><i class='fa fa-times-circle'></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Proyectos cancelados</span>
                                    @foreach($proyectos_cancelados as $p_cancelados)
                                    <span class="info-box-number">{{ $p_cancelados->cancelados}}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Proyectos en equipo</h4>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box"">
            <span class=" info-box-icon bg-info"><i class='fa fa-rocket'></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Proyectos en curso</span>
                                    @foreach($proyectos_en_curso_equipo as $p_en_curso)
                                    <span class="info-box-number">{{ $p_en_curso->en_curso}}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-success"><i class="fa fa-check-circle"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Proyectos finalizados</span>
                                    @foreach($proyectos_terminados_equipo as $p_terminados)
                                    <span class="info-box-number">{{ $p_terminados->terminados}}</span>
                                    @endforeach
                                </div>

                            </div>

                        </div>

                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning"><i class='fa fa-exclamation-circle'></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Proyectos atrasados</span>
                                    @foreach($proyectos_atrasados_equipo as $p_atrasados)
                                    <span class="info-box-number">{{ $p_atrasados->atrasados}}</span>
                                    @endforeach
                                </div>

                            </div>

                        </div>

                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-danger"><i class='fa fa-times-circle'></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Proyectos cancelados</span>
                                    @foreach($proyectos_cancelados_equipo as $p_cancelados)
                                    <span class="info-box-number">{{ $p_cancelados->cancelados}}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card  card-primary">
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="small-box bg-gradient-info">

                                            <div class="inner">
                                                <h3>{{$total_actividades}}</h3>
                                                <h4>Actividades</h4>
                                            </div>
                                            <div class="icon">
                                                <i class="fa fa-rocket"></i>
                                            </div>
                                            <a href="/actividades_usuario" class="small-box-footer">Más información <i
                                                    class="fas fa-arrow-circle-right"></i></a>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="small-box bg-gradient-success">
                                            <div class="inner">
                                                <h3>{{$total_proyectos}}</h3>
                                                <h4>Mis proyectos</h4>
                                            </div>
                                            <div class="icon">
                                                <i class="fa fa-rocket"></i>
                                            </div>
                                            <a href="/proyectos_usuario" class="small-box-footer">Mas información <i
                                                    class="fas fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>



                                    <div class="col-md-4">
                                        <div class="small-box bg-gradient-purple palette-color">
                                            <div class="inner">
                                                <h3>{{$total_equipos}}</h3>
                                                <h4>Mis Equipos</h4>
                                            </div>
                                            <div class="icon">
                                                <i class="fa fa-users"></i>
                                            </div>
                                            <a href="/equipos_usuario" class="small-box-footer">Más información <i
                                                    class="fas fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>


@stop

@section('css')
<!-- <link rel="stylesheet" href="/css/admin_custom.css"> -->
@stop

@section('js')

@stop