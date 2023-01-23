@extends('adminlte::page')

@section('title', 'Puestos')

@section('content_header')
<h1>Puestos</h1>
@stop

@section('content')
<div class="row">

    <div class="col-md-5 col-sm-6 col-12">
        <div class="card card-default shadow-lg" id="">
            <div class="card-header bg-primary">
                <h3 class="card-title">
                    <i class="fas fa-keyboard"></i>
                    Registrar puesto
                </h3>
                <div class="card-tools">
                </div>
            </div>
            <div class="card-body">

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="text-dark">Puesto</label>
                            <input id="descripcion_puesto" type="text" class="form-control" placeholder="Ej:Desarrollador"
                                required>
                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                        </div>
                        <div class="col-md-6">
                            <label class="text-white">puesto</label>
                            <button type="button" id="btnregistrar_puesto" class="btn btn-primary btn-md btn-block">Agregar
                                Puesto</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-7 col-sm-8 col-12">
        <div class="card shadow-lg">
            <div class="card-header bg-primary">
                <h3 class="card-title">
                    <i class="fa fa-bars"></i>
                    Puestos
                </h3>
            </div>
            <div class="card-body">

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="tabla_puestos" class="table table-bordered table-hover table-striped">
                                <thead class="thead-primary text-center">
                                    <tr>
                                        <th>#</th>
                                        <th>Puesto</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($puestos as $puesto)
                                    <tr class="text-center">
                                        <td>{{$puesto->id_puesto}}</td>
                                        <td>{{$puesto->descripcion}}</td>
                                        <td>
                                            <div class="btn-group">
                                                <div class="">
                                                    <input type="hidden" name="_token" id="token"
                                                        value="{{ csrf_token() }}">
                                                    <a onclick="eliminarPuesto({{ $puesto->id_puesto }}, $('#token').val())"
                                                        class="btn bg-gradient-danger ">
                                                        <i class="fas fa-trash"></i></a>

                                                </div>
                                            </div>
                                        </td>
                                        @endforeach
                                    </tr>

                                </tbody>

                            </table>

                        </div>
                    </div>
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
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
<script>
    $('#tabla_puestos').DataTable();
</script>
<script src="/js/catalogos/puestos.js"></script>
<script src="/js/alertas.js"></script>
@stop