<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Nueva Equipo Asignado</title>
</head>
<body>
    <p>Hola {{$e_nombre_miembro}}! Te han asignado un nuevo equipo de trabajo</p>
    <p>Estos son los datos del equipo:</p>
    <ul>
        <li>Nombre: {{$e_equipo}}</li>
        <li>Descripcion: {{$e_descripcion}}</li>
    </ul>
    <p>Ingresa a timesheet para ver mas detalles de tu nuevo equipo</p>
    
</body>
</html>