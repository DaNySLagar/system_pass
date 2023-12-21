<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;
use App\Models\Pass;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;




use App\Models\User;
use App\Models\Dependence;

use Carbon\CarbonInterval;


class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }
    public function reporte()
    {
        $passes = Pass::latest()->take(100)->get();;
        $pdf = PDF::setPaper('a4', 'landscape')->loadview('admin.reporte',compact('passes'));
        return $pdf->stream();
    }
    public $opcion='Archivados';
    public $search;
    public function reportePdf(Request $request)
    {

        
   
        // Enviar datos dinamicamente: https://es.stackoverflow.com/questions/112811/ayuda-con-dompdf-y-asignacion-de-variables

        // Recibir datos para filtrar búsquedas 
        $date_inicio = session('date_inicio');
        $date_final = session('date_final');
        $input_user_id = session('user');
        $input_dependence_id = session('dependence');
        $date_actual = Carbon::now()->isoFormat('D [de] MMMM [del] YYYY', 'es');

        // Obtener datos de usuario autenticado
        $jefeoficina = Auth::user();
        

          
        //dd($request->user()->hasRole('JefeOficina'));
        //$user->hasAnyRole;

        //PARTE UNO - OBTENCION DE REGISTROS RELEVANTES



            // Obtener id de dependencia de usuario autenticado 
            $dep = $input_dependence_id;

            // obtencion de passes de todos los empleados de oficina excepto pases del propio jefe de oficina   
            $passesQuery = Pass::whereHas('user', function ($query) use ($input_user_id) { 
                // Filtra por id de usuario
                if($input_user_id==null){
                    // Tomar a todos los usuarios
                    $query->where('id', 'LIKE', '%' . $this->search . '%');                
                }else{
                    // Tomar solo a usuario con id igual a $input_user_id
                    $query->where('id', 'LIKE', $input_user_id);
                }
            // Escoger solo passes de usuarios pertenecientes a una dependencia especifica 
            })->whereHas('user', function ($query) use ($dep){
                $query->where('dependence_id', $dep);
            });

            if ($this->opcion == 'Archivados'){
                $passesQuery
                    ->where('estado', 4)
                    ->whereBetween('date', [$date_inicio, $date_final]);
            }

            $passes = $passesQuery;
            //dd($passes->get() );
           /*dump('hola');
            dump($input_dependence_id);
            dump($input_user_id);
            dd($passes->get());*/

        
        // PARTE DOS - CALCULAMOS HORAS DE REGISTROS SELECCIONADOS

        $passes = $passes -> get();


        foreach ($passes as $pass) {
            // Obtener diferencia de hora de salida (hour_departure) con hora de retorno (hour_return)
            // Verificar existencia de registros tanto de departure_time y de return_time
            if ($pass->departure_time && $pass->return_time) {
                $departureTime = Carbon::createFromFormat('H:i:s',$pass->departure_time->hour_departure);
                $returnTime = Carbon::createFromFormat('H:i:s',$pass->return_time->hour_return);
        
                // Calcular la diferencia de tiempo entre la hora de salida y la hora de regreso
                $hoursDifference = $returnTime->diff($departureTime);

                // Formatear la diferencia de tiempo en horas y minutos y guardar en nueva columa total_hours
                $pass->timeOfAbsence = $hoursDifference->format('%H:%I:%S');
            } else {
                $pass->timeOfAbsence = 'No registrado';
            }


            // Otener suma de tiempo autorizado por cada usuario
            $partes = explode(' ', $pass->time->time_permision); //entrada es "15 min"
            //dd($partes[0]);
            if (count($partes) == 2 && is_numeric($partes[0])) {
                // Convertir en entero
                $cantidad = intval($partes[0]);
    
                // Convertir en minúsculas
                switch (strtolower($partes[1])) {
                    case 'min':
                        $authorizedTime = Carbon::createFromFormat('H:i:s', '00:00:00')->addMinutes($cantidad);
                        $pass->authorizedTime = $authorizedTime->format('H:i:s');
                        break;
                    case 'mins':
                        $authorizedTime = Carbon::createFromFormat('H:i:s', '00:00:00')->addMinutes($cantidad);
                        $pass->authorizedTime = $authorizedTime->format('H:i:s');
                        break;
                    case 'minutos':
                        $authorizedTime = Carbon::createFromFormat('H:i:s', '00:00:00')->addMinutes($cantidad);
                        $pass->authorizedTime = $authorizedTime->format('H:i:s');
                        break;
                    case 'hora':
                        $authorizedTime = Carbon::createFromFormat('H:i:s', '00:00:00')->addHours($cantidad);
                        $pass->authorizedTime = $authorizedTime->format('H:i:s');
                        break;
                    case 'horas':
                        $authorizedTime = Carbon::createFromFormat('H:i:s', '00:00:00')->addHours($cantidad);
                        $pass->authorizedTime = $authorizedTime->format('H:i:s');
                        break;
                    default:
                        $pass->authorizedTime = 'No reconocido';
                        break;    
                }    
            }

        }

        $comparador = null;   
        $nombresGuardados = [];
        $sumOfAbsenceTime = [];     
        $ncardGuardados = [];
        $name_dependenceGuardados = [];
        $name_chargeGuardados = [];
        $sumOfAuthorizedTime = [];
        // Obtener datos personales por usuario
        foreach($passes as $pass){
            if(($comparador === null) || ($pass->user->name !== $comparador)){          
                $nombresGuardados[] = $pass->user->name;
                $ncardGuardados[] = $pass->user->ncard;
                $name_dependenceGuardados[] = $pass->user->dependence->name_dependence;
                $name_chargeGuardados[] = $pass->user->charge->name_charge;
                $comparador = $pass->user->name;            
            }
        }  
        // Obtener suma de tiempo de ausencia por cada usuario
        foreach($nombresGuardados as $index => $nombre){
            $totalHourUser = Carbon::createFromFormat('H:i:s', '00:00:00');
            foreach($passes as $pass){
                if( $nombresGuardados[$index] === $pass->user->name){
                        if($pass->timeOfAbsence!='No registrado'){
                            $hourAux = Carbon::createFromFormat('H:i:s',$pass->timeOfAbsence);
                            $totalHourUser = $totalHourUser->addHours($hourAux->hour)->addMinutes($hourAux->minute)->addSeconds($hourAux->second);
                        }
                }        
            }
            $horaActual = Carbon::createFromFormat('H:i:s','00:00:00');
            $sumOfAbsenceTime[] = $totalHourUser->diff($horaActual)->format('A:%y M:%m D:%d H: %H:%I:%S');
        }


        // Obtener suma de tiempo autorizado por cada usuario
        foreach($nombresGuardados as $index => $nombre){
            $totalHourUser = Carbon::createFromFormat('H:i:s', '00:00:00');
            foreach($passes as $pass){
                if( $nombresGuardados[$index] === $pass->user->name){
                        if($pass->authorizedTime!='No reconocido'){
                            $hourAux = Carbon::createFromFormat('H:i:s',$pass->authorizedTime);
                            $totalHourUser = $totalHourUser->addHours($hourAux->hour)->addMinutes($hourAux->minute)->addSeconds($hourAux->second);
                        }
                }        
            }
            $horaActual = Carbon::createFromFormat('H:i:s','00:00:00');
            $sumOfAuthorizedTime[] = $totalHourUser->diff($horaActual)->format('A:%y M:%m D:%d H:%H:%I:%S');
        }   



        // Sumar hora de ausencia de todos los registros passes
        $totalTime = new \DateTime('00:00:00');
        foreach ($passes as $pass) {
            if ($pass->timeOfAbsence !== 'No registrado') {
                // Parsear el tiempo en horas, minutos y segundos
                list($hours, $minutes, $seconds) = explode(':', $pass->timeOfAbsence);

                // Crear el DateInterval manualmente
                $interval = new \DateInterval("PT{$hours}H{$minutes}M{$seconds}S");

                // Utilizar el método add directamente para sumar el intervalo de tiempo
                $totalTime->add($interval);
            }
        }
        // Mostrar el resultado en formato de tiempo
        $totalAbsenceTime = $totalTime->format('H:i:s'); // convertir el objeto carbon en un array

        // Sumar Hora de autorizacion de todos los registros de pases
        $totalTime = Carbon::createFromFormat('H:i:s','00:00:00');
        foreach ($passes as $pass) {
            if ($pass->authorizedTime !== 'No reconocido') {
                $hourPerRow = Carbon::createFromFormat('H:i:s',$pass->authorizedTime);
                $totalTime = $totalTime->addHours($hourPerRow->hour)->addMinutes($hourPerRow->minute)->addSeconds($hourPerRow);
            }
        }
        $dateOfToday = Carbon::createFromFormat('H:i:s','00:00:00');
        //dd($dateOfToday);
        $totalAuthorizedTime=$totalTime->diff($dateOfToday)->format('A:%y M:%m D:%d H:%H:%I:%S');



        $datos = [
            'nombresGuardados' => $nombresGuardados,
            'ncardGuardados' => $ncardGuardados,
            'name_dependenceGuardados' => $name_dependenceGuardados,
            'name_chargeGuardados' => $name_chargeGuardados,
            'sumOfAbsenceTime' => $sumOfAbsenceTime,
            'sumOfAuthorizedTime' => $sumOfAuthorizedTime,
            'totalAuthorizedTime' => $totalAuthorizedTime,
        ];

        $pdf = PDF::setPaper('a4', 'portrait')
            ->loadview('passes.reporteboos',compact('passes','jefeoficina','totalAbsenceTime','date_inicio','date_final','date_actual','datos'));

       // return $pdf->stream();
        return $pdf->download('Reporte de papelets de salida.pdf');
    }
}
