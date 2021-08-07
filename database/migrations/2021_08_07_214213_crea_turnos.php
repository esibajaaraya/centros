<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreaTurnos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turnos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('juego_id')->constrained('juegos');
            $table->foreignId('jugador_id')->constrained('jugadores');
            $table->integer('carta_1');
            $table->integer('carta_2');
            $table->integer('carta_juego');
            $table->boolean('victoria');
            $table->decimal('apuesta');
            $table->string('restantes');
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
        Schema::dropIfExists('turnos');
    }
}
