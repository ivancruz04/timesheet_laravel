
function eliminarProyecto(idProyecto){
    json = {
        '_token': TOKEN,
        'idProyecto': idProyecto
    }

    fetch(SITE + '/eliminar_proyectos', {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json'},
        body: JSON.stringify(json)
    })
        .then(response => response.json())
        .then(response => {
            if(response.estado ==1){
                setTimeout(window.location = SITE + 'proyectos', 90000);
                return alerta(4, 'Se ha eliminado correctamente. ');
            }
        }).catch(error => console.error('Error:', error))
}


console.log('hola');