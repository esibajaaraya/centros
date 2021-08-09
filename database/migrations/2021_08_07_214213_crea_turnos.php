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
            $table->integer('orden');
            $table->integer('carta_1')->nullable();
            $table->integer('carta_2')->nullable();
            $table->integer('carta_juego')->nullable();
            $table->boolean('victoria')->nullable();
            $table->decimal('apuesta')->nullable();
            $table->string('restantes');
            $table->string('resultado')->nullable();;
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
