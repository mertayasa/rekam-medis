<?php

namespace Database\Seeders;

use App\Models\Intervensi;
use App\Models\OpsiIntervensi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


class NewIntervensiSeeder extends Seeder
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
                'value' => 'Pemberian Analgesik',
                'keterangan' => 'Menyiapkan dan memberikan agen farmakologis untuuk menhurangi atau menghilangkan rasa sakit',
                'url_youtube' => null
            ],
            [
                'value' => 'Pemantauan Nyeri',
                'keterangan' => 'Mengumpulkan dan menganalisis data nyeri',
                'url_youtube' => null
            ],
            [
                'value' => 'Perawatan Kenyamanan',
                'keterangan' => 'Mengidentifikasi dan merawat pasien untuk meningkatkan rasa nyaman.',
                'url_youtube' => null
            ],
            [
                'value' => 'Edukasi Manajemen Nyeri',
                'keterangan' => 'Mengajarkan pengelolaan suhu tubuh yang lebih optimal',
                'url_youtube' => null
            ],
        ];

        Intervensi::insert($intervensi);

        $opsi_intervensi = [
            // Pemberian Analgesik 1-4
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

            // Pemantauan Nyeri 5-7
            [
                'id_intervensi' => 2,
                'id_parent' => null,
                'value' => 'Observasi',
            ],
            [
                'id_intervensi' => 2,
                'id_parent' => null,
                'value' => 'Terapeutik',
            ],
            [
                'id_intervensi' => 2,
                'id_parent' => null,
                'value' => 'Edukasi'
            ],

            // Perawatan kenyamanan 8-11
            [
                'id_intervensi' => 3,
                'id_parent' => null,
                'value' => 'Observasi',
            ],
            [
                'id_intervensi' => 3,
                'id_parent' => null,
                'value' => 'Terapeutik',
            ],
            [
                'id_intervensi' => 3,
                'id_parent' => null,
                'value' => 'Edukasi'
            ],
            [
                'id_intervensi' => 3,
                'id_parent' => null,
                'value' => 'Kolaborasi'
            ],

            // Edukasi Manajemen Nyeri 12-14
            [
                'id_intervensi' => 4,
                'id_parent' => null,
                'value' => 'Observasi',
            ],
            [
                'id_intervensi' => 4,
                'id_parent' => null,
                'value' => 'Terapeutik',
            ],
            [
                'id_intervensi' => 4,
                'id_parent' => null,
                'value' => 'Edukasi'
            ],
        ];

        $sub_option = [
            // Id parent 1-4
            // Id intervensi 1 Pemberian Analgesik

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
                'value' => 'Diskusikan jenis analgesik yang disukai untuk mencapai analgesia optimal, jika perlu'
            ],
            [
                'id_intervensi' => 1,
                'id_parent' => 2,
                'value' => 'Pertimbangkan penggunaan infus kontinyu atau bolus opioid untuk mempertahankan kadar dalam serum'
            ],
            [
                'id_intervensi' => 1,
                'id_parent' => 2,
                'value' => 'Tetapkan target efektifitas analgesik untuk mengoptimalkan respons pasien'
            ],
            [
                'id_intervensi' => 1,
                'id_parent' => 2,
                'value' => 'Dokumentasikan respons terhadap efek analgesik dan efek yang tidak diinginkan '
            ],

            // Edukasi
            [
                'id_intervensi' => 1,
                'id_parent' => 3,
                'value' => 'Jelaskan efek terapi dan efek samping obat'
            ],

            // Kolaborasi
            [
                'id_intervensi' => 1,
                'id_parent' => 4,
                'value' => 'Kolaborasi pemberian dosis dan jenis analgesik, jika perlu'
            ],

            // Id parent 5-7
            // Id intervensi 2 Pemantauan Nyeri

            // Observasi
            [
                'id_intervensi' => 2,
                'id_parent' => 5,
                'value' => 'Identifikasi faktor pencetus dan pereda nyeri'
            ],
            [
                'id_intervensi' => 2,
                'id_parent' => 5,
                'value' => 'Monitor kualitas nyeri (mis. terasa tajam, tumpul, diremas-remas, ditimpa beban berat)'
            ],
            [
                'id_intervensi' => 2,
                'id_parent' => 5,
                'value' => 'Monitor lokasi dan penyebaran nyeri'
            ],
            [
                'id_intervensi' => 2,
                'id_parent' => 5,
                'value' => 'Monitor intensitas nyeri dengan menggunakan skala'
            ],
            [
                'id_intervensi' => 2,
                'id_parent' => 5,
                'value' => 'Monitor durasi dan frekuensi nyeri'
            ],
            
            // Terapeutik
            [
                'id_intervensi' => 2,
                'id_parent' => 6,
                'value' => 'Atur interval waktu pemantauan sesuai dengan kondisi pasien'
            ],
            [
                'id_intervensi' => 2,
                'id_parent' => 6,
                'value' => 'Dokumentasikan hasil pemantauan'
            ],

            // Edukasi
            [
                'id_intervensi' => 2,
                'id_parent' => 7,
                'value' => 'Jelaskan tujuan dan prosedur pemantauan'
            ],
            [
                'id_intervensi' => 2,
                'id_parent' => 7,
                'value' => 'Informasikan hasil pemantauan, jika peru'
            ],

            // Id parent 8-12
            // Id intervensi 3 Perawatan kenyamanan

            // Observasi
            [
                'id_intervensi' => 3,
                'id_parent' => 8,
                'value' => 'Identifikasi gejala yang tidak menyenangkan (mis. mual, nyeri, gatal, sesak)'
            ],
            [
                'id_intervensi' => 3,
                'id_parent' => 8,
                'value' => 'Identifikasi pemahaman tentang kondisi, situasi dan perasaannya'
            ],
            [
                'id_intervensi' => 3,
                'id_parent' => 8,
                'value' => 'Identifikasi masala emosional dan spiritual'
            ],

            // Terapeutik
            [
                'id_intervensi' => 3,
                'id_parent' => 9,
                'value' => 'Berikan posisi yang nyaman'
            ],
            [
                'id_intervensi' => 3,
                'id_parent' => 9,
                'value' => 'Berikan kompres dingin atau hangat'
            ],
            [
                'id_intervensi' => 3,
                'id_parent' => 9,
                'value' => 'Ciptakan lingkungan yang nyaman'
            ],
            [
                'id_intervensi' => 3,
                'id_parent' => 9,
                'value' => 'Berikan pemijatan'
            ],
            [
                'id_intervensi' => 3,
                'id_parent' => 9,
                'value' => 'Berikan terapi akupresur'
            ],
            [
                'id_intervensi' => 3,
                'id_parent' => 9,
                'value' => 'Berikan terapi hipnosis'
            ],
            [
                'id_intervensi' => 3,
                'id_parent' => 9,
                'value' => 'Dukung keluarga dan pengasuh terlibat dalam terapi/pengobatan'
            ],
            [
                'id_intervensi' => 3,
                'id_parent' => 9,
                'value' => 'Diskusikan mengenai situasi dan pilihan terapi/pengobatan yang dinginkan'
            ],
            
            // Edukasi
            [
                'id_intervensi' => 3,
                'id_parent' => 10,
                'value' => 'Jelaskan mengenai kondisi dan pilihan terapi/pengobatan'
            ],
            [
                'id_intervensi' => 3,
                'id_parent' => 10,
                'value' => 'Ajarkan terapi relaksasi'
            ],
            [
                'id_intervensi' => 3,
                'id_parent' => 10,
                'value' => 'Ajarkan latihan pernapasan'
            ],
            [
                'id_intervensi' => 3,
                'id_parent' => 10,
                'value' => 'Ajarkan teknik distraksi dan imajinasi terbimbing'
            ],
            
            // Kolaborasi
            [
                'id_intervensi' => 3,
                'id_parent' => 11,
                'value' => 'Kolaborasi pemberian analgesik, antipruritus, antihistamin, jika pertu'
            ],

            // Id parent 12-14
            // Id intervensi 4 Edukasi Manajemen Nyeri

            // Observasi
            [
                'id_intervensi' => 4,
                'id_parent' => 12,
                'value' => 'Identifikasi kesiapan dan kemampuan menerima informasi'
            ],

            // Terapeutik
            [
                'id_intervensi' => 4,
                'id_parent' => 13,
                'value' => 'Sediakan materi dan media pendidikan kesehatan'
            ],
            [
                'id_intervensi' => 4,
                'id_parent' => 13,
                'value' => 'Jadwalkan pendidikan kesehatan sesuai kesepakatan'
            ],
            [
                'id_intervensi' => 4,
                'id_parent' => 13,
                'value' => 'Berikan kesempatan untuk bertanya'
            ],

            // Edukasi
            [
                'id_intervensi' => 4,
                'id_parent' => 14,
                'value' => 'Jelaskan penyebab, periode, dan strategi meredakan nyeri'
            ],
            [
                'id_intervensi' => 4,
                'id_parent' => 14,
                'value' => 'Anjurkan memonitor nyeri secara mandiri'
            ],
            [
                'id_intervensi' => 4,
                'id_parent' => 14,
                'value' => 'Anjurkan menggunakan anakgetik secara tepat'
            ],
            [
                'id_intervensi' => 4,
                'id_parent' => 14,
                'value' => 'Ajarkan teknik nonfarmakologis untuk mengurangi rasa nyeri.'
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
