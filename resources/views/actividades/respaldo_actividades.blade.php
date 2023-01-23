@extends('adminlte::page')

@section('title', 'Actividades')

@section('content_header')
<h1>Actividades</h1>

@stop

@section('content')
<!-- Muro Kanban -->
<?php

    // $id = Auth::user()->id;
    // $nombre = Auth::user()->name;
    
    // var_dump($id);
    // var_dump($nombre);



?> 
<br>



<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header text-white bg-primary">
                    <h3 class="card-title"><i class="fas fa-laptop-code"></i> TABLERO DE ACTIVIDADES</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <p class="card-text">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="card card-row card-warning">
                                            <div class="card-header">
                                                <h3 class="card-title text-white" style="text-bold  text-center">
                                                <i class='fa fa-exclamation-circle'></i>
                                                    Atrasadas
                                                </h3>
                                            </div>
                                            <div class="card-body">
                                                @foreach ($atrasadas as $atrasada)
                                                <div class="card card-primary card-outline">
                                                    <div class="card-header">
                                                        <h5 class="card-title">{{ $atrasada->nombre_actividad}}</h5>
                                                        <div class="card-tools">
                                                            <a href="#" class="btn btn-tool">
                                                                <i class="fa fa-eye" onclick="modalDescripcion()"
                                                                    title="Ver detalles"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card card-row card-primary">
                                            <div class="card-header">
                                            <h3 class="card-title text-white" style="text-bold">
                                            <i class='fa fa-play-circle'></i>
                                                    Pendientes
                                                </h3>
                                            </div>
                                            <div class="card-body">
                                                @foreach ($pendientes as $pendiente)
                                                <div class="card card-primary card-outline">
                                                    <div class="card-header">
                                                        <h5 class="card-title">{{ $pendiente->nombre_actividad }}</h5>
                                                        <div class="card-tools">
                                                            <a href="#" class="btn btn-tool">
                                                                <i class="fa fa-eye" onclick="modalDescripcion()"
                                                                    title="Ver detalles"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card card-row card-default">
                                            <div class="card-header bg-info">
                                                <h3 class="card-title">
                                                <i class='fa fa-code'></i>
                                                    En proceso
                                                </h3>
                                            </div>
                                            <div class="card-body">
                                                @foreach ($haciendo as $encurso)
                                                <div class="card card-light card-outline">
                                                    <div class="card-header">
                                                        <h5 class="card-title">{{ $encurso->nombre_actividad }}</h5>
                                                        <div class="card-tools">
                                                            <a href="#" class="btn btn-tool">
                                                                <i class="fa fa-eye" onclick="modalDescripcion()"
                                                                    title="Ver detalles"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="card-body">
                                                        <p>
                                                            Muro kanban en proceso. se estan creando los proyectos y
                                                            tareas.
                                                        </p>
                                                    </div> -->
                                                </div>
                                                
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card card-row card-success">
                                            <div class="card-header">
                                                <h3 class="card-title">
                                                <i class='fa fa-check'></i>
                                                    Terminadas
                                                </h3>
                                            </div>
                                            <div class="card-body">
                                                @foreach ($finalizadas as $finalizada)
                                                <div class="card card-primary card-outline">
                                                    <div class="card-header">
                                                        <h5 class="card-title" style="text-justify">{{ $finalizada->nombre_actividad }}</h5>
                                                        <div class="card-tools">
                                                            <a href="#" class="btn btn-tool">
                                                                <i class="fa fa-eye" onclick="modalDescripcion()"
                                                                    title="Ver detalles"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </p>
                </div>
                <div class="card-footer">

                </div>

            </div>
        </div>
    </div>
</div>
<div class="modal fade hide " id="modal-descripcion" style="padding-right: 17px;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Descripcion de la actividad/tarea</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Aqui van los datos de la tarea</p>
            </div>
            <div class="modal-footer justify-content-between">
                <!-- Aqui van los botones de accion (iniciar, rechazar) -->
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success">Iniciar</button>
            </div>
        </div>
    </div>
</div>















<!-- RESPALDO DE VISTA ANTERIOR CON BUSQUEDA DESDE JAVASCRIPT -->

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-info"></i> Consultar Actividades</h5>
                Busca las actividades seleccionando el proyecto.
            </div>
            <div class="card">
                <h5 class="card-header bg-gradient-primary text-white">
                    Buscar Actividades
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </h5>
                <div class="card-body bg-white">

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="text-dark">Proyecto:</label>
                                        <select class="form-control" id="select_proyecto" name='select_proyecto'
                                            required>
                                            <option value=" "></option>
                                            @foreach ($proyectos as $proyecto)
                                            <option value="{{ $proyecto->id }}">
                                                {{ $proyecto->nombre_proyecto }}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                    </div>
                                    <div class="col-md-6 col-auto">
                                        <label class="text-white">Buscar</label>
                                        <button type="button" id="btnbuscarActividad"
                                            class="btn btn-primary btn-md btn-block">Buscar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <!-- cuerpo del footer -->
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header bg-gradient-primary text-white">
                    Listado de actividades
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </h5>
                <div class="card-body bg-white">

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped" id="tabla_actividad">

                                        <thead class="thead-primary text-center">
                                            <!-- <tr>
                                                <th>ID</th>
                                                <th>Nombre</th>
                                                <th>Descripción</th>
                                                <th>Fecha Asignacion</th>
                                                <th>Fecha Finalizacion</th>
                                                <th>Fecha Inicio</th>
                                                <th>Fecha Entrega</th>
                                                <th>Asignado a</th>
                                                <th>Proyecto</th>
                                                <th>Estado</th>
                                                <th>Prioridad</th>
                                            </tr> -->
                                        </thead>
                                        <tbody>
                                            <!-- <td id="fila_id"></td>
                                            <td id="fila_nombre"></td>
                                            <td id="fila_descripcion"></td>
                                            <td id="fila_asignacion"></td>
                                            <td id="fila_finalizacion"></td>
                                            <td id="fila_inicio"></td>
                                            <td id="fila_entrega"></td>
                                            <td id="fila_asignado"></td>
                                            <td id="fila_proyecto"></td>
                                            <td id="fila_estado"></td>
                                            <td id="fila_prioridad"></td> -->
                                        </tbody>

                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <!-- cuerpo del footer -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function modalDescripcion() {
    $('#modal-descripcion').modal('show');

    $('#btnAsignarActividad').on('click', function () { 
        iniciarActividad(idProy);
   });
}

function iniciarActividad(){
    
}
</script>
@stop

@section('css')
<!-- <link rel="stylesheet" href="/css/admin_custom.css"> -->
@stop

@section('js')
<!-- <script> console.log('Hi!'); </script> -->
@stop