<?php

use App\Http\Controllers\SendEmailController;
use App\Http\Controllers\web\EventoController;
use App\Http\Controllers\web\FotografoController;
use App\Http\Controllers\web\PaqueteController;
use App\Http\Controllers\web\UserController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [WelcomeController::class,'index'])->name('welcome.index');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    //PERFIL USUARIO
    Route::get('/perfil/configuracion', [UserController::class, 'perfil'])->name('user.perfil');
    //USUARIOS
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user', [UserController::class, 'store'])->name('user.store');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    //FOTOGRAFIA
    Route::get('/fotografo/imagen', [FotografoController::class, 'index_imagen'])->name('fotografo.imagen.index');
    Route::get('/fotografo/upload/imagen', [FotografoController::class, 'upload_imagen'])->name('fotografo.upload.imagen');
    Route::post('/fotografo/upload/imagen/store', [FotografoController::class, 'upload_imagen_store'])->name('fotografo.upload.imagen.store');

    //****EVENTO****************************** */
    Route::get('/evento', [EventoController::class, 'index'])->name('evento.index');
    Route::get('/evento/create', [EventoController::class, 'create'])->name('evento.create');
    Route::post('/evento', [EventoController::class, 'store'])->name('evento.store');
    Route::get('/paqueteshow', [PaqueteController::class, 'show'])->name('paqueteshow');
    Route::get('/evento/{id}/clientes', [EventoController::class, 'eventoCliente'])->name('evento.cliente');//para ver los clientes vinculados a un evento
    Route::get('/evento/invitation/{id}', [EventoController::class, 'invitacion'])->name('evento.invitacion');
    // ***************ACEPTAR EL CORREO************************
    Route::get('accept-invitation/{id}', [SendEmailController::class, 'acceptInvitation']);
    Route::post('accept-invitation/{id}', [SendEmailController::class, 'storeAccept'])->name('email.accept');
    //ruta para enviar correo
    Route::post('send-email', [SendEmailController::class, 'sendEmail'])->name('email.send');
    //****************CLIENTE */
   // Route::get('eventos/vinculados', [EventoController::class, 'eventosCliente'])->name('evento.cliente');
    //*************PARA VER LOS EVENTOS DE UN CLIENTE DADO */
    Route::get('evento/cliente/{id}', [EventoController::class, 'eventosClienteOne'])->name('evento.cliente.one');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
