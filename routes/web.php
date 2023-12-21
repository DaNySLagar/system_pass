<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ChartController;

use App\Http\Controllers\PassController;
use App\Http\Controllers\ChargeController;
use App\Http\Controllers\DependenceController;
use App\Http\Controllers\TimeController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\UsernocheckController;
use App\Http\Controllers\UsercheckController;
use App\Http\Controllers\BosscheckController;
use App\Http\Controllers\RhcheckController;
use App\Http\Controllers\ArchivedController;

use App\Http\Controllers\HourController;
use App\Http\Controllers\DepartureTimeController;
use App\Http\Controllers\ReturnTimeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PetitionController;

use Spatie\Permission\Models\Role;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [ChartController::class, 'useChart1'])->name('dashboard');
    //Route::get('/dashboard', [ChartController::class, 'useChart2'])->name('dashboard');
});


//Acciones universales

Route::get('passes/{id}/firmar', [PassController::class, 'firmar'])->middleware('auth')->name('passes.firmar');
Route::get('passes/{id}/firmaruser', [UsercheckController::class, 'firmarUser'])->middleware('auth')->name('passes.firmaruser');
Route::get('passes/{id}/firmarboss', [BosscheckController::class, 'firmarBoss'])->middleware('auth')->name('passes.firmarboss');
Route::get('passes/{id}/firmarrh', [RhcheckController::class, 'firmarRh'])->middleware('auth')->name('passes.firmarrh');
Route::get('passes/{id}/archivar', [HourController::class, 'archivar'])->middleware('auth')->name('passes.archivar');
Route::get('hours/{id}/asignarHoraSalida', [DepartureTimeController::class, 'assign_departure_time'])->middleware('auth')->name('hours.asignarHoraSalida');


//acciones del guardian
Route::get('hours', [HourController::class, 'index'])->middleware(['auth', 'role:Guardian'])->name('hours.index');
Route::get('hours/{id}/asignarHoraRetorno', [ReturnTimeController::class, 'assing_return_time'])->middleware(['auth', 'role:Guardian'])->name('hours.asignarHoraRetorno');
Route::post('hours/horaRetornoStore', [ReturnTimeController::class, 'return_hour_store'])->middleware(['auth', 'role:Guardian,JefeRrHh,JefeOficina'])->name('hours.store');

//acciones el administrador
Route::put('user/{user}', [UserController::class, 'updatedate'])->middleware(['auth', 'role:Administrador'])->name('users.updatedate');
Route::resource('users', UserController::class)->only(['index', 'edit', 'update', 'destroy', 'store'])->middleware(['auth', 'role:Administrador']);

Route::resource('charges', ChargeController::class)->middleware(['auth', 'role:Administrador']);
Route::resource('dependences', DependenceController::class)->middleware(['auth', 'role:Administrador']);
Route::resource('times', TimeController::class)->middleware(['auth', 'role:Administrador']);
Route::get('passesadmin.reporte', [AdminController::class, 'reporte'])->middleware(['auth', 'role:Administrador'])->name('passesadmin.reporte');
Route::get('passesadmin', [AdminController::class, 'index'])->middleware(['auth', 'role:Administrador'])->name('passesadmin.index');


//administrador / guardian / Jefe RRHH

Route::get('archived', [ArchivedController::class, 'index'])->middleware(['auth', 'role:Administrador,JefeRrHh,Guardian'])->name('archived.index');
Route::get('archived/{id}/show', [ArchivedController::class, 'show'])->middleware(['auth', 'role:Administrador,JefeRrHh,Guardian'])->name('archived.show');
Route::get('archived.reporte', [ArchivedController::class, 'reporte'])->middleware(['auth', 'role:Administrador,JefeRrHh,Guardian'])->name('archived.reporte');
Route::get('archived/{id}/print', [ArchivedController::class, 'print'])->middleware(['auth', 'role:Administrador,JefeRrHh,Guardian'])->name('archived.print');

//acciones del jefe RRHH
Route::get('rhcheck', [RhcheckController::class, 'index'])->middleware(['auth', 'role:JefeRrHh'])->name('rhcheck.index');



//Acciones del jefe directo
Route::get('bosscheck', [BosscheckController::class, 'index'])->middleware(['auth', 'role:JefeOficina'])->name('bosscheck.index');


//Aciones del empleado
Route::get('passes/{id}/print', [PassController::class, 'print'])->middleware(['auth', 'role:Empleado'])->name('passes.print');
Route::get('passes.reporte', [PassController::class, 'reporte'])->middleware(['auth', 'role:Empleado'])->name('passes.reporte');
Route::resource('passes', PassController::class)->middleware(['auth', 'role:Empleado']);


//pass acciones de empleado
Route::get('usernocheck', [UsernocheckController::class, 'index'])->middleware(['auth', 'role:Empleado'])->name('usernocheck.index');
Route::get('usercheck', [UsercheckController::class, 'index'])->middleware(['auth', 'role:Empleado'])->name('usercheck.index');


Route::get('excel', [ReportController::class, 'exportar'])->middleware('auth')->name('excel.exportar');
Route::get('pdfFormat', [ReportController::class, 'pdfFormat'])->middleware('auth')->name('pdfFormat');

