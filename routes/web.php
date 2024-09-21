<?php

use App\Http\Controllers\AreasController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\RequirementsController;
use Spatie\Permission\Models\Role;

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('requerimientos', RequirementsController::class);
Route::get('tablero', [RequirementsController::class, 'tablero'])->name('tablero');
Route::resource('areas', AreasController::class);
