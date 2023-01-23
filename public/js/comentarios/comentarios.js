let t_comentario = document.getElementById('texto_comentario')
let _token = document.getElementById('token');

function guardarComentario(idUsuario, idActividad){

    var hoy = new Date();
    var v_fecha = hoy.getFullYear() + '-' + (hoy.getMonth() + 1) + '-' + hoy.getDate();
    var v_hora = hoy.getHours() + ':' + hoy.getMinutes() + ':' + hoy.getSeconds();

    obj = {
        id_actividad : idActividad,
        id_usuario : idUsuario,
        descripcion : t_comentario.value,
        fecha : v_fecha,
        hora : v_hora 
    }
    console.log('datos a enviar')
    console.log(obj)
    fetch(('/guardar_comentario'), {
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
        // if (response.respuesta == 1) {
        //     setTimeout(window.location = ('/cat_puestos/'+idActividad), 90000);
        //     return alertas(4, 'Se ha enviado tu comentario.');
        // } else if (response.respuesta == 2) {
        //     //setTimeout( window.location = SITE + '/proyectos',90000);
        //     return alertas(3, 'Ocurrio un error, contacte al desarrollador.');
        // } 
    })
    .catch(error => console.error('Error:', error))

}