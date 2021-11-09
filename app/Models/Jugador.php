<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jugador extends Model
{
    protected $table = 'jugadores';

    public function juegos() {
        return $this->hasMany('App\Models\Juegos');
    }

    public function turno() {
        return $this->hasMany('App\Models\Turnos');
    }
}
