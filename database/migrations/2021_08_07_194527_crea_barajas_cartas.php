<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreaBarajasCartas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barajas_cartas', function (Blueprint $table) {
            $table->id();
            $table->integer('baraja_id', false,true);
            $table->integer('carta_id', false,true);
            $table->integer('palo_id', false,true);
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
        Schema::dropIfExists('barajas_cartas');
    }
}
