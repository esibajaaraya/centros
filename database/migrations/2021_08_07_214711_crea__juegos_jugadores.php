<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreaJuegosJugadores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('juegos_jugadores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('juego_id')->constrained('juegos');
            $table->foreignId('jugador_id')->constrained('jugadores');
            $table->integer('orden');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('juegos_jugadores');
    }
}
