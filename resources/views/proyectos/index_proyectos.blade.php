@extends('adminlte::page')

@section('title', 'Proyectos')

@section('content_header')
<h1>Proyectos</h1>

@stop

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card text-white bg-primary shadow-lg">
                <h5 class="card-header"><i class="fa fa-rocket"></i> Crear Nuevo Proyecto
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
                    <p class="card-text">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="text-dark">Nombre</label>
                                            <input id="input_nombre_proyecto" type="text" class="form-control"
                                                placeholder="Nombre del proyecto" required>
                                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="text-dark">Fecha de inicio</label>
                                            <input id="input_fecha_inicio" name='input_fecha_inicio' type="date"
                                                class="form-control" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="text-dark">Fecha de finalización</label>
                                            <input id="input_fecha_finalizacion" name='input_fecha_finalizacion'
                                                type="date" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="text-dark">Descripción</label>
                                            <input id="input_descripcion" name='input_descripcion' type="text"
                                                class="form-control" placeholder="Descripcion del proyecto" required>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label class="text-dark">Asignar usuario:</label>
                                                        <select class="form-control" id="select_asignado_usuario"
                                                            name='select_asignado_usuario' required>
                                                            <option value=""></option>
                                                            @foreach ($miembros as $miembro)
                                                            <option value="{{ $miembro->id }}">{{ $miembro->name }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="text-dark">Asignar equipo:</label>
                                                        <select class="form-control" id="select_asignado_equipo"
                                                            name='select_asignado_equipo' required>
                                                            <option value=" "></option>
                                                            @foreach ($equipos as $equipo)
                                                            <option value="{{ $equipo->id_equipo }}">
                                                                {{ $equipo->nombre_equipo }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col-md-2">
                                                </div>
                                                <div class="col-md-8">
                                                    <br>
                                                    <button type="button" onclick="agregarProyecto()"
                                                        class="btn btn-primary btn-md btn-block">Agregar Proyecto
                                                    </button>
                                                </div>
                                                <div class="col-md-2">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<br>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <h5 class="card-header bg-primary text-white shadow-lg">
                    <i class='fa fa-list-ul'></i>
                    Listado de proyectos
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
                                    <table id="tabla_proyectos" class="table table-bordered table-hover table-striped">
                                        <thead class="thead-primary text-center">
                                            <tr>
                                                <th>#</th>
                                                <th>Nombre</th>
                                                <th>Fecha de Asignacion</th>
                                                <th>Fecha de Inicio</th>
                                                <th>Fecha de Finalizacion</th>
                                                <th>Descripción</th>
                                                <th>Asignado a:</th>
                                                <th>Estado</th>
                                                <th>Acciónes</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- tabla para que muestre los proyectos asignados a usuarios individuales -->
                                            @foreach ($proyectos_consulta_usuarios as $proyecto_usuarios)
                                            <tr class="text-center">
                                                <td>{{ $proyecto_usuarios->id}}</td>
                                                <td>{{ $proyecto_usuarios->nombre_proyecto}}</td>
                                                <td>{{ $proyecto_usuarios->fecha_asignacion}}</td>
                                                <td>{{ $proyecto_usuarios->fecha_inicio}}</td>
                                                <td>{{ $proyecto_usuarios->fecha_finalizacion}}</td>
                                                <td>{{ $proyecto_usuarios->descripcion}}</td>
                                                <td>{{ $proyecto_usuarios->name}}</td>
                                                @switch($proyecto_usuarios->estado)
                                                @case('ENC')
                                                <td><span class="badge badge-primary"
                                                        id="estado">{{ $proyecto_usuarios->estado}}</span></td>
                                                @break
                                                @case('FIN')
                                                <td><span class="badge badge-success"
                                                        id="estado">{{ $proyecto_usuarios->estado}}</span></td>
                                                @break
                                                @case('DES')
                                                <td><span class="badge badge-warning"
                                                        id="estado">{{ $proyecto_usuarios->estado}}</span></td>
                                                @break
                                                @case('CAN')
                                                <td><span class="badge badge-danger"
                                                        id="estado">{{ $proyecto_usuarios->estado}}</span></td>
                                                @break
                                                @case('PEN')
                                                <td><span class="badge badge-secondary"
                                                        id="estado">{{ $proyecto_usuarios->estado}}</span></td>
                                                @break
                                                @endswitch
                                                <td>
                                                    <div class="btn-group">
                                                        <a onclick="cancelarProyecto({{$proyecto_usuarios->id}})"
                                                            class="btn bg-gradient-danger" title="Cancelar">
                                                            <i class="fas fa-trash"></i></a>

                                                        <a href="{{ url('/v_actualizar_proyecto',['idProy' => $proyecto_usuarios->id])}}"
                                                            class="btn bg-gradient-primary" title="Editar">
                                                            <i class="fas fa-pencil-alt"></i></a>

                                                        <a onclick="finalizarProyecto({{$proyecto_usuarios->id}})"
                                                            class="btn bg-gradient-success" title="Finalizar">
                                                            <i class="fa fa-check-circle"></i></a>

                                                        <a onclick="abrirModalActividad({{$proyecto_usuarios->id}})"
                                                            class="btn bg-gradient-warning" title="Asignar actividad">
                                                            <i class="fas fa-laptop-code"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                            <!-- tabla para que muestre los proyectos asignados a equipos -->
                                            @foreach ($proyectos_consulta_equipos as $proyecto_equipos)

                                            <tr class="text-center">
                                                <td id="col_id">{{ $proyecto_equipos->id}}</td>
                                                <td id="col_nombre">{{ $proyecto_equipos->nombre_proyecto}}</td>
                                                <td id="col_fecha_asig">{{ $proyecto_equipos->fecha_asignacion}}</td>
                                                <td id="col_fecha_ini">{{ $proyecto_equipos->fecha_inicio}}</td>
                                                <td id="col_fecha_fin">{{ $proyecto_equipos->fecha_finalizacion}}</td>
                                                <td id="col_desc">{{ $proyecto_equipos->descripcion}}</td>
                                                <td id="col_quien">{{ $proyecto_equipos->nombre_equipo}}</td>

                                                @switch($proyecto_equipos->estado)
                                                @case('ENC')
                                                <td><span class="badge badge-primary"
                                                        id="estado">{{ $proyecto_equipos->estado}}</span></td>
                                                @break
                                                @case('FIN')
                                                <td><span class="badge badge-success"
                                                        id="estado">{{ $proyecto_equipos->estado}}</span></td>
                                                @break
                                                @case('DES')
                                                <td><span class="badge badge-warning"
                                                        id="estado">{{ $proyecto_equipos->estado}}</span></td>
                                                @break
                                                @case('CAN')
                                                <td><span class="badge badge-danger"
                                                        id="estado">{{ $proyecto_equipos->estado}}</span></td>
                                                @break
                                                @case('PEN')
                                                <td><span class="badge badge-secondary"
                                                        id="estado">{{ $proyecto_equipos->estado}}</span></td>
                                                @break
                                                @endswitch
                                                <td>
                                                    <div class="btn-group">
                                                        <a onclick="cancelarProyecto({{$proyecto_equipos->id}})"
                                                            class="btn bg-gradient-danger" title="Cancelar">
                                                            <i class="fas fa-trash"></i></a>

                                                        <a href="{{ url('/v_actualizar_proyecto_equipo',['idProy' => $proyecto_equipos->id])}}"
                                                            class="btn bg-gradient-primary" title="Editar">
                                                            <i class="fas fa-pencil-alt"></i></a>

                                                        <a onclick="finalizarProyecto({{$proyecto_equipos->id}})"
                                                            class="btn bg-gradient-success" title="Finalizar">
                                                            <i class="fa fa-check-circle"></i></a>
                                                        <a onclick="abrirModalActividad({{$proyecto_equipos->id}})"
                                                            class="btn bg-gradient-warning" title="Asignar actividad">
                                                            <i class="fas fa-laptop-code"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
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

<div class="modal fade hide " id="modal-descripcion" style="padding-right: 17px;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">Asignar Actividad</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="text-dark" style="text-bold">Nombre de la actividad:</label>
                                        <input id="input_nombre_actividad" type="text" class="form-control"
                                            placeholder="Nombre de la actividad" required>
                                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="text-dark" style="text-bold">Descripcion:</label>
                                        <textarea id="input_descripcion_actividad" type="text" class="form-control"
                                            placeholder="Descripcion de la actividad" required rows="7"></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="text-dark">Fecha para entregar:</label>
                                        <!-- <input id="input_fecha_finalizacion_actividad"
                                            name='input_fecha_finalizacion_actividad' type="datetime-local"
                                            class="form-control" required> -->
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="text-dark">Dia:</label>
                                                    <input id="input_fecha_finalizacion_actividad"
                                                        name='input_fecha_finalizacion_actividad' type="date"
                                                        class="form-control" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="text-dark">Hora:</label>
                                                    <input id="input_hora_finalizacion_actividad"
                                                        name='input_hora_finalizacion_actividad' type="time"
                                                        class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <label class="text-dark">Prioridad:</label>
                                        <select class="form-control" id="select_prioridad_actividad"
                                            name='select_prioridad_actividad' required>

                                            @foreach ($prioridad_act as $prioridad)
                                            <option value="{{ $prioridad->id_prioridad }}">
                                                {{ $prioridad->descripcion_larga }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button id="btnAsignarActividad" type="button" class="btn btn-primary ">
                    Asignar Actividad
                </button>
            </div>
            </form>
        </div>
    </div>
</div>



@stop

@section('css')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">

@stop

@section('js')
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $('#tabla_proyectos').DataTable();
    </script>
<script>
//Recuperacion de datos del formulario
let p_nombre = document.getElementById('input_nombre_proyecto');
let p_fecha_inicio = document.getElementById('input_fecha_inicio');
let p_fecha_fin = document.getElementById('input_fecha_finalizacion');
let p_descripcion = document.getElementById('input_descripcion');
let p_asignado_usuario = document.getElementById('select_asignado_usuario');
let p_asignado_equipo = document.getElementById('select_asignado_equipo');
let _token = document.getElementById('token');

let SITE = `{{ url('/') }}`


//Funcion para registrar un proyecto
function agregarProyecto() {
    const fecha = new Date();
    const p_fecha_asignacion = fecha_actual(fecha)

    let obj = {
        nombre: p_nombre.value,
        fecha_ini: p_fecha_inicio.value,
        fecha_fin: p_fecha_fin.value,
        descripcion: p_descripcion.value,
        asignado_usuario: p_asignado_usuario.value,
        asignado_equipo: p_asignado_equipo.value,
        fecha_asignacion: p_fecha_asignacion
    };

    fetch(`{{ url('/registrar_proyecto') }}`, {
            method: 'post',
            headers: {
                'X-CSRF-TOKEN': _token.value,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(obj)
        })
        .then(response => response.json())
        .then(response => {
            console.log(response.respuesta)
            //console.log(response.respuesta)
            if (response.respuesta == 1) {
                setTimeout(window.location = SITE + '/proyectos', 90000);
                return alertas(4, 'Se ha guardado correctamente.');
            } else if (response.respuesta == 2) {
                //setTimeout( window.location = SITE + '/proyectos',90000);
                return alertas(2, 'El nombre del proyecto ya esta en uso, No registrado!');
            } else if (response.respuesta == 3) {
                //setTimeout( window.location = SITE + '/proyectos',90000);
                return alertas(3, 'Ocurrio un error, contacte al desarrollador.');
            }
        })
        .catch(error => console.error('Error:', error))
}

//funcion para cancelar el proyecto
function cancelarProyecto(idProy) {

    let obj = {
        id: idProy
    };
    fetch(`{{ url('/cancelar_proyecto') }}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': `{{ csrf_token() }}`,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(obj)
        })
        .then(response => response.json())
        .then(response => {
            console.log('la respuesta es: ')
            console.log(response.respuesta);
            if (response.respuesta == 1) {
                //setTimeout(window.location = SITE + '/proyectos', 90000);
                return alertas(4, 'Se ha cancelado correctamente.');
            } else if (response.respuesta == 2) {
                // setTimeout(window.location = SITE + '/proyectos', 90000);
                return alertas(2, 'El proyecto ya se encuentra finalizado.');
            } else if (response.respuesta == 3) {
                return alertas(3, 'El proyecto ya se encuentra cancelado');
                //setTimeout(window.location = SITE + '/proyectos', 90000);
            } else if (response.respuesta == 4) {
                //setTimeout(window.location = SITE + '/proyectos', 90000);
                return alertas(3, 'Ocurrio un error, consulte al desarrollador');
            }
        })
        .catch(error => console.error('Error:', error))

}

//funcion para finalizar un proyecto
function finalizarProyecto(idProy) {

    const fecha = new Date();
    const p_fecha_fin = fecha_actual(fecha)

    let obj = {
        id: idProy,
        fecha_fin: p_fecha_fin
    };
    fetch(`{{ url('/finalizar_proyecto') }}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': `{{ csrf_token() }}`,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(obj)
        })
        .then(response => response.json())
        .then(response => {
            console.log('la respuesta es: ')
            console.log(response.respuesta)
            if (response.respuesta == 1) {
                return alertas(4, 'Se ha finalizado correctamente.');
            } else if (response.respuesta == 2) {
                return alertas(2, 'El proyecto ya se encuentra finalizado.');
            } else if (response.respuesta == 3) {
                return alertas(3, 'No se pudo finalizar, el proyecto esta cancelado.');
            } else if (response.respuesta == 4) {
                return alertas(3, 'Ocurrio un error, consulte al desarrollador');
            }
        })
        .catch(error => console.error('Error:', error))

}

function abrirModalActividad(idProy) {
    $('#modal-descripcion').modal('show');


    $('#btnAsignarActividad').on('click', function() {
        asignarActividad(idProy);
    });
}

function asignarActividad(idProy) {
    var a_nombre = document.getElementById('input_nombre_actividad');
    var a_fecha_fin = document.getElementById('input_fecha_finalizacion_actividad');
    var a_hora_fin = document.getElementById('input_hora_finalizacion_actividad');
    var a_descripcion = document.getElementById('input_descripcion_actividad');
    var a_prioridad = document.getElementById('select_prioridad_actividad');
    var _token = document.getElementById('token');
    var fecha_fin = a_fecha_fin.value + ' ' + a_hora_fin.value + ':00';
    //fecha y hora actual en que se registra la actividad
    var hoy = new Date();
    var fecha = hoy.getFullYear() + '-' + (hoy.getMonth() + 1) + '-' + hoy.getDate();
    var hora = hoy.getHours() + ':' + hoy.getMinutes() + ':' + hoy.getSeconds();
    var fechayhora = fecha + ' ' + hora;

    let obj = {
        nombre: a_nombre.value,
        idProyecto: idProy,
        fecha_asig: fechayhora,
        fecha_fin: fecha_fin,
        descripcion: a_descripcion.value,
        prioridad: a_prioridad.value
    };
    console.log(obj)
    fetch(`{{ url('/asignar_actividades') }}`, {
            method: 'post',
            headers: {
                'X-CSRF-TOKEN': _token.value,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(obj)
        })
        .then(response => response.json())
        .then(response => {
            console.log(response.respuesta)

            if (response.respuesta == 1) {
                setTimeout(window.location = SITE + '/proyectos', 90000);
                return alertas(4, 'Actividad asignada, Notificado!.');
            } else if (response.respuesta == 2) {
                setTimeout(window.location = SITE + '/proyectos', 90000);
                return alertas(3, 'Ocurrio un error, contacte al desarrollador.');
            } else if (response.respuesta == 3) {

                return alertas(2, 'Fechas no validas, Actividad no registrada.');
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


function fecha_actual(f) {
    return f.getFullYear() + "-" + (f.getMonth() + 1) + "-" + f.getDate()
}
</script>
@stop