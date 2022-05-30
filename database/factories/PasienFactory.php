<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class PasienFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $kelamin = ['Laki-Laki', 'Perempuan'];

        $hubungan = ['Ayah', 'Anak', 'Ibu', 'Kakek', 'Nenek', 'Kerabat'];

        return [
            'nama' => $this->faker->name(),
            'jenis_kelamin' => $kelamin[rand(0,1)],
            'tempat_lahir' => $this->faker->address(),
            'tanggal_lahir' => Carbon::now()->subYear(20)->subDay(rand(10, 99)),
            'alamat' => $this->faker->address(),
            'no_hp' => $this->faker->e164PhoneNumber(),
            'tanggal_masuk' => Carbon::now()->subDay(rand(30, 50)),
            'tanggal_keluar' => Carbon::now()->subDay(rand(10, 20)),
            'nama_wali' => $this->faker->name(),
            'hubungan_wali' => $hubungan[rand(0,5)],
            // 'keluhan_utama' => $this->faker->sentence(),
            // 'diagnosa_medis' => $this->faker->sentence(),
            'kontak_wali' => $this->faker->e164PhoneNumber(),
            'no_rm' => rand(1, 99),
        ];
    }
}
