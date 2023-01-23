@extends('adminlte::page')

@section('title', 'Usuarios')

<!-- @section('Datatables', true) -->
@section('Sweetalert2', true)

@section('content_header')
<h1>Usuarios</h1>

@stop

@section('content')

<br>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card text-white ">
                <h5 class="card-header bg-primary">Registra usuarios</h5>
                <div class="card-body bg-white">
                    <p class="card-text">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="text-dark">Nombre</label>
                                            <input id="input_nombre_usuario" type="text" class="form-control"
                                                placeholder="Nombre del usuario" required>
                                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                        </div>

                                        <div class="col-md-4">
                                            <label class="text-dark">Correo</label>
                                            <input id="input_correo_usuario" type="email" class="form-control"
                                                placeholder="correo@dominio.com" required>
                                        </div>

                                        <div class="col-md-4">
                                        <label class="text-dark">Rol</label>
                                        <select id="input_rol_usuario" class="form-control" required>
                                            @foreach ($roles as $rol)
                                                <option value="{{$rol->name}}">{{$rol->name}}
                                                </option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="text-dark">Contraseña</label>
                                            <input id="input_contraseña_usuario" type="password" class="form-control"
                                                placeholder="Contraseña del usuario" autocomplete="off" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="text-dark">Puesto</label>
                                            <select id="input_puesto_usuario" class="form-control" required>
                                                @foreach ($puestos as $puesto)
                                                <option value="{{ $puesto->id_puesto }}">{{ $puesto->descripcion }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            
                                            <label class="text-white">Puesto</label><br>
                                                
                                                
                                                    
                                                    <button type="button" onclick="agregarUsuario()"
                                                        class="btn btn-primary btn-md btn-block">Agregar
                                                        Usuario</button>
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
                <h5 class="card-header bg-primary text-white">
                    Listado de usuarios
                </h5>
                <div class="card-body bg-white">
                    <p class="card-text">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <table id="tabla_miembros" class="table table-bordered table-hover table-striped">
                                    <thead class="thead-primary text-center">
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Correo Electronico</th>
                                            <th>Puesto</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($miembros as $miembro)
                                        <tr class="text-center">
                                            <td>{{ $miembro->id}}</td>
                                            <td>{{ $miembro->name}}</td>
                                            <td>{{ $miembro->email}}</td>
                                            <td>{{ $miembro->descripcion}}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a onclick="eliminarUsuario({{ $miembro->id }})"
                                                        class="btn bg-gradient-danger ">
                                                        <i class="fas fa-trash"></i></a>

                                                    <a onclick="ModalActualizarUsuario({{ $miembro->id }})"
                                                        class="btn bg-gradient-primary ">
                                                        <i class="fas fa-pencil-alt"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                
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


<div class="modal fade hide " id="modal-actualizar-miembro" style="padding-right: 17px;" aria-modal="true"
    role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Actualizar datos de usuario<h4 class="modal-title"></h4>
                </h4>

                <a id="btnsalir" name="btnsalir" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </a>
            </div>
            <div class="modal-body">

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="text-center">
                                        <img src="{{ asset("/img/usuario2.png")}}" width="150" height="150"
                                            class="rounded">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="text-dark">Nombre</label>
                                            <input id="input_nombre_usuario_act" type="text" class="form-control"
                                                required>
                                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="text-dark">Correo</label>
                                            <input id="input_correo_usuario_act" type="email" class="form-control"
                                                required>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <!-- <div class="col-md-6">
                                            <label class="text-dark">Contraseña</label>
                                            <input id="input_contraseña_usuario_act" type="text" class="form-control"
                                                autocomplete="off" required>
                                        </div> -->
                                        <div class="col-md-12">
                                            <label class="text-dark">Puesto</label>
                                            <select class="form-control" id="select_puesto_usuario_act"
                                                name='select_puesto' required>

                                                <optgroup id="asignado_actual" name="asignado_actual"
                                                    label="Puesto actual:">
                                                </optgroup>
                                                <optgroup label="Asignar otro puesto:">
                                                    @foreach($puestos as $otros)
                                                    <option value="{{ $otros->id_puesto }}">{{$otros->descripcion}}
                                                    </option>
                                                    @endforeach
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <!-- Aqui van los botones de accion (iniciar, rechazar) -->
                <a id="btnsalir" name="btnsalir" type="button" class="btn bg-gradient-danger"
                    data-dismiss="modal">Cerrar</a>
                <div class="btn-group">
                    <button id="btnActualizarUsuario" type="button" class="btn bg-gradient-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let u_nombre = document.getElementById('input_nombre_usuario');
let u_correo = document.getElementById('input_correo_usuario');
let u_contraseña = document.getElementById('input_contraseña_usuario');
let u_puesto = document.getElementById('input_puesto_usuario');
let u_rol = document.getElementById('input_rol_usuario');

let _token = document.getElementById('token');

let TOKEN = `{{ csrf_token() }}`
let SITE = `{{ url('/') }}`


function agregarUsuario() {

    let obj = {
        nombre: u_nombre.value,
        correo: u_correo.value,
        contra: u_contraseña.value,
        puesto: u_puesto.value,
        rol: u_rol.value
        //foto: u_foto.value
    };
    console.log('elementos a enviar')
    console.log(obj)
    fetch(`{{ url('/registrar_miembro') }}`, {
            method: 'post',
            headers: {
                'X-CSRF-TOKEN': _token.value,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(obj)
        })
        .then(response => response.json())
        .then(response => {
            if (response.respuesta == 1) {
                //setTimeout( window.location = SITE + '/miembros',90000);
                return alertas(4, 'Usuario registrado correctamente.');
            } else if (response.respuesta == 2) {
                //setTimeout( window.location = SITE + '/miembros',90000);
                return alertas(2, 'Error al insertar!');
            } else if (response.respuesta == 3) {
                //setTimeout( window.location = SITE + '/miembros',90000);
                return alertas(3, 'Ocurrio un error, contacte al residente.');
            }
        })
        .catch(error => console.error('Error:', error))
}

function eliminarUsuario(idUsu) {
    let obj = {
        id_usuario: idUsu
    };
    fetch(`{{ url('/eliminar_usuario') }}`, {
            method: 'post',
            headers: {
                'X-CSRF-TOKEN': TOKEN,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(obj)

        })
        .then(response => response.json())
        .then(response => {
            console.log('la respuesta es')
            console.log(response.respuesta)
            if (response.respuesta == 1) {
                setTimeout(window.location = SITE + '/miembros', 90000);
                return alertas(4, 'Usuario eliminado correctamente.');
            } else if (response.respuesta == 2) {
                //setTimeout( window.location = SITE + '/miembros',90000);
                return alertas(3, 'Ocurrio un error, contacte al residente.');
            }
        })
        .catch(error => console.error('Error:', error))

}

function ModalActualizarUsuario(idUsu) {

    $('#modal-actualizar-miembro').modal('show');

    const TOKEN = `{{ csrf_token() }}`
    let obj = {
        id_usuario: idUsu
    };
    fetch(`{{ url('/consultar_miembro') }}`, {
            method: 'post',
            headers: {
                'X-CSRF-TOKEN': TOKEN,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(obj)
        })
        .then(response => response.json())
        .then(response => {

            document.querySelector('#input_nombre_usuario_act').value = response.respuesta[
                'name'];
            document.querySelector('#input_correo_usuario_act').value = response.respuesta[
                'email'];
            // document.querySelector('#input_contraseña_usuario_act').value = response.respuesta[
            //     'contra'];

            document.querySelector("#asignado_actual").innerHTML += "<option value='" + response
                .respuesta[
                    'id_puesto'] + "' selected>" + response.respuesta['descripcion_puesto'] + "</option>";

            $('#btnActualizarUsuario').on('click', function() {
                actualizarUsuario(response.respuesta['id']);
            });

        })
        .catch(error => console.error('Error:', error))

}

function actualizarUsuario(idUsu) {
    const act_nombre = document.getElementById('input_nombre_usuario_act');
    const act_correo = document.getElementById('input_correo_usuario_act');
    const act_puesto = document.getElementById('select_puesto_usuario_act');
    const _token = document.getElementById('token');

    let obj = {
        id: idUsu,
        name: act_nombre.value,
        email: act_correo.value,
        id_puesto: act_puesto.value
    };
    console.log('datos a actualizar')
    console.log(obj)

    fetch(`{{ url('/actualizar_miembro') }}`, {
            method: 'POST',
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
                setTimeout(window.location = SITE + '/miembros', 90000);
                return alertas(4, 'Informacion actualizada correctamente.');
            } else if (response.respuesta == 2) {
                //setTimeout( window.location = SITE + '/proyectos',90000);
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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
@stop

@section('js')

<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
<script>
$('#tabla_miembros').DataTable();
</script>

@stop