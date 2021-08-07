<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class barajacartasSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($palo = 1; $palo <= 4; $palo++){
            for($carta = 1; $carta <= 13; $carta++){
                \DB::table('barajas_cartas')->insert([
                    'baraja_id' => 1,
                    'carta_id' => $carta,
                    'palo_id' => $palo,
                ]);
            }
        }
    }
}
