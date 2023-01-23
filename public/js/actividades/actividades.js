$("#btnbuscarActividad").click(function () {

    limpiarTabla()    

        let s_proyecto = document.getElementById('select_proyecto');
    let _token = document.getElementById('token');

    let obj = {
        id_proyecto: s_proyecto.value
    };
    console.log('envio')
    console.log(obj)

    fetch(('/consultar_actividades'), {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': _token.value,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(obj)
        })
        .then(response => response.json())
        .then(response => {
            console.log(response.datos)
            let datos = response.datos;

            if(datos.length == 0){
                Swal.fire({
                    icon: 'warning',
                    title: 'Proyecto sin actividades',
                    text: '',
                    showConfirmButton: true,
                    timer: 300000
                });
            }else{
                if(response.tipo_actividad == 2){


                    var d = '<tr>'+
                    '<th>ID</th>'+
                    '<th>Nombre</th>'+
                    '<th>Descripcion</th>'+
                    '<th>Fecha Asignacion</th>'+
                    '<th>Fecha Finalizacion</th>'+
                    '<th>Fecha Inicio</th>'+
                    '<th>Fecha Entrega</th>'+
                    '<th>Asignado a</th>'+
                    '<th>Proyecto</th>'+
                    '<th>Estado</th>'+
                    '<th>Prioridad</th>'+
                    '</tr>';
    
                    for(var i = 0; i < datos.length; i++){
                        d+= '<tr>'+
                            '<td>'+datos[i].id_actividad+'</td>'+
                            '<td>'+datos[i].nombre_actividad+'</td>'+
                            '<td>'+datos[i].descripcion+'</td>'+
                            '<td>'+datos[i].fecha_asignacion+'</td>'+
                            '<td>'+datos[i].fecha_fin+'</td>'+
                            '<td>'+datos[i].fecha_inicio+'</td>'+
                            '<td>'+datos[i].fecha_entrega+'</td>'+
                            '<td>'+datos[i].nombre_equipo+'</td>'+
                            '<td>'+datos[i].nombre_proyecto+'</td>'+
                            '<td>'+datos[i].estado+'</td>'+
                            '<td>'+datos[i].descripcion_larga+'</td>'+
                        '</tr>';
                    }
                }else if(response.tipo_actividad == 1){

                    
                    var d = '<tr>'+
                    '<th>ID</th>'+
                    '<th>Nombre</th>'+
                    '<th>Descripcion</th>'+
                    '<th>Fecha Asignacion</th>'+
                    '<th>Fecha Finalizacion</th>'+
                    '<th>Fecha Inicio</th>'+
                    '<th>Fecha Entrega</th>'+
                    '<th>Asignado a</th>'+
                    '<th>Proyecto</th>'+
                    '<th>Estado</th>'+
                    '<th>Prioridad</th>'+
                    '</tr>';
    
                    for(var i = 0; i < datos.length; i++){
                        d+= '<tr>'+
                            '<td>'+datos[i].id_actividad+'</td>'+
                            '<td>'+datos[i].nombre_actividad+'</td>'+
                            '<td>'+datos[i].descripcion+'</td>'+
                            '<td>'+datos[i].fecha_asignacion+'</td>'+
                            '<td>'+datos[i].fecha_fin+'</td>'+
                            '<td>'+datos[i].fecha_inicio+'</td>'+
                            '<td>'+datos[i].fecha_entrega+'</td>'+
                            '<td>'+datos[i].name+'</td>'+
                            '<td>'+datos[i].nombre_proyecto+'</td>'+
                            '<td>'+datos[i].estado+'</td>'+
                            '<td>'+datos[i].descripcion_larga+'</td>'+
                        '</tr>';
                    }
    
                }

                $("#tabla_actividad").append(d);
            }
        })
        .catch(error => console.error('Error:', error))

    
});

function limpiarTabla(){
    console.log('eliminar')
    tabla = $('#tabla_actividad');
    tabla.html('')
    // $("#contenido").remove();
    // $('#tabla_actividad').detach();
}


// function buscarActividad(){
    
//     var s_usuario = document.getElementById('select_usuario').value;
//     var s_equipo = document.getElementById('select_equipo').value;
//     var s_proyecto = document.getElementById('select_proyecto').value;

//     let obj = {
//         usuario : s_usuario,
//         equipo : s_equipo,
//         proyecto : s_proyecto
//     };

    


// }




// function abrirModalActividad(token) {
//     $('#modal-descripcion').modal('show');


//     $('#btnAsignarActividad').on('click', function() {
//         asignarActividad(token);
//     });
// }

// function asignarActividad(token) {

//     var a_nombre = document.getElementById('input_nombre_actividad');
//     //var a_fecha_inicio = document.getElementById('input_fecha_inicio_actividad');
//     var a_fecha_fin = document.getElementById('input_fecha_finalizacion_actividad');
//     var a_hora_fin = document.getElementById('input_hora_finalizacion_actividad');
//     var a_descripcion = document.getElementById('input_descripcion_actividad');
//     var a_prioridad = document.getElementById('select_prioridad_actividad');
//     var a_asignado = document.getElementById('select_asignado_usuario');
//     var a_asignado_equipo = document.getElementById('select_asignado_equipo');
//     //var _token = document.getElementById('token');
//     var fecha_fin_act = a_fecha_fin.value + ' ' + a_hora_fin.value + ':00';

//     //fecha y hora actual en que se registra la actividad
//     var hoy = new Date();
//     var fecha = hoy.getFullYear() + '-' + (hoy.getMonth() + 1) + '-' + hoy.getDate();
//     var hora = hoy.getHours() + ':' + hoy.getMinutes() + ':' + hoy.getSeconds();
//     var fechayhora = fecha + ' ' + hora;

    

//     let obj = {
//         nombre: a_nombre.value,
//         fecha_asig: fechayhora,
//         fecha_fin: fecha_fin_act,
//         id_usuario : a_asignado.value,
//         id_equipo : a_asignado_equipo.value,
//         descripcion: a_descripcion.value,
//         prioridad: a_prioridad.value
//     };

//     console.log(obj)

//     fetch(('/asignar_actividades_act'), {
//             method: 'post',
//             headers: {
//                 'X-CSRF-TOKEN': token,
//                 'Content-Type': 'application/json'
//             },
//             body: JSON.stringify(obj)
//         })
//         .then(response => response.json())
//         .then(response => {
//             console.log(response.respuesta)
//             //console.log(response.respuesta)
//             if (response.respuesta == 1) {
//                 setTimeout(window.location = ('/actividades'), 90000);
//                 return alertas(4, 'Se ha guardado correctamente.');
//             } else if (response.respuesta == 2) {
//                 //     //setTimeout( window.location = SITE + '/proyectos',90000);
//                 return alertas(2, 'Fechas no especificadas correctamente, Actividad no registrada!');
//             } else if (response.respuesta == 3) {
//                 setTimeout(window.location = ('/actividades'), 90000);
//                 return alertas(3, 'Ocurrio un error, contacte al desarrollador.');
//             }
//         })
//         .catch(error => console.error('Error:', error))

// }