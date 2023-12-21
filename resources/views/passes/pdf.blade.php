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
    <div id="header_body">
        <img class="imgheader_body" src="{{ public_path('images/LOGO-GORE-PEQUENHO.png') }}" height="100" width="300">

        <div class="infoheader_body">
            <h3>GOBIERNO REGIONAL DE PUNO</h3>
            <h4>Sistema de Papeletas de Salida - PASS</h4>
        </div>
    </div>

    <div id="footer">
        <div class="textfooter">
            <p>Trabajando por un Futuro Mejor</p>
            <p>Derechos Reservados - 2023</p>
        </div>
    </div>

    <div class="container">
        <div id="header">

            <div class="infoheader">
                <h3>GOBIERNO REGIONAL DE PUNO</h3>

                @if($pass->estado == 5)
                    <h4 style="color:red;">PAPELETA RECHAZADA</h4>
                @else
                    <h4 style="color:blue;">PAPELETA DE SALIDA</h4>
                @endif


            </div>
        </div>

        <div >

            <label class="label-with-border" style="font-weight: bold;">TARJETA Nº:</label>
            <div class="label" >{{ $pass->id }}</div><br><br>

                <label style="font-weight: bold;">NOMBRES:</label>
                <div  class="underline">{{ $pass->user->name }}</div><br><br>
                

                <label style="font-weight: bold;">CÓDIGO PERSONAL:</label>
                <div  class="underline">{{ $pass->user->ncard }}</div><br><br>

                <label style="font-weight: bold;">CARGO:</label>
                <div  class="underline">{{ $pass->user->charge->name_charge }}</div><br><br>

                <label style="font-weight: bold;">DEPENDENCIA:</label>
                <div  class="underline">{{ $pass->user->dependence->name_dependence }}</div><br><br>

                <label style="font-weight: bold;">MOTIVO:</label>
                <div  class="underline">{{ $pass->motive }}</div><br><br>

                <label style="font-weight: bold;">LUGAR:</label>
                <div  class="underline">{{ $pass->place }}</div><br><br>

                <label style="font-weight: bold;">TIEMPO AUTORIZADO:</label>
                <div class="label">{{ $pass->time->time_permision }}</div><br><br>


                
                @if (isset($pass->departure_time->hour_departure))
                <div class="label">{{$pass->departure_time->hour_departure}}</div>
                @else
                <div class="label">Sin marcar hora de salida</div>
                @endif
                <label style="font-weight: bold;">HORA DE SALIDA</label><br><br>

                
                @if (isset($pass->return_time->hour_return ) && $pass->return_time->hour_return != '00:00:00')

                    <div class="label">{{ $pass->return_time->hour_return }}</div>
                @else
                    <div class="label">Sin marcar hora de ingreso</div>
                @endif
                <label style="font-weight: bold;">HORA DE RETORNO</label><br><br>


                <label style="font-weight: bold;">OBSERVACIONES:</label>
                @if (isset($pass->return_time->observation ))
                <div>{{ $pass->return_time->observation }}</div>
                @else
                <div class="underline_obs">Sin Observaciones</div>
                @endif
                <br><br>

                <div class="fecha">
                    <label style="font-weight: bold;">FECHA:</label>
                    <div class="underline">{{ $pass->date }}</div>
                </div>
                <br><br>

                
                <div class="info" style="text-align: center;">
                    @if ($pass->estado > 0 )
                        <div class="underline">{{ $userPE }}</div><br>
                    @else
                        <div class="underline">Pendiente</div><br>
                    @endif
                    <label style="font-weight: bold;">INTERESADO:</label>
                </div>

                <div class="info" style="text-align: center;">
                    @if ($pass->estado > 1 )
                        <div class="underline">{{ $userJO->first()->name}}</div><br>
                    @else
                        <div class="underline">Pendiente</div><br>
                    @endif

                    <label style="font-weight: bold;">JEFE INMEDIATO:</label>
                </div><br><br>

                <div class="RRHH" style="text-align: center;">
                    @if ($pass->estado > 2 )
                        <div class="underline">{{ $userRRHH->first()->name}}</div><br>
                    @else
                        <div class="underline">Pendiente</div><br>
                    @endif

                    <label style="font-weight: bold;">VºBº ORRHH:</label>
                </div>

        </div>
    </div>



</body>

</html>