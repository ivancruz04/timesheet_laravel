@extends('adminlte::page')

@section('title', 'Equipos')

@section('content_header')
<h1 class="text-bold"></h1>

@stop

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <a href="{{ url('/equipos_usuario')}}" type="button" class="btn btn-secondary"><i class="fas fa-reply"></i>
                Regresar</a>
        </div>
    </div>
</div>
<br>


<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header text-center">
                    <h3 class="card-title">Informacion del equipo</h3>
                </div>

                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead class="thead-primary text-center bg-cyan pallete-color">
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Nombre</th>
                                    <th>Descripcion</th>

                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach ($equipo_seleccionado_info as $equipo)

                                <td>{{$equipo->id_equipo}}</td>
                                <td>{{$equipo->nombre_equipo}}</td>
                                <td>{{$equipo->descripcion}}</td>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">

            <div class="card bg-default">
                <div class="card-header">
                    <h3 class="card-title">Miembros del equipo</h3>
                </div>
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="card-body">
                                    <div class="container-fluid">
                                        <div class="row">
                                            @foreach($equipo_seleccionado as $equipo)
                                            <div class="col-3">
                                                <div class="card card-default shadow-lg" id="{{ $equipo->id_equipo}}">
                                                    <div class="card-header mx-auto">
                                                        <h3 class="card-title">
                                                            <div class="widget-user-image">
                                                                <img class="img-circle elevation-2"
                                                                    src="{{ asset("/img/usuario2.png")}}"
                                                                    style="display: block; margin: 0 auto; width : 50%; height : 50%;">
                                                            </div>
                                                        </h3>
                                                        <div class="card-tools">
                                                        </div>
                                                    </div>

                                                    <div class="card-body text-center">
                                                        <font style="vertical-align: inherit;">
                                                            <font style="vertical-align: center;">
                                                                <p class="text-center text-bold text-dark">
                                                                    {{ $equipo->name}} |
                                                                    {{ $equipo->descripcion_puesto}}
                                                            </font>
                                                        </font>
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
<br>


@stop

@section('css')

@stop

@section('js')


@stop