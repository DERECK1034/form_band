<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\bandscontroller;
use App\Http\Controllers\logincontroller;
use App\Http\Controllers\ventascontroller;
use App\Mail\notificacion;


Route::get('/', function () {
    return view('welcome');
});


Route::get('altabandas', [bandscontroller::class, 'altabandas'])->name('altabandas');
Route::POST('guardabanda', [bandscontroller::class, 'guardabanda'])->name('guardabanda');
Route::get('reportebandas', [bandscontroller::class, 'reportebandas'])->name('reportebandas');
Route::get('inicio', [bandscontroller::class, 'inicio'])->name('inicio');
Route::get('editabanda/{idb}', [bandscontroller::class, 'editabanda'])->name('editabanda');
Route::POST('guardacambios/{idb}', [bandscontroller::class, 'guardacambios'])->name('guardacambios');
Route::get('desactivabanda/{idb}', [bandscontroller::class, 'desactivabanda'])->name('desactivabanda');
Route::get('activabanda/{idb}', [bandscontroller::class, 'activabanda'])->name('activabanda');
Route::get('eliminabanda/{idb}', [bandscontroller::class, 'eliminabanda'])->name('eliminabanda');
Route::get('login', [logincontroller::class, 'login'])->name('login');
Route::POST('validar', [logincontroller::class, 'validar'])->name('validar');
Route::get('cerrarsesion', [logincontroller::class, 'cerrarsesion'])->name('cerrarsesion');
Route::get('crearventa', [ventascontroller::class, 'crearventa'])->name('crearventa');
Route::get('infocliente', [ventascontroller::class, 'infocliente']);
Route::get('conciertos', [ventascontroller::class, 'conciertos']);
Route::get('secciondetalle', [ventascontroller::class, 'secciondetalle']);
Route::get('codigoc', [ventascontroller::class, 'codigoc']);
Route::get('verificar-codigo-cupon', [ventascontroller::class, 'verificarCodigoCupon']);
Route::post('agregaelemento', [ventascontroller::class, 'agregaelemento'])->name('agregaelemento');
Route::get('/reporteventas', [ventascontroller::class, 'reporteventas'])->name('reporteventas');
Route::post('borraboleto', [ventascontroller::class, 'borraboleto'])->name('borraboleto');
Route::get('/editaventa/{idven}', [VentasController::class, 'editaventa'])->name('editaventa');
Route::post('actualizarventa/{idven}', [VentasController::class, 'actualizarventa'])->name('actualizarventa');
Route::get('newpassword', [logincontroller::class, 'newpassword'])->name('newpassword');
Route::get('validauser', [logincontroller::class, 'validauser'])->name('validauser');
Route::get('captchanuevo', [logincontroller::class, 'captchanuevo'])->name('captchanuevo');
Route::get('mandacorreo', [logincontroller::class, 'mandacorreo'])->name('mandacorreo');
Route::get('enviacorreo', [logincontroller::class, 'enviacorreo'])->name('enviacorreo');


Route::get('recupera',function (){

    Mail::to('dereckdownham2002@gmail.com')
        ->send(new notificacion("Dereck"));
        return "Mensaje Enviado";
    
})->name('recupera');

Route::get('newpassword2', [logincontroller::class, 'newpassword2'])->name('newpassword2');
Route::get('validauser2', [logincontroller::class, 'validauser2'])->name('validauser2');
Route::get('reinicia/{idu}',[logincontroller::class,'reinicia'])->name('reinicia');
Route::get('cambiapass',[logincontroller::class,'cambiapass'])->name('cambiapass');

