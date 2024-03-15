<?php

namespace App\Http\Controllers;

use App\Models\Results;
use Illuminate\Http\Request;

class MultiploTestController extends Controller
{
    //Aqui genere esta variable para identificar cuales eran los multiplos que solicitaban y agregue el color de cada uno de los mismos para usarlos mas adelante
    private $_multiplos = [
        3 => 'green',
        5 => 'red',
        7 => 'blue'
    ];
    //Esta funcion es la encargada de realizar la operacion y retornar los posibles multiplos encontrados con el numero que el usuario ingreso
    function obtenerMultiplos(Request $request) {
        $allMultiplos=array();
        $multiploResultado = [];
        $numero = $request->input('numero');

        //Se hace la validacion en caso de que el usuario ingrese un numero menor o igual a cero y retorna los posibles resultados a mi vista
        if($numero <= 0) {
            return view('test', ['result' => $multiploResultado, 'usuarioNumero' => $numero, 'color' => $this->_multiplos]);
        }

        //Recorro mi variable estatica con los numeros solicitados para su validacion de multiplos y en caso de encontrar los almacena en un array
        foreach ($this->_multiplos as $key => $value) {
            if ($numero%$key == 0) {
                $multiploResultado[] = $key; 
            }
        }

        //Aqui almaceno los valores obtenidos en mi tabla
        Results::create(
            [
                'numeroUsuario' => $numero,
                'resultado' => implode(' y ', $multiploResultado)
            ]
        );

        return view('test', ['result' => $multiploResultado, 'usuarioNumero' => $numero, 'color' => $this->_multiplos]);
    }
}
