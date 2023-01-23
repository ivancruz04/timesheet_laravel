<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Nuevo Proyecto</title>
</head>
<body>
    <p>Hola {{$nombre_usuario}}! Se te asigno una nuevo proyecto EN EQUIPO!, que comienza el dia {{$asigProyecto}}</p>
    <p>Estos son los datos del proyecto:</p>
    <ul>
        <li>Nombre: {{$nombreProyecto}}</li>
        <li>Descripcion: {{$descripcionProyecto}}</li>
        <li>Entregar antes de: {{$finProyecto}}</li>
        <li>Nombre de tu equipo: {{$nombre_equipo}}</li>

    </ul>
    <p>Ingresa a timesheet para ver mas detalles de tu proyecto</p>
    
</body>
</html>