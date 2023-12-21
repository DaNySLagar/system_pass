
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

    @php
        $m = 0;
    @endphp

    <table >
        <thead >
            <tr>
                <th colspan="15">Reporte de Papeletas de Salida Generadas de los Usuarios Solicitados</th> 
            </tr>

            <tr>
                <th colspan="15"></th> 
            </tr>
            <tr>
                <th style="font-size: 10px;" colspan="3">Oficina:</th>
                <th style="font-size: 10px;" colspan="4">{{ $user->dependence->name_dependence }}</th>
            </tr>
            <tr>
                <th style="font-size: 10px;" colspan="3">Cargo: </th>
                <th style="font-size: 10px;" colspan="4">{{ $user->charge->name_charge }}</th>
                <th colspan="5"></th> 
                <th style="font-size: 10px;background-color: #002060; color: #FFFFFF;" colspan="1">Tiempo S.: </th>
                <th style="font-size: 10px;background-color: #002060; color: #FFFFFF;" colspan="2">Tiempo Solicitado</th>
            </tr>
            <tr>
                <th style="font-size: 10px;" colspan="3">Nombre y Apellidos:</th>
                <th style="font-size: 10px;" colspan="4">{{ $user->name }}</th>
                <th colspan="5"></th> 
                <th style="font-size: 10px;background-color: #002060; color: #FFFFFF;" colspan="1">Tiempo U.: </th>
                <th style="font-size: 10px;background-color: #002060; color: #FFFFFF;" colspan="2">Tiempo Utilizado</th>
            </tr>
            <tr>
                <th style="font-size: 10px;" colspan="3">Fecha de creación:</th>
                <th style="font-size: 10px;" colspan="4">{{ $fecha }}</th>
            </tr>
            <tr>
                <th style="font-size: 10px;" colspan="15"></th> 
            </tr>
            <tr>
                <th style="font-weight: bold; background-color: #002060; color: #FFFFFF; text-align: center;" colspan="15">REPORTE DEL {{ $date_inicio }} AL {{ $date_final }}</th>
            </tr>
        </thead>


        <tbody>

            @php
                $idtemp = $datos->first()->user->id;
            @endphp


            @foreach($pass_time as $index => $time)
                <tr>
                    <th colspan="15"></th>
                </tr>
                <tr>
                    <th style="font-weight: bold;border: 1px solid #000000;font-size:10px;" colspan="6">Oficina: {{ $dependence_time[$index] }}</th>
                    <th style="font-weight: bold;border: 1px solid #000000;font-size:10px;" colspan="5">Nombres y Apellidos: {{ $user_time[$index] }}</th>
                    <th style="font-weight: bold;border: 1px solid #000000;font-size:10px;" colspan="2">Horas Solicitadas: </th>
                    <th style="font-weight: bold;border: 1px solid #000000;font-size:10px;" colspan="2">{{ $time }}</th>
                </tr>
                <tr>
                    <th style="font-size:10px;font-weight: bold; background-color: #002060; color: #FFFFFF; text-align: center;border: 1px solid #000000;" colspan="4">Motivo de Salida</th>
                    <th style="font-size:10px;font-weight: bold; background-color: #002060; color: #FFFFFF; text-align: center;border: 1px solid #000000;" colspan="3">Lugar de Salida</th>
                    <th style="font-size:10px;font-weight: bold; background-color: #002060; color: #FFFFFF; text-align: center;border: 1px solid #000000;" colspan="4">observaciones</th>
                    <th style="font-size:10px;font-weight: bold; background-color: #002060; color: #FFFFFF; text-align: center;border: 1px solid #000000;" colspan="1">Tiempo S.</th>
                    <th style="font-size:10px;font-weight: bold; background-color: #002060; color: #FFFFFF; text-align: center;border: 1px solid #000000;" colspan="1">Tiempo U.</th>
                    <th style="font-size:10px;font-weight: bold; background-color: #002060; color: #FFFFFF; text-align: center;border: 1px solid #000000;" colspan="2">Fecha de salida</th>
                </tr>



                @foreach($datos as $dato)

                    @if($dato->user->name === $user_time[$index])

                        <tr>
                            <td style="font-size:10px;border: 1px solid #000000;" colspan="4">{{ $dato->motive }}</td>
                            <td style="font-size:10px;border: 1px solid #000000;" colspan="3">{{ $dato->place }}</td>
                            <td style="font-size:10px;border: 1px solid #000000;" colspan="4">{{ $dato->observation }}</td>
                            <td style="font-size:10px;border: 1px solid #000000;" colspan="1">{{ $dato->time->time_permision }}</td>
                            <td style="font-size:10px;border: 1px solid #000000;" colspan="1">{{ $dato->real_time }}</td>
                            <td style="font-size:10px;border: 1px solid #000000;" colspan="2">{{ $dato->date }}</td>
                        </tr>
                            
                    @endif
                    
                @endforeach
            @endforeach

            <tr>
                <th colspan="15"></th>
            </tr>
            <tr>
                <th style="font-size:10px;font-weight: bold; background-color: #002060; color: #FFFFFF; text-align: center;border: 1px solid #000000;" colspan="3">Cantidad de horas solicitadas:</th>

                @if ($m === 0)
                    <th  style="font-size:10px;border: 1px solid #000000;" colspan="3">{{ $totalHoras }}</th>
                    @php
                        $m = $m + 1;
                    @endphp
                @endif

            </tr>

        </tbody>


    </table>

</body>
</html>
