<?php

namespace Database\Seeders;

use App\Models\Intervensi;
use App\Models\OpsiIntervensi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class IntervensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        OpsiIntervensi::query()->truncate();
        Intervensi::query()->truncate();
        $intervensi = [
            [
                'value' => 'Pemberian analgesik',
                'keterangan' => 'Menyiapkan dan memberikan agen farmakologis untuuk menhurangi atau menghilangkan rasa sakit',
            ],
            [
                'value' => 'Edukasi teknik napas',
                'keterangan' => 'Sample, Sample, Sample, Sample, Sample'
            ],
            [
                'value' => 'Kompres dingin',
                'keterangan' => 'Sample, Sample, Sample, Sample, Sample'
            ],
            [
                'value' => 'Kompres hangat',
                'keterangan' => 'Sample, Sample, Sample, Sample, Sample'
            ],
            [
                'value' => 'Pemantauan nyeri',
                'keterangan' => 'Sample, Sample, Sample, Sample, Sample'
            ],
            [
                'value' => 'Teknik distraksi',
                'keterangan' => 'Sample, Sample, Sample, Sample, Sample'
            ],
            [
                'value' => 'Terapi pemijatan',
                'keterangan' => 'Sample, Sample, Sample, Sample, Sample'
            ],
        ];

        Intervensi::insert($intervensi);

        $opsi_intervensi = [
            [
                'id_intervensi' => 1,
                'id_parent' => null,
                'value' => 'Observasi',
            ],
            [
                'id_intervensi' => 1,
                'id_parent' => null,
                'value' => 'Terapeutik',
            ],
            [
                'id_intervensi' => 1,
                'id_parent' => null,
                'value' => 'Edukasi'
            ],
            [
                'id_intervensi' => 1,
                'id_parent' => null,
                'value' => 'Kolaborasi'
            ],
        ];

        $sub_option = [
            // Observasi
            [
                'id_intervensi' => 1,
                'id_parent' => 1,
                'value' => 'Identifikasi karakteristik nyeri (misalnya pencetus, pereda, kualitas, lokasi, intensitas, frekuensi dan durasi)'
            ],
            [
                'id_intervensi' => 1,
                'id_parent' => 1,
                'value' => 'Identifikasi riwayat alergi obat'
            ],
            [
                'id_intervensi' => 1,
                'id_parent' => 1,
                'value' => 'Identifikasi kesesuaian jenis analgesik (misalnya narkotika, non-narkotik atau NSAIO) dengan tingkat keparahan nyeri'
            ],
            [
                'id_intervensi' => 1,
                'id_parent' => 1,
                'value' => 'Monitor tanda-tanda vital sebelum dan sesudah pemberian analgesik'
            ],
            [
                'id_intervensi' => 1,
                'id_parent' => 1,
                'value' => 'Monitor efektifitas analgesik'
            ],

            // Terapeutik
            [
                'id_intervensi' => 1,
                'id_parent' => 2,
                'value' => 'Sample, Sample, Sample, Sample'
            ],
            [
                'id_intervensi' => 1,
                'id_parent' => 2,
                'value' => 'Sample, Sample, Sample, Sample'
            ],

            // Edukasi
            [
                'id_intervensi' => 1,
                'id_parent' => 3,
                'value' => 'Sample, Sample, Sample, Sample'
            ],
            [
                'id_intervensi' => 1,
                'id_parent' => 3,
                'value' => 'Sample, Sample, Sample, Sample'
            ],

            // Kolaborasi
            [
                'id_intervensi' => 1,
                'id_parent' => 4,
                'value' => 'Sample, Sample, Sample, Sample'
            ],
            [
                'id_intervensi' => 1,
                'id_parent' => 4,
                'value' => 'Sample, Sample, Sample, Sample'
            ],
        ];

        OpsiIntervensi::insert($opsi_intervensi);
        OpsiIntervensi::insert($sub_option);



        // foreach ($intervensi as $key => $value) {
        //     $new_intervensi = Intervensi::updateOrCreate(['value' => $value['value']], $value);
        //     $new_intervensi->refresh();
        // }
    }
}
