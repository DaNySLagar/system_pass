<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Passes</title>
    <link rel="stylesheet" href="{{ public_path('css/pdf.css') }}">
</head>
<body>
    <div id="header_body_report">
        <img class="imgheader_body" src="{{ public_path('images/LOGO-GORE-PEQUENHO.png') }}" height="100" width="300">

        <div class="infoheader_body">
            <h3>GOBIERNO REGIONAL DE PUNO</h3>
            <h4>Sistema de Papeletas de Salida</h4>
        </div>
    </div>

  
    <div id="footer">
        <div class="textfooter">
            <p>Trabajando por un Futuro Mejor</p>
            <p>Derechos Reservados - 2023</p>
        </div>
    </div>

    <div>
        <table class="tabla">
            <thead>
                <tr>
                    <th scope="col" class="encabezado py-2">N° Tarjeta</th>
                    <th scope="col" class="encabezado py-2">Nombre</th>
                    <th scope="col" class="encabezado py-2">Dependencia</th>
                    <th scope="col" class="encabezado py-2">Motivo</th>
                    <th scope="col" class="encabezado py-2">Lugar</th>
                    <th scope="col" class="encabezado py-2">Tiempo Autorizado</th>
                    <th scope="col" class="encabezado py-2">Estado</th>
                    <th scope="col" class="encabezado py-2">Fecha</th>
                </tr>
            </thead>
                <tbody>
                    @forelse($passes as $pass)
                    <tr>
                        <td class="fila py-2">{{ $pass->user->ncard }}</td>
                        <td class="fila py-2">{{ $pass->user->name }}</td>
                        <td class="fila py-2">{{ $pass->user->dependence->name_dependence }}</td>
                        <td class="fila py-2">{{ $pass->motive }}</td>
                        <td class="fila py-2">{{ $pass->place }}</td>
                        <td class="fila py-2">{{ $pass->time->time_permision }}</td>
                        
                        <td class="fila py-2">
                                <div class=" flex justify-center items-center">
                                    @if ($pass->estado === 4)
                                        <div style="background-color: teal; border-radius:3px;">Archivado</div>
                                    @elseif ($pass->estado === 3)
                                        <div style="background-color: green;  border-radius:3px;">Firmado por RRHH</div>
                                    @elseif ($pass->estado === 2)
                                        <div style="background-color: blue; border-radius:3px;">Firmado por Jefe</div>
                                    @elseif ($pass->estado === 1)
                                        <div style="background-color: orange; border-radius:3px;">Firmado</div>
                                    @elseif ($pass->estado === 5)
                                        <div style="background-color: red; border-radius:3px;">Rechazado</div>
                                    @elseif ($pass->estado === 0)
                                        <div style="background-color: gray; border-radius:3px;">No Firmado</div>
                                    @endif
                                </div>
                            </td >
                        <td class="fila py-2">{{ $pass->date }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="12">No has creado ningun permiso</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>
