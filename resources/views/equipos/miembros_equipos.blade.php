@extends('adminlte::page')

@section('title', 'Ver/Editar')

@section('content_header')
<h1></h1>

@stop

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <a href="{{ url('/equipos')}}" type="button" class="btn btn-secondary"><i class="fas fa-reply"></i>
                Regresar</a>
        </div>
    </div>
</div>
<br>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">

            <div class="card bg-default">
                <h4 class="card-header">Miembros del equipo
                    <div class="card-tools">

                        <button type="button" onclick="modalAgregarMas({{$id_equipo}}, $('#token').val())" class="btn btn-tool bg-primary">
                            <i class="fas fa-plus"></i> Agregar Miembro
                        </button>

                    </div>
                </h4>
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="card-body blue-hover">
                                    <div class="container-fluid">
                                        <div class="row">
                                            @foreach($consulta_miembros_equipo as $miembro)
                                            <div class="col-3">
                                                <div class="card card-default shadow-lg" id="{{ $miembro->id_usuario}}">
                                                    <div class="card-header mx-auto">
                                                        <h3 class="card-title">
                                                            <div class="widget-user-image">
                                                                <img class="img-circle elevation-2"
                                                                    src="{{ asset("/img/usuario2.png")}}"
                                                                    style="display: block; margin: 0 auto; width : 50%; height : 50%;">
                                                            </div>
                                                        </h3>
                                                        <div class="card-tools">
                                                            <!-- <input class="valores" name="usuario" type="checkbox" value="{{ $miembro->id_usuario}}"> -->
                                                        </div>
                                                    </div>

                                                    <div class="card-body text-center">
                                                        <font style="vertical-align: inherit;">
                                                            <font style="vertical-align: center;">
                                                                <p class="text-center text-bold text-dark">
                                                                    {{ $miembro->name}} |
                                                                    {{ $miembro->descripcion_puesto}}</p>
                                                            </font>
                                                        </font>
                                                        <input type="hidden" name="_token" id="token"
                                                            value="{{ csrf_token() }}">
                                                        <a onclick="eliminarMiembros({{ $miembro->id_usuario }}, {{$miembro->id_equipo}}, $('#token').val())"
                                                            class="btn btn-danger btn-sm" title="Eliminar miembro">
                                                            <i class="fas fa-trash"></i></a>
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

<div class="modal fade hide" id="modal-agregar-mas-miembros" style="padding-right: 17px;" aria-modal="true"
    role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Agregar miembros al equipo<h4 class="modal-title" id="actividad_nombre_equipo">
                    </h4>
                </h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-info"></i> Selecciona miembros</h5>
                    Selecciona los miembros y da click en el boton para agregar al equipo.
                </div>
                <div class="container-fluid">
                    <div class="row">
                        @foreach($miembros_fuera_equipo as $miembro)
                        <div class="col-3">
                            <div class="card card-default shadow-lg" id="{{ $miembro->id}}">
                                <div class="card-header mx-auto">
                                    <h3 class="card-title">
                                        <div class="card-tools">
                                            <input class="valores" name="usuario" type="checkbox"
                                                value="{{ $miembro->id}}">
                                        </div>
                                        <div class="widget-user-image">
                                            <img class="img-circle elevation-2" src="{{ asset("/img/usuario2.png")}}"
                                                style="display: block; margin: 0 auto; width : 50%; height : 50%;">
                                        </div>
                                    </h3>

                                </div>

                                <div class="card-body text-center">
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: center;">
                                            <p class="text-center text-bold text-dark">{{ $miembro->name}} |
                                                {{ $miembro->descripcion_puesto}}</p>
                                        </font>
                                    </font>
                                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div> <!-- div de los cards de usuarios -->

            </div> 
            <div class="modal-footer justify-content-between">
                <!-- Aqui van los botones de accion (iniciar, rechazar) -->
                <button type="button" class="btn bg-gradient-danger" data-dismiss="modal">Cerrar</button>
                <div class="btn-group">
                    <button id="btnAgregarMiembros" type="button" class="btn bg-gradient-primary">Agregar</button>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('css')

@stop

@section('js')
<script src="/js/equipos/equipos.js"></script>

<script src="/js/alertas.js"></script>

<script>
// let TOKEN = `{{ csrf_token() }}`
</script>

@stop