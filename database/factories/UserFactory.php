<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'nama' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'jabatan' => $this->faker->word(),
            'nik' => rand(1000000000000000, 9999999999999999),
            'nip' => rand(100000000000000000, 999999999999999999),
            'no_hp' => $this->faker->e164PhoneNumber(),
            'alamat' => $this->faker->address(),
            'password' => bcrypt('asdasdasd'),
            'tanggal_lahir' => Carbon::now()->subYear(20)->subDay(rand(10, 99)),
            'tempat_lahir' => $this->faker->address(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
