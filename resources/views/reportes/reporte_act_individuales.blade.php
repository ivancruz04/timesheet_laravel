<html>

<head>
    <style>
    #tabla_actividades {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 10%;
    }

    #tabla_actividades td,
    #tabla_actividades th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #tabla_actividades tr:nth-child(even) {
        background-color: #0bfdfd;
    }

    #tabla_actividades th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #1B49F8;
        color: #fff;
    }

    body {
        font-family: sans-serif;
    }

    @page {
        margin: 160px 50px;
    }

    header {
        position: fixed;
        left: 0px;
        top: -160px;
        right: 0px;
        height: 100px;
        background-color: #ddd;
        text-align: center;
    }

    header h1 {
        margin: 10px 0;
    }

    header h2 {
        margin: 0 0 10px 0;
    }

    footer {
        position: fixed;
        left: 0px;
        bottom: -50px;
        right: 0px;
        height: 40px;
        border-bottom: 2px solid #ddd;
    }

    footer .page:after {
        content: counter(page);
    }

    footer table {
        width: 100%;
    }

    footer p {
        text-align: right;
    }

    footer .izq {
        text-align: left;
    }
    </style>

<body>
    <header>
        <h1>Reporte de actividades</h1>
        <h2>{{$nombre}}  {{$desde}} - {{$hasta}}</h2>
    </header>


    <footer>
        <table>
            <tr>
                <td>
                    <p class="izq">
                        Discom Software Solutions
                    </p>
                </td>
                <td>
                    <p class="page">
                        Página
                    </p>
                </td>
            </tr>
        </table>
    </footer>
    <div id="content">


        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table id="tabla_actividades" class="table table-bordered table-hover table-striped">
                            <thead class="thead-primary">
                                <tr class="text-center">
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Descripcion</th>
                                    <th>Fecha Asignacion</th>
                                    <th>Fecha Finalizacion</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Entrega</th>
                                    <th>Estado</th>
                                    <th>Estado de Entrega</th>
                                    <th>Prioridad</th>
                                    <th>Nombre Encargado</th>
                                    <th>Proyecto</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($actividades_select as $actividad)
                                <tr class="text-center">
                                    <td>{{ $actividad->id_actividad}}</td>
                                    <td>{{ $actividad->nombre_actividad}}</td>
                                    <td>{{ $actividad->descripcion}}</td>
                                    <td>{{ $actividad->fecha_asignacion}}</td>
                                    <td>{{ $actividad->fecha_fin}}</td>
                                    <td>{{ $actividad->fecha_inicio}}</td>
                                    <td>{{ $actividad->fecha_entrega}}</td>
                                    <td>{{ $actividad->estado}}</td>
                                    <td>{{ $actividad->estado_entrega}}</td>
                                    <td>{{ $actividad->descripcion_larga}}</td>
                                    <td>{{ $actividad->name}}</td>
                                    <td>{{ $actividad->nombre_proyecto}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <br><br>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table id="tabla_actividades" class="table table-bordered table-hover table-striped">
                            <thead class="thead-primary">
                                <tr class="text-center">
                                    <th>Pendientes</th>
                                    <th>Atrasadas</th>
                                    <th>Total</th>


                                </tr>
                            </thead>
                            <tbody>
                                
                                <tr class="text-center">
                                    <td>{{ $pendientes}}</td>
                                    <td>{{ $atrasadas}}</td>
                                    <td>{{ $totales}}</td>
                                </tr>  
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>
</body>

</html>