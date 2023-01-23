
function eliminarMiembros(idMiembro, idEquipo, token){
    let obj = {
        id_usuario : idMiembro,
        id_equipo : idEquipo
    };
    
    fetch(('/eliminar_miembro'), {
            method: 'POST',
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
                setTimeout(window.location = ('/v_veractualizar_equipo/'+idEquipo), 90000);
                return alertas(4, 'Se ha eliminado correctamente.');
            } else if (response.respuesta == 2) {
                setTimeout(window.location = ('/v_veractualizar_equipo/'+idEquipo), 90000);
                return alertas(2, 'Ocurrio un error, contacte al desarrollador!');
            } 
        })
        .catch(error => console.error('Error:', error))
}

function eliminarEquipo(idEquipo, token){

    Swal.fire({
        title: 'Seguro que desea eliminar?',
        text: "Se eliminara el equipo registrado",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!'
      }).then((result) => {
        if (result.isConfirmed) {
            let obj = {
                id_equipo : idEquipo
            };
            console.log(token)
            fetch(('/eliminar_equipo'), {
                    method: 'POST',
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
                        //setTimeout(window.location = SITE + '/equipos', 90000);
                        return alertas(4, 'Se ha eliminado correctamente.');
                    } else if (response.respuesta == 2) {
                        //setTimeout(window.location = SITE + '/equipos', 90000);
                        return alertas(2, 'Ocurrio un error, contacte al desarrollador!');
                    } 
                })
                .catch(error => console.error('Error:', error))
        }
      })   
}

function modalAgregarMas(idEquipo, token){
    $('#modal-agregar-mas-miembros').modal('show');
    var agregar_miembro = document.getElementById('btnAgregarMiembros');
    var checks = document.querySelectorAll('.valores');
    var i = 0;
    var seleccionados = [];

    agregar_miembro.addEventListener('click', function() {
        //recupera los checkbox de los usuarios seleccionados
        checks.forEach((e) => {
            if (e.checked == true) {
                seleccionados[i] = e.value;
                i = i + 1;
            }
        });
        console.log(seleccionados)
        agregarMasMiembros(idEquipo, seleccionados, token);
        i = 0;
        seleccionados = [];
    });

}

function agregarMasMiembros(idEquipo, seleccionados, token){
    
    let obj = {
        id_equipo : idEquipo,
        seleccionados: seleccionados
    };

    fetch(('/agregar_masMiembros') , {
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
                setTimeout(window.location = ('/v_veractualizar_equipo/'+idEquipo), 90000);
                return alertas(4, 'Se ha guardado correctamente.');
            } else if (response.respuesta == 2) {
                setTimeout(window.location = ('/v_veractualizar_equipo/'+idEquipo), 90000);
                return alertas(3, 'Ocurrio un error, contacte al residente.');

            }
        })
        .catch(error => console.error('Error:', error))
}

