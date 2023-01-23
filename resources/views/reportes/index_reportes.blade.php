@extends('adminlte::page')

@section('title', 'Reportes')

@section('content_header')
<h1 class="text-bold">Actividades</h1>

@stop

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-info"></i> Exportar Reporte</h5>
                Consulta las actividades de acuerdo a usuario/equipo y fecha.
            </div>
            <div class="card">
                <h5 class="card-header bg-gradient-primary text-white">
                    Buscar Actividades Individuales
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
                                    <div class="col-md-3">
                                        <label class="text-dark">Usuario:</label>
                                        <select class="form-control" id="select_usuario" name='select_usuario'
                                            required>
                                            <option value=" "></option>
                                            @foreach ($usuarios as $usuarios)
                                            <option value="{{ $usuarios->id }}">
                                                {{ $usuarios->name }}</option>
                                            @endforeach
                                        </select>
                                        
                                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="text-dark">Desde:</label>
                                        <input type="date" name="act_individual_desde" id="act_individual_desde" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="text-dark">Hasta:</label>
                                        <input type="date" name="act_individual_hasta" id="act_individual_hasta" class="form-control">

                                    </div>
                                    <div class="col-md-3 col-auto">
                                        <label class="text-white">Buscar</label>
                                        <button type="button" id="btnExportarIndividual" onclick="exportarActividadesIndividual()"
                                            class="btn btn-primary btn-md btn-block">Exportar</button>
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

<!--  -->

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <!-- <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-info"></i> Exportar Reporte</h5>
                Consulta las actividades de acuerdo a usuario y fecha.
            </div> -->
            <div class="card">
                <h5 class="card-header bg-gradient-primary text-white">
                    Buscar Actividades en Equipo
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
                                    <div class="col-md-3">
                                        <label class="text-dark">Equipo:</label>
                                        <select class="form-control" id="select_equipo" name='select_equipo'
                                            required>
                                            <option value=" "></option>
                                            @foreach ($equipos as $equipos)
                                            <option value="{{ $equipos->id_equipo }}">
                                                {{ $equipos->nombre_equipo }}</option>
                                            @endforeach
                                        </select>
                                        
                                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="text-dark">Desde:</label>
                                        <input type="date" name="act_equipo_desde" id="act_equipo_desde" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="text-dark">Hasta:</label>
                                        <input type="date" name="act_equipo_hasta" id="act_equipo_hasta" class="form-control">

                                    </div>
                                    <div class="col-md-3 col-auto">
                                        <label class="text-white">Buscar</label>
                                        <button type="button" id="btnExportar" onclick="exportarActividadesEquipo()"
                                            class="btn btn-primary btn-md btn-block">Exportar</button>
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


<!-- <a href="{{ route('imprimir') }}">Exportar PDF</a> -->


@stop

@section('css')

@stop

@section('js')
<script src="/js/reportes/reportes.js"></script>
<script src="/js/alertas.js"></script>
@stop