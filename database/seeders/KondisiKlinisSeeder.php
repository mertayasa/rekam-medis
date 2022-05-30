<?php

namespace Database\Seeders;

use App\Models\KondisiKlinis;
use Illuminate\Database\Seeder;

class KondisiKlinisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kondisi_klinis = [
            [
                'value' => 'Kondisi pembedahan'
            ],
            [
                'value' => 'Cedera traumatis'
            ],
            [
                'value' => 'Infeksi'
            ],
            [
                'value' => 'Sindrom coroner akut'
            ],
            [
                'value' => 'Glaukoma'
            ],
            [
                'value' => 'Kondisi kronis (mis, arthritis rheumatoid)'
            ],
            [
                'value' => 'Cedera medulla spinalis'
            ],
            [
                'value' => 'Kondisi pasca trauma'
            ],
            [
                'value' => 'Tumor'
            ],
        ];

        foreach ($kondisi_klinis as $key => $value) {
            KondisiKlinis::updateOrCreate(['value' => $value['value']], $value);
        }
    }
}
