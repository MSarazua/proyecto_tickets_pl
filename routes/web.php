<?php

use App\Http\Controllers\AreasController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\RequirementsController;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ReportsController;

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::resource('requerimientos', RequirementsController::class);
    Route::get('tablero', [RequirementsController::class, 'tablero'])->name('tablero');
    Route::resource('usuario', UsersController::class);
});

Route::group(['middleware' => ['auth', 'role:Admin']], function () {
    Route::resource('areas', AreasController::class);
    Route::resource('reportes', ReportsController::class);
});

Route::group(['middleware' => ['auth', 'role:Admin|Dev']], function () {
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
});

Route::post('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::get('/test-email', function () {
    try {
        Mail::raw('Este es un correo de prueba', function ($message) {
            $message->to('msarazua@prensalibre.com.gt')
                    ->subject('Correo de Prueba');
        });
        return 'Correo enviado correctamente';
    } catch (\Exception $e) {
        return 'Error al enviar el correo: ' . $e->getMessage();
    }
});
