<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class palosSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('palos')->insert([[
            'nombre' => 'Picas',
            'simbolo' => '♠',
        ],[
            'nombre' => 'Treboles',
            'simbolo' => '♣',
        ],[
            'nombre' => 'Corazones',
            'simbolo' => '♥',
        ],[
            'nombre' => 'Diamantes',
            'simbolo' => '♦',
        ]]);
    }
}
