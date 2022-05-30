<?php

namespace Database\Seeders;

use App\Models\TandaMayor;
use Illuminate\Database\Seeder;

class TandaMayorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tanda_mayor = [
            [
                'value' => 'Tampak meringis'
            ],
            [
                'value' => 'Bersikap protektif (mis, waspada, posisi menghindari nyeri)'
            ],
            [
                'value' => 'Gelisah'
            ],
            [
                'value' => 'Frekuensi nadi meningkat'
            ],
            [
                'value' => 'Sulit tidur'
            ],
            [
                'value' => 'Nyeri <3 bulan'
            ],
            [
                'value' => 'Merasa depresi (tertekan)'
            ],
            [
                'value' => 'Tidak mampu menuntaskan aktivitas'
            ],
        ];

        foreach ($tanda_mayor as $key => $value) {
            TandaMayor::updateOrCreate(['value' => $value['value']], $value);
        }
    }
}
