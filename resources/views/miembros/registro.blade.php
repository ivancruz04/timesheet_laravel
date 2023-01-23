@extends('adminlte::page')

@section('title', 'Registro')

@section('content_header')
<h1 class="text-bold">registro</h1>

@stop

@section('content')



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Inicial</title>
</head>

<body>
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
                                                <input type="hidden" name="_token" id="token"
                                                    value="{{ csrf_token() }}">
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
                                                <input id="input_contraseña_usuario" type="password"
                                                    class="form-control" placeholder="Contraseña del usuario"
                                                    autocomplete="off" required>
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
</body>

</html>

@stop

@section('js')

<script>
let u_nombre = document.getElementById('input_nombre_usuario');
let u_correo = document.getElementById('input_correo_usuario');
let u_contraseña = document.getElementById('input_contraseña_usuario');
let u_puesto = document.getElementById('input_puesto_usuario');
let u_rol = document.getElementById('input_rol_usuario');
let _token = document.getElementById('token');

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
fetch(`{{ url('/registrar') }}`, {
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
            setTimeout( window.location = SITE + '/login',90000);
            return alertas(4, 'Usuario registrado correctamente.');
        } else if (response.respuesta == 2) {
            setTimeout( window.location = SITE + '/registro',90000);
            return alertas(2, 'Error al insertar!');
        } else if (response.respuesta == 3) {
            //setTimeout( window.location = SITE + '/miembros',90000);
            return alertas(3, 'Ocurrio un error, contacte al residente.');
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