<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class JugadoresSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('jugadores')->insert([
            'nombre' => 'Casa'
        ]);
    }
}
