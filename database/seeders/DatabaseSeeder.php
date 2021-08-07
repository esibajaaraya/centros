<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            palosSeeds::class,
            cartasSeeds::class,
            barajasSeeds::class,
            barajacartasSeeds::class,
        ]);
    }
}
