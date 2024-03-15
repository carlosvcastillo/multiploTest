<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MultiploTestController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Esta ruta la ocupe como vista principal para mostrar el formulario
Route::get('api/test', function () {
    return view('test');
});

//Esta ruta la ocupe para realizar la operacion logica del ejercicio para el cual estoy usando un alias para ocuparlo en la vista (el alias es 'name')
Route::post('api/test', [MultiploTestController::class, 'obtenerMultiplos'])->where('numero', '[0-9]+')->name('notes.test');
