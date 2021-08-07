<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class cartasSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('cartas')->insert([[
            'nombre' => 'A',
            'valor' => 1,
        ],[
            'nombre' => 'J',
            'valor' => 11,
        ],[
            'nombre' => 'Q',
            'valor' => 12,
        ],[
            'nombre' => 'K',
            'valor' => 13,
        ]]);
        for($i=2; $i <= 10; $i++){
            \DB::table('cartas')->insert([
                'nombre' => $i,
                'valor' => $i,
            ]);
        }
    }
}
