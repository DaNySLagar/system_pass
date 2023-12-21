<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
                
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\Font;
use App\Models\Dependence;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Pass;
use App\Models\User;

class ReportController extends Controller
{
    public function exportar(Request $request){

        $date_inicio = session('date_inicio');
        $date_final = session('date_final');
        $dependence = session('dependence'); 
        $user = session('user'); 
        $passesAll = session('passesAll');

        //obtencion de hora de retorno y salida mas observaciones
        $passesAll->load('departure_time', 'return_time');
        $hour_departures = $passesAll->pluck('departure_time.hour_departure')->toArray();
        $hour_return = $passesAll->pluck('return_time.hour_return')->toArray();
        $observations = $passesAll->pluck('return_time.observation')->toArray();
        $passesAll = collect($passesAll)->values();

        //calculo de la hora real de utilizacion
        $real_time = [];

        foreach ($hour_departures as $index => $departure_time) {
            $return_time = $hour_return[$index];
        
            if ($departure_time === null || $return_time === null) {
                $real_time[] = null;
            } else {
                $departure_time = Carbon::createFromFormat('H:i:s', $departure_time);
                $return_time = Carbon::createFromFormat('H:i:s', $return_time);
        
                $time_difference = $return_time->diff($departure_time);
                $real_time[] = $time_difference->format('%H:%I:%S');
            }
        }

        //integrando las nuevas columnas de observaciones y tiempo real
        $passesAll->each(function ($pass, $index) use ($observations, $real_time) {
            $pass->observation = $observations[$index] ?? null;
            $pass->real_time = $real_time[$index] ?? null;
        });  
        
        //array para almacenar las fechas individuales y nombres
        $times_user = $passesAll->count();
        $pass_time = [];
        $user_time = [];
        $dependence_time = [];
        
        //fecha actual
        $user = Auth::user();
        $now = Carbon::now();
        $currentDate = $now->format('Y-m-d');

        //suma de tiempos de todos los passes
        $totalTime = 0;
        $sumaTotalMinutos = 0;
        $sumaTotalMinutostemp = 0;
        $idtemp = $passesAll->first()->user->id;
        $user_pass = $passesAll;

        foreach ($passesAll as $key => $pass) {

            $time_ = $pass->time->time_permision;

            preg_match('/(\d+) hora/', $time_, $horasMatches);
            preg_match('/(\d+) min/', $time_, $minutosMatches);
            
            $horas = isset($horasMatches[1]) ? intval($horasMatches[1]) : 0;
            $minutos = isset($minutosMatches[1]) ? intval($minutosMatches[1]) : 0;
            
            if($pass->user->id === $idtemp){
                $idtemp = $pass->user->id ;
                $user_pass = $pass;
            }else{  
                array_push($pass_time, $sumaTotalMinutostemp);

                array_push($dependence_time, $user_pass->user->dependence->name_dependence);
                array_push($user_time, $user_pass->user->name);

                $idtemp = $pass->user->id ;
                $user_pass = $pass;
                $sumaTotalMinutostemp = 0;
            }

            $sumaTotalMinutos += $horas * 60 + $minutos;
            $sumaTotalMinutostemp += $horas * 60 + $minutos;

            if($key == $times_user - 1){

                array_push($pass_time, $sumaTotalMinutostemp);

                array_push($dependence_time, $pass->user->dependence->name_dependence);
                array_push($user_time, $pass->user->name);
            }    
        }   

        //formatear en horas y minutos

        $horasSuma = floor($sumaTotalMinutos / 60);
        $minutosSuma = $sumaTotalMinutos % 60;

        $sumaTotalFormateada = '';

        if ($horasSuma > 0) {
            $sumaTotalFormateada .= $horasSuma . ' hora';
            if ($horasSuma != 1) {
                $sumaTotalFormateada .= 's';
            }
            $sumaTotalFormateada .= ' ';
        }

        if ($minutosSuma > 0) {
            $sumaTotalFormateada .= $minutosSuma . ' min';
            if ($minutosSuma != 1) {
                $sumaTotalFormateada .= 'utos';
            }
        }

        //formatear en horas y minutos de los passes individuales

        $time_form = [];

        foreach ($pass_time as $key => $time_p) {
            $horasSuma = floor($time_p / 60);
            $minutosSuma = $time_p % 60;

            $sumaFormateada = '';

            if ($horasSuma > 0) {
                $sumaFormateada .= $horasSuma . ' hora';
                if ($horasSuma != 1) {
                    $sumaFormateada .= 's';
                }
                $sumaFormateada .= ' ';
            }

            if ($minutosSuma > 0) {
                $sumaFormateada .= $minutosSuma . ' min';
                if ($minutosSuma != 1) {
                    $sumaFormateada .= 'utos';
                }
            }
            array_push($time_form, $sumaFormateada);
            
        }

        return Excel::download(new ExcelExport($time_form, $user_time, $dependence_time, $passesAll, $sumaTotalFormateada,$user, $currentDate, $date_final, $date_inicio), 'Reporte - '.$currentDate.'.xlsx');
    }

    public function pdfFormat(Request $request){
        // Enviar datos dinamicamente: https://es.stackoverflow.com/questions/112811/ayuda-con-dompdf-y-asignacion-de-variables

        // Recibir datos para filtrar búsquedas 
        $date_inicio = session('date_inicio');
        $date_final = session('date_final');
        $input_user_id = session('user');
        $input_dependence_id = session('dependence');
        $date_actual = Carbon::now()->isoFormat('D [de] MMMM [del] YYYY', 'es');
        $opcion = session('opcion');
        $search;
        if($opcion == 1){
            $opcion = 'conRetorno';
        }elseif($opcion == 2){
            $opcion = 'sinRetorno';
        }

        // Obtener datos de usuario autenticado
        $jefeoficina = Auth::user();

        //PARTE UNO - OBTENCION DE REGISTROS RELEVANTES
        if($request->user()->hasAnyRole(['JefeRrHh', 'Guardian', 'Administrador'])){

            // Obtener id de dependencia de usuario autenticado 
            $dep = $input_dependence_id;

            // obtencion de passes de todos los empleados de oficina excepto pases del propio jefe de oficina   
            $passesQuery = Pass::whereHas('user', function ($query) use ($input_user_id) { 
                // Filtra por id de usuario
                if($input_user_id!=null){
                    // Tomar solo a usuario con id igual a $input_user_id
                    $query->where('id', 'LIKE', $input_user_id);
                }
            // Escoger solo passes de usuarios pertenecientes a una dependencia especifica 
            })->whereHas('user', function ($query) use ($dep){
                $query->where('dependence_id', $dep);
            });
            //dd($passesQuery);
            //dd($passesQuery->first());
            //if ($this->opcion == 'Archivados'){
                $passesQuery
                    ->where('estado', 4)
                    ->whereBetween('date', [$date_inicio, $date_final]);
            //}

            $passes = $passesQuery;
           //dd($passes->first());
            $passes = $passes -> get();
        }elseif($request->user()->hasRole('JefeOficina')){

            // Obtener id de dependencia de usuario autenticado 
            $dep = $request->user()->dependence_id;

            // obtencion de passes de todos los empleados de oficina excepto pases del propio jefe de oficina   
            $passesQuery = Pass::whereHas('user', function ($query) use ($input_user_id) { 
                // Filtra por id de usuario
                if($input_user_id!=null){
                    // Tomar solo a usuario con id igual a $input_user_id
                    $query->where('id', 'LIKE', $input_user_id);
                }
            // Escoger solo passes de usuarios pertenecientes a una dependencia especifica 
            })->whereHas('user', function ($query) use ($dep){
                $query->where('dependence_id', $dep);
            })   
            ->where(function ($query) use ($jefeoficina, $input_user_id, $request) { // Verificar si el usuario escogido en la interfaz es el mismo jefe de oficina contenedora
                if ($jefeoficina->id != $input_user_id) {
                    $query->whereNot('user_id', $request->user()->id);
                }
            })->latest();

            // Obtener de passes de jefes de sub oficina
            $dependences = Dependence::where('belonging_to', $dep)->get();  

            // Obtener dependencias subordinadas de dependencia contenedoras
            $users = $dependences->pluck('users')->flatten()->filter(function ($user) use ($input_user_id) { // Primero extrae todos los usuarios de las oficinas subordinadas y depues toma de esos usuarios solo a los usuario jefe de oficina
                // Escoger solo usuario con rol JefeOficina si $input_user_id es nulo, tomar a usuario con rol JefeOficina y con id igual que $input_user_id
                return ($input_user_id==null)? $user->hasAnyRole('JefeOficina') : $user->hasAnyRole('JefeOficina') && $user->id == $input_user_id ;
            // return $user->hasAnyRole('JefeOficina');
            });

            // Filtrar passes con estado número 4, y si tienen retorno o sino tienen retorno (archivados)
            //if ($this->opcion == 'Archivados'){
                $passesQuery
                    ->where('estado', 4)
                    ->whereBetween('date', [$date_inicio, $date_final]);
                $passes_sub = Pass::whereIn('user_id', $users->pluck('id'))->where('estado', 4)
                    ->whereBetween('date', [$date_inicio, $date_final]);
            //}


            // Unir passes de jefes de oficina con passes de users de oficina
            $passes = $passesQuery->union($passes_sub)->get();

        }elseif($request->user()->hasRole('Empleado')){// Cierra condicion if con rol JefeOficina
            $jefeoficina = Auth::user();
            $passes = Auth::user()->passes->where('estado', 4)
            ->whereBetween('date', [$date_inicio, $date_final]);
        }

        // PARTE DOS - CALCULAMOS HORAS DE REGISTROS SELECCIONADOS
        
        foreach ($passes as $pass) {
            // Obtener diferencia de hora de salida (hour_departure) con hora de retorno (hour_return)
            // Verificar existencia de registros tanto de departure_time y de return_time
            if ($pass->departure_time && $pass->return_time) {
                $departureTime = Carbon::createFromFormat('H:i:s',$pass->departure_time->hour_departure);
                $returnTime = Carbon::createFromFormat('H:i:s',$pass->return_time->hour_return);
        
                // Calcular la diferencia de tiempo entre la hora de salida y la hora de regreso
                $hoursDifference = $returnTime->diff($departureTime);

                // Formatear la diferencia de tiempo en horas y minutos y guardar en nueva columa timeOfAbsence
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
        
        // Escoger passes que tienen retorno y los que no tiene retorno, $passes en este caso es una coleccion ya no es una consulta, por este motivo debe actualizarse $passes
        if ($opcion == 'sinRetorno'){
            $passes = $passes
            ->where('timeOfAbsence', 'No registrado');
            //dd("entra a sin retorno");
        }
        if ($opcion == 'conRetorno'){
            //dd("entra a con retorno");
            $passes = $passes
            ->where('timeOfAbsence', '!=', 'No registrado');
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
            //$horaActual = Carbon::createFromFormat('H:i:s','00:00:00');
            //$sumOfAbsenceTime[] = $totalHourUser->diff($horaActual)->format('A:%y M:%m D:%d H: %H:%I:%S');

            $dateOfToday = Carbon::createFromFormat('H:i:s','00:00:00');
            $totalHourUser = $totalHourUser->diff($dateOfToday);
    
           
            if($totalHourUser->y==0 && $totalHourUser->m==0 && $totalHourUser->d == 0){
                $sumOfAbsenceTime[]  = $totalHourUser->format('%H:%I:%S Horas');
            }elseif($totalTime->y==0 && $totalHourUser->m==0 ){
                $sumOfAbsenceTime[] = $totalHourUser->format('%d Días y %H:%I:%S Horas');
            }elseif($totalTime->y==0 ){
                $sumOfAbsenceTime[]  = $totalHourUser->format('%m Meses %d Días y %H:%I:%S Horas');
            }else{
                $sumOfAbsenceTime[]  = $totalHourUser->format('%y Años, %m Meses, %d Días y %H:%I:%S Horas');
            }

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
            // = Carbon::createFromFormat('H:i:s','00:00:00');
            //$sumOfAuthorizedTime[] = $totalHourUser->diff($horaActual)->format('A:%y M:%m D:%d H:%H:%I:%S');
            $dateOfToday = Carbon::createFromFormat('H:i:s','00:00:00');
            $totalHourUser = $totalHourUser->diff($dateOfToday);
    
           
            if($totalHourUser->y==0 && $totalHourUser->m==0 && $totalHourUser->d == 0){
                $sumOfAuthorizedTime[]  = $totalHourUser->format('%H:%I:%S Horas');
            }elseif($totalTime->y==0 && $totalHourUser->m==0 ){
                $sumOfAuthorizedTime[] = $totalHourUser->format('%d Días y %H:%I:%S Horas');
            }elseif($totalTime->y==0 ){
                $sumOfAuthorizedTime[]  = $totalHourUser->format('%m Meses %d Días y %H:%I:%S Horas');
            }else{
                $sumOfAuthorizedTime[]  = $totalHourUser->format('%y Años, %m Meses, %d Días y %H:%I:%S Horas');
            }

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
       // $totalAbsenceTime = $totalTime->format('H:i:s'); // convertir el objeto carbon en un array

        $dateOfToday = Carbon::createFromFormat('H:i:s','00:00:00');
        $totalTime = $totalTime->diff($dateOfToday);

       
        if($totalTime->y==0 && $totalTime->m==0 && $totalTime->d == 0){
            $totalAbsenceTime  = $totalTime->format('%H:%I:%S Horas');
        }elseif($totalTime->y==0 && $totalTime->m==0 ){
            $totalAbsenceTime  = $totalTime->format('%d Días y %H:%I:%S Horas');
        }elseif($totalTime->y==0 ){
            $totalAbsenceTime  = $totalTime->format('%m Meses %d Días y %H:%I:%S Horas');
        }else{
            $totalAbsenceTime  = $totalTime->format('%y Años, %m Meses, %d Días y %H:%I:%S Horas');
        }
     
        // Sumar Hora de autorizacion de todos los registros de pases
        $totalTime = Carbon::createFromFormat('H:i:s','00:00:00');
        foreach ($passes as $pass) {
            if ($pass->authorizedTime !== 'No reconocido') {
                $hourPerRow = Carbon::createFromFormat('H:i:s',$pass->authorizedTime);
                $totalTime = $totalTime->addHours($hourPerRow->hour)->addMinutes($hourPerRow->minute)->addSeconds($hourPerRow);
            }
        }
        $dateOfToday = Carbon::createFromFormat('H:i:s','00:00:00');

        //$totalAuthorizedTime=$totalTime->diff($dateOfToday)->format('A:%y M:%m D:%d H:%H:%I:%S');
        $totalTime = $totalTime->diff($dateOfToday);

        if($totalTime->y==0 && $totalTime->m==0 && $totalTime->d == 0){
            $totalAuthorizedTime = $totalTime->format('%H:%I:%S Horas');
        }elseif($totalTime->y==0 && $totalTime->m==0 ){
            $totalAuthorizedTime = $totalTime->format('%d Días y %H:%I:%S Horas');
        }elseif($totalTime->y==0 ){
            $totalAuthorizedTime = $totalTime->format('%m Meses %d Días y %H:%I:%S Horas');
        }else{
            $totalAuthorizedTime = $totalTime->format('%y Años, %m Meses, %d Días y %H:%I:%S Horas');
        }


        $datos = [
            'nombresGuardados' => $nombresGuardados,
            'ncardGuardados' => $ncardGuardados,
            'name_dependenceGuardados' => $name_dependenceGuardados,
            'name_chargeGuardados' => $name_chargeGuardados,
            'sumOfAbsenceTime' => $sumOfAbsenceTime,
            'sumOfAuthorizedTime' => $sumOfAuthorizedTime,
            'totalAuthorizedTime' => $totalAuthorizedTime,
        ];

        /*dump("hola");
        dump($input_user_id);
        dump($input_dependence_id);
        dd($passes->first());*/
        //dd($nombresGuardados);
        $pdf = PDF::setPaper('a4', 'portrait')
            ->loadview('passes.reporteboos',compact('passes','jefeoficina','totalAbsenceTime','date_inicio','date_final','date_actual','datos'));
        return $pdf->download('Reporte de papelets de salida.pdf');
    }

}

class ExcelExport implements FromView, WithStyles
{
    protected $datos;
    protected $totalHoras;
    protected $user;
    protected $currentDate;
    protected $pass_time;
    protected $date_inicio;
    protected $date_final;
    protected $user_time;
    protected $dependence_time;

    public function __construct(array $pass_time, array $user_time, array $dependence_time, $datos, $totalHoras, $user, $currentDate, $date_final, $date_inicio)
    {
        $this->datos = $datos;
        $this->totalHoras = $totalHoras;
        $this->user = $user;
        $this->currentDate = $currentDate;
        $this->pass_time = $pass_time;
        $this->date_inicio = $date_inicio;
        $this->date_final = $date_final;
        $this->user_time = $user_time;
        $this->dependence_time = $dependence_time;
    }

    public function view(): View
    {
        return view('excel_templates.template', [
            'datos' => $this->datos,
            'totalHoras' => $this->totalHoras,
            'user' => $this->user,
            'fecha' => $this->currentDate,
            'pass_time' => $this->pass_time,
            'date_inicio' => $this->date_inicio,
            'date_final' => $this->date_final,
            'user_time' => $this->user_time,
            'dependence_time' => $this->dependence_time,
        ]);
    }

    public function styles(Worksheet $sheet)
    {

        $styles = [
            1 => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
                'font' => [
                    'bold' => true,
                    'size' => 20,
                ],
            ],
            'A3:A6' => [
                'font' => [
                    'bold' => true,
                ],
            ],
        ];

        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        $sheet->getPageMargins()->setTop(0.25);
        $sheet->getPageMargins()->setRight(0.25);
        $sheet->getPageMargins()->setBottom(0.25);
        $sheet->getPageMargins()->setLeft(0.25);

        foreach ($styles as $range => $style) {
            $sheet->getStyle($range)->applyFromArray($style);
        }
        // Ajustar área de impresión para incluir las columnas O y P
        $sheet->getPageSetup()->setPrintArea('A1:O' . $sheet->getHighestRow());

        // Intentar ajustar el contenido a una página
        $sheet->getPageSetup()->setFitToWidth(1);
        $sheet->getPageSetup()->setFitToHeight(0);

        return $sheet;
    }

}