<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
/*Route::get('/mascota', [App\Http\Controllers\MascotaController::class, 'index'])->name('mascota.index');
Route::get('/mascota/create', [App\Http\Controllers\MascotaController::class, 'create'])->name('mascota.create');
Route::post('/mascota/store', [App\Http\Controllers\MascotaController::class, 'store'])->name('mascota.store');
Route::put('/mascota/{mascota', [App\Http\Controllers\MascotaController::class, 'store'])->name('mascota.store');
Route::delete('/mascota/store', [App\Http\Controllers\MascotaController::class, 'store'])->name('mascota.store');*/

//Agrupar las rutas //
Route::resource('/mascota', \App\Http\Controllers\MascotaController::class);