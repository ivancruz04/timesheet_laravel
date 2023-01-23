@extends('adminlte::page')

@section('title', 'Equipos')

@section('content_header')
<h1>Equipos</h1>

@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card text-white bg-gradient-primary">
                <h5 class="card-header">Crear nuevo equipo de trabajo
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
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="text-dark">Nombre del equipo</label>
                                        <input id="input_nombre_equipo" type="text" class="form-control"
                                            placeholder="Nombre del equipo" required>
                                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="text-dark">Descripcion</label>
                                        <input id="input_descripcion_equipo" type="text" class="form-control"
                                            placeholder="Descripcion" required>
                                    </div>
                                    <div class="col-md-4 col-auto">
                                        <label class="text-white">Registrar equipo</label>
                                        <button type="button" id="boton"
                                            class="btn btn-primary btn-md btn-block">Agregar
                                            Equipo</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <!-- div de los cards de usuarios -->
                    <div class="card collapsed-card card-outline card-primary">
                        <div class="card-header bg-">
                            <h3 class="card-title">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">Usuarios Disponibles</font>
                                </font>
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="container-fluid">
                                <div class="row">
                                    @foreach($miembros as $miembro)
                                    <div class="col-3">
                                        <div class="card card-default shadow-lg" id="{{ $miembro->id}}">
                                            <div class="card-header mx-auto">
                                                <h3 class="card-title">
                                                    <div class="widget-user-image">
                                                        <img class="img-circle elevation-2"
                                                            src="{{ asset("/img/usuario2.png")}}" width="80"
                                                            height="80">
                                                    </div>
                                                </h3>
                                                <div class="card-tools">
                                                    <input class="valores" name="usuario" type="checkbox"
                                                        value="{{ $miembro->id}}">
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <font style="vertical-align: inherit;">
                                                    <font style="vertical-align: center;">
                                                        <p class="text-center text-bold">{{ $miembro->name}} |
                                                            {{ $miembro->descripcion_puesto}}</p>
                                                    </font>
                                                </font>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div> <!-- div de los cards de usuarios -->
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<!-- tabla de equipos -->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header bg-gradient-primary text-white">
                    Listado de equipos
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
                                    <table id="tabla_equipos" class="table table-bordered table-hover table-striped">
                                        <thead class="thead-primary text-center">
                                            <tr>
                                                <th>#</th>
                                                <th>Nombre</th>
                                                <th>Descripción</th>
                                                <th>Acciónes</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($equipos as $equipo )
                                            <tr class="text-center">
                                                <td>{{$equipo->id_equipo}}</td>
                                                <td>{{$equipo->nombre_equipo}}</td>
                                                <td>{{$equipo->descripcion}}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <div class="btn-group">
                                                            <input type="hidden" name="_token" id="token"
                                                                value="{{ csrf_token() }}">
                                                            <a onclick="eliminarEquipo({{ $equipo->id_equipo }}, $('#token').val())"
                                                                class="btn bg-gradient-danger ">
                                                                <i class="fas fa-trash"></i></a>

                                                            <a href="{{ url('/v_veractualizar_equipo',['idEquipo' => $equipo->id_equipo])}}"
                                                                class="btn bg-gradient-primary">
                                                                <i class="fa fa-eye"></i>
                                                                |
                                                                <i class="fas fa-pencil-alt"></i>
                                                            </a>
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
                <div class="card-footer">
                    <!-- cuerpo del footer -->
                </div>
            </div>
        </div>
    </div>
</div>


@stop

@section('css')
<!-- <link rel="stylesheet" href="/css/admin_custom.css"> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
@stop

@section('js')
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
<script>
$('#tabla_equipos').DataTable();
</script>
<script src="/js/equipos/equipos.js"></script>
<script src="/js/alertas.js"></script>
<script>
let SITE = `{{ url('/') }}`
//Recuperacion de datos del formulario
let e_nombre = document.getElementById('input_nombre_equipo');
let e_descripcion = document.getElementById('input_descripcion_equipo');
let _token = document.getElementById('token');
var boton = document.getElementById('boton');
var checks = document.querySelectorAll('.valores');

let i = 0;
let seleccionados = [];

boton.addEventListener('click', function() {
    //recupera los checkbox de los usuarios seleccionados
    checks.forEach((e) => {
        if (e.checked == true) {
            seleccionados[i] = e.value;
            i = i + 1;
        }
    });
    agregarEquipo(e_nombre.value, e_descripcion.value, seleccionados, _token.value);
    i = 0;
    seleccionados = [];
});

//Funcion para registrar un equipo
function agregarEquipo(nombre, descripcion, seleccionados, token) {

    console.log('entro en agregar')

    // const fecha = new Date();
    // const p_fecha_asignacion = fecha_actual(fecha)

    let obj = {
        nombre: nombre,
        descripcion: descripcion,
        seleccionados: seleccionados,
    };

    fetch(`{{ url('/registrar_equipo') }}`, {
            method: 'post',
            headers: {
                'X-CSRF-TOKEN': token,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(obj)
        })
        .then(response => response.json())
        .then(response => {

            console.log(response.respuesta)
            if (response.respuesta == 1) {
                setTimeout(window.location = SITE + '/equipos', 90000);
                return alertas(4, 'Se ha guardado correctamente.');
            } else if (response.respuesta == 2) {
                //setTimeout(window.location = SITE + '/equipos', 90000);
                return alertas(2, 'El nombre del proyecto ya esta en uso, No registrado!');
            } else if (response.respuesta == 3) {
                //setTimeout(window.location = SITE + '/equipos', 90000);
                return alertas(3, 'Ocurrio un error, contacte al desarrollador.');

            }
        })
        .catch(error => console.error('Error:', error))
}

function verActualizarEquipo(idEquipo) {
    fetch(`{{ url('/v_veractualizar_equipo') }}`, {
            method: 'post',
            headers: {
                'X-CSRF-TOKEN': token,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(obj)
        })
        .then(response => response.json())
        .then(response => {


        })
        .catch(error => console.error('Error:', error))
}


function fecha_actual(f) {
    return f.getFullYear() + "-" + (f.getMonth() + 1) + "-" + f.getDate()
}
</script>
@stop