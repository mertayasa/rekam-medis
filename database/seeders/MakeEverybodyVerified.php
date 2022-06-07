<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class MakeEverybodyVerified extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        foreach ($users as $key => $user) {
            $user->email_verified_at = now();
            $user->save();
        }
    }
}
