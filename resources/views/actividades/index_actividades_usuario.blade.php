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

<div class="card card-tabs">
    <div class="card-header p-0 pt-1">
        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home"
                    role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">
                    <i class="fa fa-user"></i> Individuales
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile"
                    role="tab" aria-controls="custom-tabs-one-profile" aria-selected="true">
                    <i class="fa fa-users"></i> Equipo
                </a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="custom-tabs-one-tabContent">
            <div class="tab-pane fade active show" id="custom-tabs-one-home" role="tabpanel"
                aria-labelledby="custom-tabs-one-home-tab">

                <div class="card-body bg-gradient-info">
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
                                                        <h5 class="card-title text-dark">
                                                            {{ $atrasada->nombre_actividad}}</h5>
                                                        <div class="card-tools">
                                                            <a href="#" class="btn btn-tool">
                                                                <i class="fa fa-eye"
                                                                    onclick="modalDescripcionIndividual({{ $atrasada->id_actividad}})"
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
                                                        <h5 class="card-title text-dark">
                                                            {{ $pendiente->nombre_actividad }}</h5>
                                                        <div class="card-tools">
                                                            <a href="#" class="btn btn-tool">
                                                                <i class="fa fa-eye"
                                                                    onclick="modalDescripcionIndividual({{ $pendiente->id_actividad }})"
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
                                                        <h5 class="card-title text-dark">
                                                            {{ $encurso->nombre_actividad }}</h5>
                                                        <div class="card-tools">
                                                            <a href="#" class="btn btn-tool">
                                                                <i class="fa fa-eye"
                                                                    onclick="modalDescripcionIndividual({{ $encurso->id_actividad }})"
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
                                                        <h5 class="card-title text-dark" style="text-justify">
                                                            {{ $finalizada->nombre_actividad }}</h5>
                                                        <div class="card-tools">
                                                            <a href="#" class="btn btn-tool">
                                                                <i class="fa fa-eye"
                                                                    onclick="modalDescripcionIndividual({{ $finalizada->id_actividad }})"
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
            <div class="tab-pane" id="custom-tabs-one-profile" role="tabpanel"
                aria-labelledby="custom-tabs-one-profile-tab">

                <div class="card-body bg-gradient-info">
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
                                                @foreach ($atrasadas_equipo as $atrasada_equipo)
                                                <div class="card card-primary card-outline">
                                                    <div class="card-header">
                                                        <h5 class="card-title text-dark">
                                                            {{ $atrasada_equipo->nombre_actividad}}</h5>
                                                        <div class="card-tools">
                                                            <a href="#" class="btn btn-tool">
                                                                <i class="fa fa-eye"
                                                                    onclick="modalDescripcionEquipo({{ $atrasada_equipo->id_actividad}})"
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
                                                @foreach ($pendientes_equipo as $pendiente_equipo)
                                                <div class="card card-primary card-outline">
                                                    <div class="card-header">
                                                        <h5 class="card-title text-dark">
                                                            {{ $pendiente_equipo->nombre_actividad }}</h5>
                                                        <div class="card-tools">
                                                            <a href="#" class="btn btn-tool">
                                                                <i class="fa fa-eye"
                                                                    onclick="modalDescripcionEquipo({{ $pendiente_equipo->id_actividad }})"
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
                                                @foreach ($haciendo_equipo as $encurso_equipo)
                                                <div class="card card-light card-outline">
                                                    <div class="card-header">
                                                        <h5 class="card-title text-dark">
                                                            {{ $encurso_equipo->nombre_actividad }}</h5>
                                                        <div class="card-tools">
                                                            <a href="#" class="btn btn-tool">
                                                                <i class="fa fa-eye"
                                                                    onclick="modalDescripcionEquipo({{ $encurso_equipo->id_actividad }})"
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
                                                @foreach ($finalizadas_equipo as $finalizada_equipo)
                                                <div class="card card-primary card-outline">
                                                    <div class="card-header">
                                                        <h5 class="card-title text-dark" style="text-justify">
                                                            {{ $finalizada_equipo->nombre_actividad }}</h5>
                                                        <div class="card-tools">
                                                            <a href="#" class="btn btn-tool">
                                                                <i class="fa fa-eye"
                                                                    onclick="modalDescripcionEquipo({{ $finalizada_equipo->id_actividad }})"
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

<!-- modal de descripcion de activida individual -->
<div class="modal fade hide " id="modal-descripcion-actividad-individual" style="padding-right: 17px;" aria-modal="true"
    role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Actividad : <h4 class="modal-title" id="actividad_nombre_individual"></h4>
                </h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row justify-content-center">
                                <div class="col-md-4">
                                    <label for="actividad_prioridad_individual" class="float-center">Prioridad : <label
                                            class="badge align-right"
                                            id="actividad_prioridad_individual"></label></label>

                                </div>
                                <div class="col-md-4">
                                </div>
                                <div class="col-md-4">
                                    <label for="actividad_estado_individual" class="float-center">Estado : <label
                                            class="badge badge-success align-right"
                                            id="actividad_estado_individual"></label></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="text-dark" style="text-bold">Descripcion:</label>
                                    <textarea id="actividad_descripcion_individual" type="text" class="form-control"
                                        disabled rows="5"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="text-dark">Fecha de asignación:</label>
                                    <input id="actividad_fecha_asignacion_individual" type="text" class="form-control"
                                        disabled>
                                </div>
                                <div class="col-md-6">
                                    <label class="text-dark">Fecha para entregar:</label>
                                    <input id="actividad_fecha_fin_individual" type="text" class="form-control"
                                        disabled>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="text-dark">Fecha de inicio:</label>
                                    <input id="actividad_fecha_inicio_individual" type="text" class="form-control"
                                        disabled>
                                </div>
                                <div class="col-md-6">
                                    <label class="text-dark">Fecha de entrega:</label>
                                    <input id="actividad_fecha_entrega_individual" type="text" class="form-control"
                                        disabled>
                                    <label id="actividad_id_individual" class="text-white"></label>
                                </div>
                            </div>
                            <br>
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <label for="actividad_asignado_individual" class="float-center">Asignado a :
                                    </label>
                                    <input id="actividad_asignado_individual" type="text" class="form-control" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label for="actividad_proyecto_individual" class="float-center">Proyecto : </label>
                                    <input id="actividad_proyecto_individual" type="text" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <!-- Aqui van los botones de accion (iniciar, rechazar) -->
                <button type="button" class="btn bg-gradient-danger" data-dismiss="modal">Cerrar</button>

                <a type="button" onclick="abrirForo($('#actividad_id_individual').val())" class="btn bg-gradient-secondary">Comentarios</a>

                <div class="btn-group">
                    <button id="btnIniciarActividadIndividual" type="button" class="btn bg-gradient-primary">Iniciar</button>
                    <button id="btnFinalizarActividadIndividual" type="button" class="btn bg-gradient-success">Finalizar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal de descripcion de activida en equipo -->
<div class="modal fade hide " id="modal-descripcion-actividad-equipo" style="padding-right: 17px;" aria-modal="true"
    role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Actividad : <h4 class="modal-title" id="actividad_nombre_equipo"></h4>
                </h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row justify-content-center">
                                <div class="col-md-4">
                                    <label for="actividad_prioridad_equipo" class="float-center">Prioridad : <label
                                            class="badge align-right"
                                            id="actividad_prioridad_equipo"></label></label>

                                </div>
                                <div class="col-md-4">
                                </div>
                                <div class="col-md-4">
                                    <label for="actividad_estado_equipo" class="float-center">Estado : <label
                                            class="badge align-right" id="actividad_estado_equipo"></label></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="text-dark" style="text-bold">Descripcion:</label>
                                    <textarea id="actividad_descripcion_equipo" type="text" class="form-control"
                                        disabled rows="5"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="text-dark">Fecha de asignación:</label>
                                    <input id="actividad_fecha_asignacion_equipo" type="text" class="form-control"
                                        disabled>
                                </div>
                                <div class="col-md-6">
                                    <label class="text-dark">Fecha para entregar:</label>
                                    <input id="actividad_fecha_fin_equipo" type="text" class="form-control" disabled>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="text-dark">Fecha de inicio:</label>
                                    <input id="actividad_fecha_inicio_equipo" type="text" class="form-control" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label class="text-dark">Fecha de entrega:</label>
                                    <input id="actividad_fecha_entrega_equipo" type="text" class="form-control"
                                        disabled>
                                    <label id="actividad_id_equipo" class="text-white"></label>
                                    
                                </div>
                            </div>
                            <br>
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <label for="actividad_asignado_equipo" class="float-center">Asignado a equipo:
                                    </label>
                                    <input id="actividad_asignado_equipo" type="text" class="form-control" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label for="actividad_proyecto_equipo" class="float-center">Proyecto : </label>
                                    <input id="actividad_proyecto_equipo" type="text" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <!-- Aqui van los botones de accion (iniciar, rechazar) -->
                <button type="button" class="btn bg-gradient-danger" data-dismiss="modal">Cerrar</button>
                <a id="btncomentarios" onclick="abrirForo($('#actividad_id_equipo').val())" type="button" class="btn bg-gradient-secondary">Comentarios</a>

                <div class="btn-group">
                    <button id="btnIniciarActividadEquipo" type="button" class="btn bg-gradient-primary">Iniciar</button>
                    <button id="btnFinalizarActividadEquipo" type="button" class="btn bg-gradient-success btn-disabled">Finalizar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let SITE = `{{ url('/') }}`

//funcion que obtiene a fecha actual
function fechayhora_actual() {
    //fecha y hora actual del sistema
    let hoy = new Date();
    let fecha = hoy.getFullYear() + '-' + (hoy.getMonth() + 1) + '-' + hoy.getDate();
    let hora = hoy.getHours() + ':' + hoy.getMinutes() + ':' + hoy.getSeconds();
    let fechayhora = fecha + ' ' + hora;

    return fechayhora;
}

function modalDescripcionIndividual(idAct) {
    $('#modal-descripcion-actividad-individual').modal('show');
    const TOKEN = `{{ csrf_token() }}`
    let obj = {
        id_actividad: idAct
    };
    fetch(`{{ url('/consultar_actividad_individual') }}`, {
            method: 'post',
            headers: {
                'X-CSRF-TOKEN': TOKEN,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(obj)
        })
        .then(response => response.json())
        .then(response => {

            if (response.respuesta['descripcion_larga'] == 'Normal') {
                $('#actividad_prioridad_individual').addClass('badge-primary')
            } else {
                $('#actividad_prioridad_individual').addClass('badge-warning')
            }

            switch (response.respuesta['estado']) {
                case 'PEN':
                    $('#actividad_estado_individual').addClass('badge-secondary')
                    $('#btnFinalizarActividadIndividual').hide();
                    break;
                case 'CAN':
                    $('#actividad_estado_individual').addClass('badge-danger')
                    break;
                case 'FIN':
                    $('#actividad_estado_individual').addClass('badge-success')
                    $('#btnIniciarActividadIndividual').hide();
                    $('#btnFinalizarActividadIndividual').hide();
                    break;
                case 'DES':
                    $('#actividad_estado_individual').addClass('badge-warning')
                    $('#btnFinalizarActividadIndividual').hide();
                    break;
                case 'ENC':
                    $('#actividad_estado_individual').addClass('badge-primary')
                    $('#btnIniciarActividadIndividual').hide();
                    break;
            }

            
            document.getElementById('actividad_id_individual').value = response.respuesta[
                'id_actividad'];
            document.querySelector('#actividad_nombre_individual').innerText = response.respuesta[
                'nombre_actividad'];
            document.querySelector('#actividad_prioridad_individual').innerText = response.respuesta[
                'descripcion_larga'];
            document.getElementById('actividad_prioridad_individual').value = response.respuesta[
                'descripcion_larga'];
            document.querySelector('#actividad_estado_individual').innerText = response.respuesta['estado'];
            document.getElementById('actividad_descripcion_individual').value = response.respuesta['descripcion'];
            document.getElementById('actividad_fecha_asignacion_individual').value = response.respuesta[
                'fecha_asignacion'];
            document.getElementById('actividad_fecha_fin_individual').value = response.respuesta['fecha_fin'];
            document.getElementById('actividad_fecha_inicio_individual').value = response.respuesta['fecha_inicio'];
            document.getElementById('actividad_fecha_entrega_individual').value = response.respuesta[
                'fecha_entrega'];
            document.getElementById('actividad_asignado_individual').value = response.respuesta['name'];
            document.getElementById('actividad_proyecto_individual').value = response.respuesta['nombre_proyecto'];

            console.log(response.respuesta)

            $('#btnIniciarActividadIndividual').on('click', function() {
                iniciarActividadIndividual(response.respuesta['id_actividad']);
            });

            $('#btnFinalizarActividadIndividual').on('click', function() {
                finalizarActividadIndividual(response.respuesta['id_actividad']);
            });

        })
        .catch(error => console.error('Error:', error))


}

function modalDescripcionEquipo(idAct) {
    $('#modal-descripcion-actividad-equipo').modal('show');
    const TOKEN = `{{ csrf_token() }}`
    let obj = {
        id_actividad: idAct
    };

    fetch(`{{ url('/consultar_actividad_equipo') }}`, {
            method: 'post',
            headers: {
                'X-CSRF-TOKEN': TOKEN,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(obj)
        })
        .then(response => response.json())
        .then(response => {


            if (response.respuesta['descripcion_larga'] == 'Normal') {
                $('#actividad_prioridad_equipo').addClass('badge-primary')
            } else {
                $('#actividad_prioridad_equipo').addClass('badge-warning')
            }

            switch (response.respuesta['estado']) {
                case 'PEN':
                    $('#actividad_estado_equipo').addClass('badge-secondary')
                    $('#btnFinalizarActividadEquipo').hide();
                    break;
                case 'CAN':
                    $('#actividad_estado_equipo').addClass('badge-danger')
                    break;
                case 'FIN':
                    $('#actividad_estado_equipo').addClass('badge-success')
                    $('#btnIniciarActividadEquipo').hide();
                    $('#btnFinalizarActividadEquipo').hide();
                    break;
                case 'DES':
                    $('#actividad_estado_equipo').addClass('badge-warning')
                    $('#btnFinalizarActividadEquipo').hide();
                    break;
                case 'ENC':
                    $('#actividad_estado_equipo').addClass('badge-primary')
                    $('#btnIniciarActividadEquipo').hide();
                    break;
            }

            document.getElementById('actividad_id_equipo').value = response.respuesta['id_actividad'];
            document.querySelector('#actividad_nombre_equipo').innerText = response.respuesta['nombre_actividad'];
            document.querySelector('#actividad_prioridad_equipo').innerText = response.respuesta[
                'descripcion_larga'];
            document.getElementById('actividad_prioridad_equipo').value = response.respuesta['descripcion_larga'];
            document.querySelector('#actividad_estado_equipo').innerText = response.respuesta['estado'];
            document.getElementById('actividad_descripcion_equipo').value = response.respuesta['descripcion'];
            document.getElementById('actividad_fecha_asignacion_equipo').value = response.respuesta[
                'fecha_asignacion'];
            document.getElementById('actividad_fecha_fin_equipo').value = response.respuesta['fecha_fin'];
            document.getElementById('actividad_fecha_inicio_equipo').value = response.respuesta['fecha_inicio'];
            document.getElementById('actividad_fecha_entrega_equipo').value = response.respuesta['fecha_entrega'];
            document.getElementById('actividad_asignado_equipo').value = response.respuesta['nombre_equipo'];
            document.getElementById('actividad_proyecto_equipo').value = response.respuesta['nombre_proyecto'];

            console.log(response.respuesta)

            $('#btnIniciarActividadEquipo').on('click', function() {
                iniciarActividadEquipo(response.respuesta['id_actividad']);
            });

            $('#btnFinalizarActividadEquipo').on('click', function() {
                finalizarActividadEquipo(response.respuesta['id_actividad']);
            });
        })
        .catch(error => console.error('Error:', error))
}

function abrirForo(idAct){

    console.log('se abre el foro')
    console.log('id de actividad ' + idAct)

    window.location.href = `/forodudas/${idAct}`;
}

function iniciarActividadIndividual(idAct) {

    const fechayhora = fechayhora_actual();

    const TOKEN = `{{ csrf_token() }}`
    let obj = {
        id_actividad: idAct,
        fecha_inicio: fechayhora
    };
    fetch(`{{ url('/iniciar_actividad') }}`, {
            method: 'post',
            headers: {
                'X-CSRF-TOKEN': TOKEN,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(obj)
        })
        .then(response => response.json())
        .then(response => {

            if (response.respuesta == 1) {
                setTimeout( window.location = SITE + '/actividades_usuario',90000);
                return alertas(4, 'Has iniciado una actividad.');
            } else if (response.respuesta == 2) {
                //     //setTimeout( window.location = SITE + '/proyectos',90000);
                return alertas(3, 'Ocurrio un error, contacte al desarrollador.');
            } 

        })
        .catch(error => console.error('Error:', error))
}

function iniciarActividadEquipo(idAct) {
    const TOKEN = `{{ csrf_token() }}`
    const fechayhora = fechayhora_actual();

    let obj = {
        id_actividad: idAct,
        fecha_inicio: fechayhora
    };
    fetch(`{{ url('/iniciar_actividad') }}`, {
            method: 'post',
            headers: {
                'X-CSRF-TOKEN': TOKEN,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(obj)
        })
        .then(response => response.json())
        .then(response => {

            if (response.respuesta == 1) {
                setTimeout( window.location = SITE + '/actividades_usuario',90000);
                return alertas(4, 'Has iniciado una actividad.');
            } else if (response.respuesta == 2) {
                //     //setTimeout( window.location = SITE + '/proyectos',90000);
                return alertas(3, 'Ocurrio un error, contacte al desarrollador.');
            } 


        })
        .catch(error => console.error('Error:', error))
}

function finalizarActividadIndividual(idAct){
    const fechayhora = fechayhora_actual();
    //console.log(fechayhora)

    const TOKEN = `{{ csrf_token() }}`
    let obj = {
        id_actividad: idAct,
        fecha_entrega: fechayhora
    };
    fetch(`{{ url('/finalizar_actividad') }}`, {
            method: 'post',
            headers: {
                'X-CSRF-TOKEN': TOKEN,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(obj)
        })
        .then(response => response.json())
        .then(response => {

            if (response.respuesta == 1) {
                setTimeout( window.location = SITE + '/actividades_usuario',90000);
                return alertas(4, 'Has entregado una actividad.');
            } else if (response.respuesta == 2) {
                //     //setTimeout( window.location = SITE + '/proyectos',90000);
                return alertas(3, 'Ocurrio un error, contacte al desarrollador.');
            } 

        })
        .catch(error => console.error('Error:', error))
}

function finalizarActividadEquipo(idAct){
    const fechayhora = fechayhora_actual();
    //console.log(fechayhora)

    const TOKEN = `{{ csrf_token() }}`
    let obj = {
        id_actividad: idAct,
        fecha_entrega: fechayhora
    };
    fetch(`{{ url('/finalizar_actividad') }}`, {
            method: 'post',
            headers: {
                'X-CSRF-TOKEN': TOKEN,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(obj)
        })
        .then(response => response.json())
        .then(response => {
            if (response.respuesta == 1) {
                setTimeout( window.location = SITE + '/actividades_usuario',90000);
                return alertas(4, 'Has entregado una actividad.');
            } else if (response.respuesta == 2) {
                //     //setTimeout( window.location = SITE + '/proyectos',90000);
                return alertas(3, 'Ocurrio un error, contacte al desarrollador.');
            } 
        })
        .catch(error => console.error('Error:', error))
}

function alertas(id, mensaje) {
    if (id == 1) {
        return Swal.fire({
            icon: 'success',
            title: 'Bienvenido :D!',
            text: `${mensaje}`,
            showConfirmButton: true,
            timer: 300000
        });
    }
    if (id == 2) {
        return Swal.fire({
            icon: 'warning',
            title: 'Revise la informacion',
            text: `${mensaje}`,
            showConfirmButton: true,
            timer: 300000
        });
    }
    if (id == 3) {
        return Swal.fire({
            icon: 'error',
            title: 'Error',
            text: `${mensaje}`,
            showConfirmButton: true,
            timer: 300000
        });
    }
    if (id == 4) {
        return Swal.fire({
            icon: 'success',
            title: 'Operacion Exitosa',
            text: `${mensaje}`,
            showConfirmButton: false,
            timer: 300000
        });
    }
}
</script>
@stop

@section('css')
<!-- <link rel="stylesheet" href="/css/admin_custom.css"> -->
@stop

@section('js')
<!-- <script> console.log('Hi!'); </script> -->
@stop