<?php

namespace App\Http\Controllers;

use App\Models\Results;
use Illuminate\Http\Request;

class MultiploTestController extends Controller
{

    private $_multiplos = [
        3 => 'green',
        5 => 'red',
        7 => 'blue'
    ];

    function obtenerMultiplos(Request $request) {
        $allMultiplos=array();
        $multiploResultado = [];
        $numero = $request->input('numero');

        if($numero <= 0) {
            return view('test', ['result' => $multiploResultado, 'usuarioNumero' => $numero, 'color' => $this->_multiplos]);
        }

        foreach ($this->_multiplos as $key => $value) {
            if ($numero%$key == 0) {
                $multiploResultado[] = $key; 
            }
        }

        Results::create(
            [
                'numeroUsuario' => $numero,
                'resultado' => implode(' y ', $multiploResultado)
            ]
        );

        return view('test', ['result' => $multiploResultado, 'usuarioNumero' => $numero, 'color' => $this->_multiplos]);
    }
}
