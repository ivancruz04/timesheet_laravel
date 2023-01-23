<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Nueva Actividad</title>
</head>
<body>
    <p>Hola {{$nombre_usuario}}! Se te asigno una nueva actividad, que comienza hoy {{$asigActividad}}</p>
    <p>Estos son los datos de la actividad:</p>
    <ul>
        <li>Nombre: {{$nombreActividad}}</li>
        <li>Descripcion: {{$descripcionActividad}}</li>
        <li>Entregar antes de: {{$finActividad}}</li>
    </ul>
    <p>Ingresa a timesheet para ver mas detalles de tu actividad</p>
    
</body>
</html>