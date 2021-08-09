<?php

namespace App\Http\Controllers;

use App\Models\Baraja;
use Illuminate\Http\Request;
use App\Models\BarajaCarta;
use App\Models\Jugador;
use App\Models\Juego;
use App\Models\Turno;
use App\Models\JuegoJugador;


class JuegoController extends Controller
{

    public function menu(){
        $barajas = Baraja::All();
        $jugadores = Jugador::All();

        return view('menu', ["barajas" => $barajas, 'jugadores' => $jugadores]);
    }

    public function iniciar(Request $request)
    {
        $restantes = array();
        $baraja = BarajaCarta::where("baraja_id", $request->baraja_id)->pluck('id')->toArray();
        for ($i = 1; $i <= $request->cantidad_barajas; $i++) {
            $restantes = array_merge($restantes, $baraja);
        }
        //Guardo el juego
        $juego = new Juego();
        $juego->baraja_id = $request->baraja_id;
        $juego->nombre = $request->nombre;
        $juego->cantidad_barajas = $request->cantidad_barajas;
        $juego->minima = $request->minima;
        $juego->pozo = count($request->jugadores) * $request->minima;
        $juego->terminado = false;
        $juego->save();
        //Guardo el turno inicial
        $turno = new Turno();
        $turno->juego_id = $juego->id;
        $turno->orden = 0;
        $turno->jugador_id = 1;
        $turno->restantes = implode("|", $restantes);
        $turno->save();
        //Guardo Jugadores
        $i = 1;
        foreach ($request->jugadores as $jugador) {
            $jj = new JuegoJugador();
            $jj->juego_id = $juego->id;
            $jj->jugador_id = $jugador;
            $jj->orden = $i;
            $jj->save();
            $i++;
        }
        $jugadores = JuegoJugador::where('juego_id', $juego->id)->get();
        $turno = $this->tirar($juego->id);

        return view('juego', ["juego" => $juego, "jugadores" => $jugadores, "turno" => $turno, "cartas" => [BarajaCarta::find($turno->carta_1), BarajaCarta::find($turno->carta_2)]]);
    }

    public function tirar($juego_id)
    {
        $turno_ant = Turno::where('juego_id', $juego_id)->orderBy('id', 'desc')->first();
        $jugadores = JuegoJugador::where("juego_id", $juego_id)->get();
        if($turno_ant->orden == 0) {
            $jugador_id = $jugadores->where('orden', 1)->first()->jugador_id;
        } else {
            $orden_ant = $jugadores->where('jugador_id', $turno_ant->jugador_id)->first()->orden;
            ($orden_ant == count($jugadores)) ? $jugador_id = $jugadores->where('orden', 1)->first()->jugador_id : $jugador_id = $jugadores->where('orden', $orden_ant + 1)->first()->jugador_id;
        }
        $restantes = explode("|", $turno_ant->restantes);
        shuffle($restantes);
        if (count($restantes) >= 3) {
            $c1 = array_pop($restantes);
            $carta_1 = BarajaCarta::find($c1);
            $c2 = array_pop($restantes);
            $carta_2 = BarajaCarta::find($c2);
            $turno = new Turno();
            $turno->juego_id = $juego_id;
            $turno->jugador_id = $jugador_id;
            $turno->orden = $turno_ant->orden + 1;
            $turno->carta_1 = $c1;
            $turno->carta_2 = $c2;
            $turno->restantes = implode("|", $restantes);
            $turno->save();
            //Validaciones de par o continuas
            return $turno;
        } else {
            $juego = Juego::find($juego_id);
            $juego->terminado = true;
            $juego->save();
            return array("terminado" => true);
        }
    }

    public function jugar($turno_id, $apuesta)
    {
        $turno = Turno::find($turno_id);
        $turno->apuesta = $apuesta;
        $restantes = explode("|", $turno->restantes);
        shuffle($restantes);
        $cj = array_pop($restantes);
        $turno->carta_juego = $cj;
        $c1 = BarajaCarta::find($turno->carta_1);
        $c2 = BarajaCarta::find($turno->carta_2);
        $carta = BarajaCarta::find($cj);
        if ($c1->carta->valor > $c2->carta->valor) {
            $may = $c1->carta->valor;
            $men = $c2->carta->valor;
        } else {
            $men = $c1->carta->valor;
            $may = $c2->carta->valor;
        }
        if ($carta->carta->valor > $men && $carta->carta->valor < $may) {
            $turno->victoria = true;
            $turno->resultado = $carta->carta->nombre. $carta->palo->simbolo . ' está en medio de ' . $c1->carta->nombre . $c1->palo->simbolo. ' y ' . $c2->carta->nombre . $c2->palo->simbolo . '. '. $turno->jugador->nombre . " gana " . ($apuesta * $turno->juego->minima)*2;
        } else {
            $turno->victoria = false;
            $turno->resultado = $carta->carta->nombre. $carta->palo->simbolo . ' no está en medio de ' . $c1->carta->nombre . $c1->palo->simbolo. ' y ' . $c2->carta->nombre . $c2->palo->simbolo . '. '. $turno->jugador->nombre . " pierde " . $apuesta * $turno->juego->minima;
        }
        $turno->save();

        return response()->json([
            'carta_juego' => $carta->carta->nombre. $carta->palo->simbolo,
            'resultado' => $turno->resultado
        ]);
    }
}
