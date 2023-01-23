@extends('adminlte::page')

@section('title', 'Equipos')

@section('content_header')
<h1 class="text-bold">Mis equipos</h1>

@stop
 
@section('content')
<br>

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
                                            @foreach($mis_equipos as $equipo)
                                            <div class="col-3">
                                                <div class="card card-default shadow-lg" id="{{ $equipo->id_equipo}}">
                                                    <div class="card-header mx-auto">
                                                        <h3 class="card-title">
                                                            <div class="widget-user-image">
                                                                <img class="img-circle elevation-2"
                                                                    src="/img/equipo2.png"
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
                                                                    {{ $equipo->nombre_equipo}}</h4>
                                                            </font>
                                                        </font>
                                                        <a href="{{ url('/ver_equipo_usuario',['idEquipo' => $equipo->id_equipo])}}"
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




@stop

@section('css')

@stop

@section('js')


@stop