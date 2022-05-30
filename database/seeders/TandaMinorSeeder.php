<?php

namespace Database\Seeders;

use App\Models\TandaMinor;
use Illuminate\Database\Seeder;

class TandaMinorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tanda_minor = [
            [
                'value' => 'Tekanan darah meningkat'
            ],
            [
                'value' => 'Pola nafas berubah'
            ],
            [
                'value' => 'Nafsu makan berubah'
            ],
            [
                'value' => 'Proses berfikir terganggu'
            ],
            [
                'value' => 'Menarik diri'
            ],
            [
                'value' => 'Berfokus pada diri sendiri'
            ],
            [
                'value' => 'Diaphoresis'
            ],
            [
                'value' => 'Merasa takut mengalami cedera berulang'
            ],
            [
                'value' => 'Bersikap protektif (mis, menghindari posisi nyeri)'
            ],
            [
                'value' => 'Waspada'
            ],
            [
                'value' => 'Pola tidur berubah'
            ],
            [
                'value' => 'Anoreksia'
            ],
            [
                'value' => 'Fokus menyempit'
            ],
        ];

        foreach ($tanda_minor as $key => $value) {
            TandaMinor::updateOrCreate(['value' => $value['value']], $value);
        }
    }
}
