@extends('adminlte::page')

@section('title', 'Proyectos')

@section('content_header')
<h1>Proyectos</h1>

@stop

@section('content')



<div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header text-white" style="background:#007bff;">
            <h4 class="modal-title">Editar proyecto</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"></span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <form action="">
                        @foreach ($consulta_actualizacion_equipo as $proy_consultado_equipo)
                        <div class="row">
                            <div class="col-md-4">
                                <label class="text-dark">Nombre</label>
                                <input id="input_nombre_proyecto_equipo_act" type="text" class="form-control"
                                    value="{{$proy_consultado_equipo->nombre_proyecto}}" required>
                                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                            </div>
                            <div class="col-md-4">
                                <label class="text-dark">Fecha de inicio</label>
                                <input id="input_fecha_inicio_equipo_act" name='input_fecha_inicio_equipo' type="date"
                                    class="form-control" value="{{$proy_consultado_equipo->fecha_inicio}}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="text-dark">Fecha de finalización</label>
                                <input id="input_fecha_finalizacion_equipo_act" name='input_fecha_finalizacion_equipo'
                                    type="date" class="form-control"
                                    value="{{$proy_consultado_equipo->fecha_finalizacion}}" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="text-dark">Descripción</label>
                                <input id="input_descripcion_equipo_act" name='input_descripcion_equipo' type="text"
                                    class="form-control" value="{{$proy_consultado_equipo->descripcion}}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="text-dark">Asignado a:</label>
                                <select class="form-control" id="select_asignado_equipo_act"
                                    name='select_asignado_equipo' required>
                                    <optgroup label="Asignado a:">
                                        <option value="{{$proy_consultado_equipo->id_equipo}}">
                                            {{$proy_consultado_equipo->nombre_equipo}}</option>
                                    </optgroup>

                                    <optgroup label="Asignar a otro:">
                                        @foreach($otros_equipos as $otros)
                                        <option value="{{ $otros->id_equipo }}">{{$otros->nombre_equipo}}</option>
                                        @endforeach
                                    </optgroup>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-2">
                                    </div>
                                    <div class="col-md-8">
                                        <br>
                                        <!-- <button type="button" onclick="actualizarProyecto()"
                                            class="btn btn-primary btn-md btn-block">Actualizar
                                            Proyecto</button> -->
                                    </div>
                                    <div class="col-md-2">
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
            <a href="{{ url('/proyectos')}}" type="button" class="btn btn-danger">Cancelar</a>
            <a onclick="actualizarProyecto({{$proy_consultado_equipo->id}})" class="btn btn-success">Guardar
                cambios</a>
        </div>
        @endforeach
        </form>
    </div>
</div>

</div>

<script>
//Recuperacion de datos del formulario
let p_nombre = document.getElementById('input_nombre_proyecto_equipo_act');
let p_fecha_inicio = document.getElementById('input_fecha_inicio_equipo_act');
let p_fecha_fin = document.getElementById('input_fecha_finalizacion_equipo_act');
let p_descripcion = document.getElementById('input_descripcion_equipo_act');
let p_asignado = document.getElementById('select_asignado_equipo_act');
let _token = document.getElementById('token');

//funcion para actualizar informacion del proyecto
function actualizarProyecto(idProy) {
    
    let obj = {
        id: idProy,
        nombre: p_nombre.value,
        fecha_ini: p_fecha_inicio.value,
        fecha_fin: p_fecha_fin.value,
        descripcion: p_descripcion.value,
        asignado_eq: p_asignado.value

    };
    console.log('datos a actualizar')
    console.log(obj)

    fetch(`{{ url('/actualizar_proyecto_equipo') }}`, {
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
            //setTimeout( window.location = SITE + '/proyectos',90000);
            return alertas(4, 'Informacion actualizada correctamente.');
        } else if (response.respuesta == 2) {
            //setTimeout( window.location = SITE + '/proyectos',90000);
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

@section('css')

@stop