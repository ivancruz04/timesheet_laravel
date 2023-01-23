@extends('adminlte::page')

@section('title', 'Actividades')

@section('content_header')
<h1 class="text-bold">Actividades</h1>

@stop

@section('content')

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
                                    <table class="table table-bordered table-hover table-striped"
                                        id="tabla_actividades">

                                        <thead class="thead-primary text-center bg-cyan color-palette">
                                            <tr>
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
                                                <th>Entrega</th>
                                                <th>Foro</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($act_individuales as $individuales)
                                            <tr>
                                                <td>{{$individuales->id_actividad}}</td>
                                                <td>{{$individuales->nombre_actividad}}</td>
                                                <td>{{$individuales->descripcion}}</td>
                                                <td>{{$individuales->fecha_asignacion}}</td>
                                                <td>{{$individuales->fecha_fin}}</td>
                                                <td>{{$individuales->fecha_inicio}}</td>
                                                <td>{{$individuales->fecha_entrega}}</td>
                                                <td>{{$individuales->name}}</td>
                                                <td>{{$individuales->nombre_proyecto}}</td>


                                                @switch($individuales->estado)
                                                @case('ENC')
                                                <td><span class="badge badge-primary"
                                                        id="estado">{{ $individuales->estado}}</span></td>
                                                @break
                                                @case('FIN')
                                                <td><span class="badge badge-success"
                                                        id="estado">{{ $individuales->estado}}</span></td>
                                                @break
                                                @case('DES')
                                                <td><span class="badge badge-warning"
                                                        id="estado">{{ $individuales->estado}}</span></td>
                                                @break
                                                @case('CAN')
                                                <td><span class="badge badge-danger"
                                                        id="estado">{{ $individuales->estado}}</span></td>
                                                @break
                                                @case('PEN')
                                                <td><span class="badge badge-secondary"
                                                        id="estado">{{ $individuales->estado}}</span></td>
                                                @break
                                                @endswitch

                                                <td>{{$individuales->descripcion_larga}}</td>
                                                <td>{{$individuales->estado_entrega}}</td>
                                                <td>
                                                    <a href="{{ url('/forodudas',['idAct' => $individuales->id_actividad])}}"
                                                        class="btn bg-gradient-primary" title="Abrir foro">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                </td>

                                            </tr>
                                            @endforeach
                                            @foreach($act_equipo as $equipo)
                                            <tr>
                                                <td>{{$equipo->id_actividad}}</td>
                                                <td>{{$equipo->nombre_actividad}}</td>
                                                <td>{{$equipo->descripcion}}</td>
                                                <td>{{$equipo->fecha_asignacion}}</td>
                                                <td>{{$equipo->fecha_fin}}</td>
                                                <td>{{$equipo->fecha_inicio}}</td>
                                                <td>{{$equipo->fecha_entrega}}</td>
                                                <td>{{$equipo->nombre_equipo}}</td>
                                                <td>{{$equipo->nombre_proyecto}}</td>


                                                @switch($equipo->estado)
                                                @case('ENC')
                                                <td><span class="badge badge-primary"
                                                        id="estado">{{ $equipo->estado}}</span></td>
                                                @break
                                                @case('FIN')
                                                <td><span class="badge badge-success"
                                                        id="estado">{{ $equipo->estado}}</span></td>
                                                @break
                                                @case('DES')
                                                <td><span class="badge badge-warning"
                                                        id="estado">{{ $equipo->estado}}</span></td>
                                                @break
                                                @case('CAN')
                                                <td><span class="badge badge-danger"
                                                        id="estado">{{ $equipo->estado}}</span></td>
                                                @break
                                                @case('PEN')
                                                <td><span class="badge badge-secondary"
                                                        id="estado">{{ $equipo->estado}}</span></td>
                                                @break
                                                @endswitch
                                                <td>{{$equipo->descripcion_larga}}</td>
                                                <td>{{$equipo->estado_entrega}}</td>
                                                <td>
                                                    <a href="{{ url('/forodudas',['idAct' => $equipo->id_actividad])}}"
                                                        class="btn bg-gradient-primary" title="Abrir foro">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
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

@stop

@section('css')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">

@stop

@section('js')
<script src="/js/actividades/actividades.js"></script>
<script src="/js/alertas.js"></script>

<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
<script>
$('#tabla_actividades').DataTable();
</script>
@stop