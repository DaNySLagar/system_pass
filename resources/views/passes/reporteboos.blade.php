<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de papeletas</title>
    <!-- link rel="stylesheet" href="{{ public_path('css/pdf.css') }}"-->
    <link rel="stylesheet" href="{{ public_path('css/reportebosspdf.css') }}">



</head>
<body>


    @php
        $comparador = null;
        $nombresGuardados = $datos['nombresGuardados'];
        $ncardGuardados = $datos['ncardGuardados'];
        $name_dependenceGuardados = $datos['name_dependenceGuardados'];
        $name_chargeGuardados = $datos['name_chargeGuardados'];
        $sumOfAbsenceTime = $datos['sumOfAbsenceTime'];
        $sumOfAuthorizedTime = $datos['sumOfAuthorizedTime'];
        $totalAuthorizedTime = $datos['totalAuthorizedTime'];
    @endphp


@php

@endphp


    <div id = "iddatosjefe">
        <h1 class="text-grande">GOBIERNO REGIONAL DE PUNO </h1>
        <h1 class="text-grande">REPORTE DE SALIDAS Y ENTRADAS DEL SISTEMA DE PAPELETAS DE SALIDA </h1>
        <h1 id="fechaActual" >Puno, {{$date_actual}}</h1>
        <div>
            <h1 class="datosjefetitulos" id="datosjefetitulos">Fecha:</h1>
            <h1 class="datosjefetitulos">{{$date_inicio}} al {{$date_final}} </h1>
        </div>
        <div>
            <h1 class="datosjefetitulos" id="datosjefetitulos">Reporte generado por:</h1>
            <h1 class="datosjefetitulos">{{$jefeoficina->name}}, {{$jefeoficina->charge->name_charge}} de {{$jefeoficina->dependence->name_dependence}} </h1>

        </div>
        
    </div>


    @foreach($nombresGuardados as $index => $nombre)

    <div id="divdatos">
        <h4 class="hcuatro" id="h4name">{{ $nombre }} - DNI: {{ $ncardGuardados[$index] }}, {{$name_chargeGuardados[$index]}} de "{{ $name_dependenceGuardados[$index] }}" </h4>

    </div>
    <table>
        <thead>
            <tr id="trhead">
                <th scope="col" class="encabezado py-1">Fecha solicitada</th>
                <th scope="col" class="encabezado py-2">Tiempo autorizado</th>
                <th scope="col" class="encabezado py-2">Tiempo de ausencia</th>
                <th scope="col" class="encabezado py-2">Motivo</th>
                <th scope="col" class="encabezado py-2">Lugar</th>
                <th scope="col" class="encabezado py-2">Observación</th>
            </tr>
        </thead>
        <tbody>
            @forelse($passes as $pass)
                @if($nombresGuardados[$index] === $pass->user->name)
                    <tr>
                        <td class="fila py-2">{{ $pass->date }}</td>
                        <td class="fila py-2">{{ $pass->time->time_permision }}</td>
                        <td class="fila py-2">{{ $pass->timeOfAbsence }}</td>
                        <td class="fila py-2">{{ $pass->motive }}</td>
                        <td class="fila py-2">{{ $pass->place }}</td>
                        <td class="fila py-2">{{ ($pass->return_time !== null)? $pass->return_time->observation : 'Ninguna' }}</td>
                    </tr>
                @endif

            @empty
                <tr>
                    <td colspan="4">No has creado ningún permiso</td>
                </tr>
            @endforelse
            
        </tbody>
    </table>
    <div class="tiemposPorUsuario">
        <h1 id="tiemposPorUsuario">Tiempo de ausencia: {{$sumOfAbsenceTime[$index]}}</h1>
        <h1 id="tiemposPorUsuario">Tiempo autorizado: {{$sumOfAuthorizedTime[$index]}}</h1>
    </div>
@endforeach
    <div class='resultadoFinal' >
        <h4 >Total de tiempo ausente:</h4>  
        <h4 class='resultadoFinalTexto'>{{$totalAbsenceTime}} </h4>            
        <h4 >Total de tiempo autorizado: </h4> 
        <h4 class='resultadoFinalTexto'>{{$totalAuthorizedTime}} </h4>   
      
    </div>
</body>
</html>