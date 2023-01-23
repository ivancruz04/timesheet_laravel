@extends('adminlte::page')

@section('title', 'Tablero')

@section('Sweetalert2', true)

@section('content_header')
<h1>Inicio</h1>

@stop

@section('content')
<?php
    $idquien = Auth::user()->id;
    $quien = Auth::user()->name;
    $emailquien = Auth::user()->email;
    $puestoquien = Auth::user()->id_puesto;
    $relativa = Auth::user()->foto_relativa;


    $sesion = [$idquien, $quien, $emailquien, $puestoquien, $relativa];
    //var_dump($sesion);
    

?>

<div class="row">
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box"">
            <span class="info-box-icon bg-info"><i class='fa fa-rocket'></i></span>
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
<br>
<div class="row">
    <div class="col-lg-4 col-6">

        <div class="small-box bg-teal color-palette">
            <div class="inner">
                @foreach($proyectos_registrados as $p_registrados)
                <h3>{{ $p_registrados->registrados}}</h3>
                @endforeach
                <p>Proyectos registrados</p>
            </div>
            <div class="icon">
                <i class="fa fa-rocket"></i>
            </div>
            <a href="/proyectos" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-4 col-6">

        <div class="small-box bg-yellow">   
            <div class="inner">
            @foreach($usuarios_registrados as $u_registrados)
                <h3>{{ $u_registrados->usuarios_registrados}}</h3>
                @endforeach
                <p>Usuarios Registrados</p>
            </div>
            <div class="icon">
                <i class="fa fa-user"></i>
            </div>
            <a href="/miembros" class="small-box-footer">Mas información <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-4 col-6">

        <div class="small-box bg-primary">
            <div class="inner">
            @foreach($equipos_registrados as $u_equipos)
                <h3>{{ $u_equipos->equipos_registrados}}</h3>
                @endforeach
                <p>Equipos de trabajo</p>
            </div>
            <div class="icon">
                <i class="fa fa-users"></i>
            </div>
            <a href="/equipos" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    

</div>

<br>
<!-- <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

<button class="btn-primary" onclick="enviarCorreo()">enviar correo</button>
<script src="/js/alertas.js"></script> -->

@stop

@section('css')
<!-- <link rel="stylesheet" href="/css/admin_custom.css"> -->
@stop

