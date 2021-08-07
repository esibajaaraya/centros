<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarajaCarta;

class JuegoController extends Controller
{

    public function inicia_juego(){
        $baraja = BarajaCarta::where('baraja_id', 1)->get();
    }

    private function saca_carta($baraja)
    {
        $min = min($baraja["íd"]);
        $max = max($baraja["íd"]);
        return $c1 = rand($min, $max);
    }

    public function tirar(){
        $cartas = array_rand($mazo, 3);
        $c1 = $cartas[0];
        $c2 = $cartas[1];
        $cjuego = $cartas[2];

        //quito las cartas
        unset($mazo[$c1], $mazo[$c2], $mazo[$cjuego]);

        //Saco primer carta
        $c1 = rand($min, $max);
    }
}
