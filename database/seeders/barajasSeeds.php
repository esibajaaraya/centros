<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class barajasSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('barajas')->insert([
            'nombre' => 'Baraja Española'
        ]);
    }
}
