let f_puesto = document.getElementById('descripcion_puesto');
let f_token = document.getElementById('token');

let SITE = ''

function agregarPuesto(){
    alert(f_puesto.value)

}

function eliminarPuesto(idPuesto){
    
    let obj = {
        id_puesto: idPuesto
    }

    fetch(('/eliminar_puesto'), {
        method: 'post',
        headers: {
            'X-CSRF-TOKEN': f_token.value,
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(obj)
    })
    .then(response => response.json())
    .then(response => {
        console.log(response)
        if(response.respuesta == 1){
            console.log(response.respuesta)
            setTimeout(window.location = ('/cat_puestos'), 90000);
            return alertas(4, 'Eliminado correctamente.');
        }else{
            return alertas(3, 'Ocurrio un error, contacte al desarrollador.');
        }
    })
    .catch(error => console.error('Error:', error))
}

$("#btnregistrar_puesto").click(function () {

    let obj = {
        puesto_descripcion: f_puesto.value
    }
    console.log('enviado:')
    console.log(obj)

    fetch(('/registrar_puesto'), {
            method: 'post',
            headers: {
                'X-CSRF-TOKEN': f_token.value,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(obj)
        })
        .then(response => response.json())
        .then(response => {
            console.log(response)
            if(response.respuesta == 1){
                setTimeout(window.location = ('/cat_puestos'), 90000);
                return alertas(4, 'Registrado correctamente.');
            }else{
                return alertas(3, 'Ocurrio un error, contacte al desarrollador.');
            }
        })
        .catch(error => console.error('Error:', error))

});