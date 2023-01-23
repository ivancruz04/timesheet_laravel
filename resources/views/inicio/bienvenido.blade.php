@extends('adminlte::page')

@section('title', 'Bienvenido')

@section('Sweetalert2', true)

@section('content_header')
<h1>Bienvenido</h1>

@stop

@section('content')
<?php
    $idquien = Auth::user()->id;
    $quien = Auth::user()->name;
    $emailquien = Auth::user()->email;
    $puestoquien = Auth::user()->id_puesto;
    $relativa = Auth::user()->foto_relativa;
    $sesion = [$idquien, $quien, $emailquien];
    //var_dump($sesion);
?>

<div class="row">
    <div class="col-md-8 col-sm-8 col-12">
        <div class="card shadow-lg">
            <div class="card-header">
                <h3 class="card-title">
                    <h2> Hola de nuevo {{$quien}}!!
                    </h2>
                </h3>
            </div>
            <div class="card-body">
                <blockquote>
                    <h3>Ya puedes comenzar a gestionar y llevar a cabo tus proyectos y/o actividades</h3>
                    <small>Ve a tu Tablero principal para ver toda la informacion <cite
                            title="Source Title"></cite></small>
                </blockquote>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-sm-6 col-12">
        <div class="card card-default shadow-lg" id="">
            <div class="card-header mx-auto">
                <h3 class="card-title">
                    <div class="widget-user-image">
                        <img class="img-circle elevation-2" src="/img/perfil.gif"
                            style="display: block; margin: 0 auto; width : 50%; height : 50%;">
                    </div>
                </h3>
                <div class="card-tools">
                </div>
            </div>
            <div class="card-body text-center">
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: center;">
                        <h5 class="text-center text-bold text-dark">
                            {{ $quien}} |
                            {{ $emailquien}}
                    </font>
                </font>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<!-- <link rel="stylesheet" href="/css/admin_custom.css"> -->
@stop