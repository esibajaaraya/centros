<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Juego extends Model
{
    protected $table = 'juegos';

    public function turno() {
        return $this->hasMany('App\Models\Turnos');
    }

    public function jugadores() {
        return $this->hasMany('App\Models\JuegoJugador');
    }
}
