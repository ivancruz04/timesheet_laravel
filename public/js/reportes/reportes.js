function exportarActividadesIndividual(){
    let r_usuario = document.getElementById('select_usuario');
    let r_desde = document.getElementById('act_individual_desde');
    let r_hasta = document.getElementById('act_individual_hasta');
    let _token = document.getElementById('token');

    //parametros a enviar
    const desde = r_desde.value + ' 00:00:00';
    const hasta = r_hasta.value + ' 23:59:59';
    const usuario = r_usuario.value;

    window.location.href = `/exportar_individuales/${usuario}&${desde}&${hasta}`;
    
}

function exportarActividadesEquipo(){

    let r_equipo = document.getElementById('select_equipo');
    let r_desde = document.getElementById('act_equipo_desde');
    let r_hasta = document.getElementById('act_equipo_hasta');
    let _token = document.getElementById('token');

    //parametros a enviar
    const desde = r_desde.value + ' 00:00:00';
    const hasta = r_hasta.value + ' 23:59:59';
    const equipo = r_equipo.value;


    window.location.href = `/exportar_equipo/${equipo}&${desde}&${hasta}`;
}