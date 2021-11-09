<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
    protected $table = 'turnos';

    public function juego() {
        return $this->belongsTo('App\Models\Juego', 'juego_id');
    }

    public function jugador() {
        return $this->belongsTo('App\Models\Jugador', 'jugador_id');
    }
}
