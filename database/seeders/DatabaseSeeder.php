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
        $this->call(UserSeeder::class);
        $this->call(PasienSeeder::class);
        $this->call(TandaMayorSeeder::class);
        $this->call(TandaMinorSeeder::class);
        // $this->call(KondisiKlinisSeeder::class);
        $this->call(IntervensiSeeder::class);
        $this->call(EtiologiSeeder::class);
        // \App\Models\User::factory(10)->create();
    }
}
