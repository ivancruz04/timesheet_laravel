@extends('adminlte::page')

@section('title', 'Equipos')

@section('content_header')
<h1 class="text-bold"></h1>

@stop

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <a href="{{ url('/proyectos_usuario')}}" type="button" class="btn btn-secondary"><i
                    class="fas fa-reply"></i>
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
                    <h3 class="card-title">Informacion del proyecto</h3>
                    <div class="card-tools">


                    </div>
                </div>

                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead class="thead-primary text-center">
                                <tr class="bg-cyan pallete-color">
                                    <th style="width: 10px">#</th>
                                    <th>Nombre</th>
                                    <th>Descripcion</th>
                                    <th>Fecha Asignacion</th>
                                    <th>Fecha para Terminar</th>
                                    <th>Fecha de Inicio</th>
                                    <th>Fecha Entrega</th>
                                    <th>Estado</th>
                                    <th>Asignado</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @if ($tipo_proyecto == 1)
                                @foreach ($proyectos_seleccionado as $proyecto)

                                <td>{{$proyecto->id}}</td>
                                <td>{{$proyecto->nombre_proyecto}}</td>
                                <td>{{$proyecto->descripcion}}</td>
                                <td>{{$proyecto->fecha_asignacion}}</td>
                                <td>{{$proyecto->fecha_finalizacion}}</td>
                                <td>{{$proyecto->fecha_inicio}}</td>
                                <td>{{$proyecto->fecha_entrega}}</td>

                                @switch($proyecto->estado)
                                @case('ENC')
                                <td><span class="badge badge-primary" id="estado">{{$proyecto->estado}}</span></td>
                                @break
                                @case('FIN')
                                <td><span class="badge badge-success" id="estado">{{$proyecto->estado}}</span></td>
                                @break
                                @case('DES')
                                <td><span class="badge badge-warning" id="estado">{{$proyecto->estado}}</span></td>
                                @break
                                @case('CAN')
                                <td><span class="badge badge-danger" id="estado">{{$proyecto->estado}}</span></td>
                                @break
                                @case('PEN')
                                <td><span class="badge badge-secondary" id="estado">{{$proyecto->estado}}</span></td>
                                @break
                                @endswitch
                                <td>{{$proyecto->name}}</td>

                                @endforeach
                                @else
                                @foreach ($proyectos_seleccionado as $proyecto)

                                <td>{{$proyecto->id}}</td>
                                <td>{{$proyecto->nombre_proyecto}}</td>
                                <td>{{$proyecto->descripcion}}</td>
                                <td>{{$proyecto->fecha_asignacion}}</td>
                                <td>{{$proyecto->fecha_finalizacion}}</td>
                                <td>{{$proyecto->fecha_inicio}}</td>
                                <td>{{$proyecto->fecha_entrega}}</td>
                                @switch($proyecto->estado)
                                @case('ENC')
                                <td><span class="badge badge-primary" id="estado">{{$proyecto->estado}}</span></td>
                                @break
                                @case('FIN')
                                <td><span class="badge badge-success" id="estado">{{$proyecto->estado}}</span></td>
                                @break
                                @case('DES')
                                <td><span class="badge badge-warning" id="estado">{{$proyecto->estado}}</span></td>
                                @break
                                @case('CAN')
                                <td><span class="badge badge-danger" id="estado">{{$proyecto->estado}}</span></td>
                                @break
                                @case('PEN')
                                <td><span class="badge badge-secondary" id="estado">{{$proyecto->estado}}</span></td>
                                @break
                                @endswitch
                                <td>Equipo: {{$proyecto->nombre_equipo}}</td>

                                @endforeach

                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if ($tipo_proyecto == 2)

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">

            <div class="card bg-default">
                <div class="card-header">
                @foreach ($proyectos_seleccionado as $proyecto)
                    <h3 class="card-title">Equipo encargado</h3>
                @endforeach
                </div>
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="card-body">
                                    <div class="container-fluid">
                                        <div class="row">
                                            @foreach($miembros_proyecto as $equipo)
                                            <div class="col-3">
                                                <div class="card card-default shadow-lg" id="{{ $equipo->id_usuario}}">
                                                    <div class="card-header mx-auto">
                                                        <h3 class="card-title">
                                                            <div class="widget-user-image">
                                                                <img class="img-circle elevation-2"
                                                                    src="{{ asset("/img/perfil.gif")}}"
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
    
@endif



<br>


@stop

@section('css')

@stop

@section('js')


@stop