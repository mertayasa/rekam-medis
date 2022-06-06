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
            [
                'value' => 'Edukasi Teknik Napas',
                'keterangan' => 'Mengajarkan teknik pernafasan untuk meningkatkan relaksasi, meredakan nyeri, dan ketidaknyamanan.',
                'url_youtube' => null
            ],
            [
                'value' => 'Kompres Dingin',
                'keterangan' => 'Melakukan stimulasi kulit dan jaringan dengan dingin untuk mengurangi nyeri, peradangan dan mendapatkan efek terapeutik lainnya melalui paparan dingin',
                'url_youtube' => null
            ],
            [
                'value' => 'Terapi pemijatan',
                'keterangan' => 'Memberikan stimulasi kulit dan jaringan dengan berbagai teknik gerakan dan tekanan tangan untuk meredakan nyeri, meningkatkan relaksasi, memperbaiki sirkulasi, dan/ atau stimulasi pertumbuhan dan perkembangan pada bayi dan anak.',
                'url_youtube' => null
            ],
            [
                'value' => 'Terapi Relaksasi Otot Progresif',
                'keterangan' => 'Menggunakan Teknik penegangan dan peregangan otot untuk meredakan ketegangan otot, ansietas, nyeri serta meningkatkan kenyamanan, konsentrasi dan kebugaran.',
                'url_youtube' => 'https://youtu.be/SH2PjUWqKNY'
            ],
            [
                'value' => 'Latihan Pernapasan',
                'keterangan' => 'Latihan menggerakan dinding dada untuk meningkatkan bersihan jalan napas, meningkatkan pengembangan paru, menguatkan otot – otot napas, dan meningkatkan relaksasi atau rasa nyaman',
                'url_youtube' => 'https://youtu.be/W8raYmnrA7Q'
            ],
            [
                'value' => 'Kompres Panas',
                'keterangan' => 'Melakukan stimulasi kulit dan jaringan dengan panas untuk mengurangi nyeri, spasme otot, dan mendapatkan efek terapeutik lainnya melalui paparan panas.',
                'url_youtube' => null
            ],
            [
                'value' => 'Teknik Distraksi',
                'keterangan' => 'Mengalihkan perhatian atau mengurangi emosi dan pikiran negatif terhadap sensasi yang tidak diinginkan',
                'url_youtube' => 'https://youtu.be/i6XgBdEgGGw'
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

            // Edukasi Teknik Napas (I.12452) 15-17
            [
                'id_intervensi' => 5,
                'id_parent' => null,
                'value' => 'Observasi',
            ],
            [
                'id_intervensi' => 5,
                'id_parent' => null,
                'value' => 'Terapeutik',
            ],
            [
                'id_intervensi' => 5,
                'id_parent' => null,
                'value' => 'Edukasi'
            ],

            // Kompres dingin 18-20
            [
                'id_intervensi' => 6,
                'id_parent' => null,
                'value' => 'Observasi',
            ],
            [
                'id_intervensi' => 6,
                'id_parent' => null,
                'value' => 'Terapeutik',
            ],
            [
                'id_intervensi' => 6,
                'id_parent' => null,
                'value' => 'Edukasi'
            ],

            // Intervensi Terapi Pemijatan 21-23
            [
                'id_intervensi' => 7,
                'id_parent' => null,
                'value' => 'Observasi',
            ],
            [
                'id_intervensi' => 7,
                'id_parent' => null,
                'value' => 'Terapeutik',
            ],
            [
                'id_intervensi' => 7,
                'id_parent' => null,
                'value' => 'Edukasi'
            ],

            // Terapi Relaksasi Otot Progresif 24-26
            [
                'id_intervensi' => 8,
                'id_parent' => null,
                'value' => 'Observasi',
            ],
            [
                'id_intervensi' => 8,
                'id_parent' => null,
                'value' => 'Terapeutik',
            ],
            [
                'id_intervensi' => 8,
                'id_parent' => null,
                'value' => 'Edukasi'
            ],

            // Latihan Pernapasan 27-29
            [
                'id_intervensi' => 9,
                'id_parent' => null,
                'value' => 'Observasi',
            ],
            [
                'id_intervensi' => 9,
                'id_parent' => null,
                'value' => 'Terapeutik',
            ],
            [
                'id_intervensi' => 9,
                'id_parent' => null,
                'value' => 'Edukasi'
            ],

            // Kompres Panas 30-32
            [
                'id_intervensi' => 10,
                'id_parent' => null,
                'value' => 'Observasi',
            ],
            [
                'id_intervensi' => 10,
                'id_parent' => null,
                'value' => 'Terapeutik',
            ],
            [
                'id_intervensi' => 10,
                'id_parent' => null,
                'value' => 'Edukasi'
            ],

            // Teknik Distraksi 33-35
            [
                'id_intervensi' => 11,
                'id_parent' => null,
                'value' => 'Observasi',
            ],
            [
                'id_intervensi' => 11,
                'id_parent' => null,
                'value' => 'Terapeutik',
            ],
            [
                'id_intervensi' => 11,
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

            // Id parent 15-17
            // Id intervensi 5 Edukasi Teknik Napas

            // Observasi
            [
                'id_intervensi' => 5,
                'id_parent' => 15,
                'value' => 'Identifikasi kesiapan dan kemampuan menerima informasi.'
            ],

            // Terapeutik
            [
                'id_intervensi' => 5,
                'id_parent' => 16,
                'value' => 'Sediakan materi dan media pendidikan kesehatan'
            ],
            [
                'id_intervensi' => 5,
                'id_parent' => 16,
                'value' => 'Jadwalkan pendidikan kesehatan sesuai kesepakatan'
            ],
            [
                'id_intervensi' => 5,
                'id_parent' => 16,
                'value' => 'Berikan kesempatan untuk berkarya.'
            ],
            
            // Edukasi
            [
                'id_intervensi' => 5,
                'id_parent' => 17,
                'value' => 'Jelaskan tujuan dan manfaat teknik nafas'
            ],
            [
                'id_intervensi' => 5,
                'id_parent' => 17,
                'value' => 'Jelaskan prosedur tarik nafas'
            ],
            [
                'id_intervensi' => 5,
                'id_parent' => 17,
                'value' => 'Anjurkan memposisikan tubuh senyaman mungkin (mis : duduk, baring)'
            ],
            [
                'id_intervensi' => 5,
                'id_parent' => 17,
                'value' => 'Anjurkan menutup mata dan berkonsentrasi penuh'
            ],
            [
                'id_intervensi' => 5,
                'id_parent' => 17,
                'value' => 'Anjurkan melakukan inspirasi dengan menghirup udara melalui hidung secara perlahan'
            ],
            [
                'id_intervensi' => 5,
                'id_parent' => 17,
                'value' => 'Anjurkan melakukan ekspirasi dengan menghembuskan udara mulut mencucu secara perlahan'
            ],
            [
                'id_intervensi' => 5,
                'id_parent' => 17,
                'value' => 'Demonstrasikan menarik nafas selama 4 detik, menahan nafas selama 2 detik, dan menghembuskan nafas selama 8 detik.'
            ],

            // Id parent 18-20
            // Id intervensi 6 Kompres dingin

            // Observasi
            [
                'id_intervensi' => 6,
                'id_parent' => 18,
                'value' => 'Identifikasi kontraindikasi kompres dingin (misal penurunan sensasi, penurunan sirkulasi)'
            ],
            [
                'id_intervensi' => 6,
                'id_parent' => 18,
                'value' => 'Identifikasi kondisi kulit yang akan dilakukan kompres dingin'
            ],
            [
                'id_intervensi' => 6,
                'id_parent' => 18,
                'value' => 'Periksa suhu alat kompres'
            ],
            [
                'id_intervensi' => 6,
                'id_parent' => 18,
                'value' => 'Monitor iritasi kulit atau kerusakan jaringan selama 5 menit pertama'
            ],
            
            // Terapeutik
            [
                'id_intervensi' => 6,
                'id_parent' => 19,
                'value' => 'Pilih metode kompres yang nyaman dan mudah didapat (missal kantong plastic tahan air, kemasan gel beku, kain atau handuk)'
            ],
            [
                'id_intervensi' => 6,
                'id_parent' => 19,
                'value' => 'Pilih lokasi kompres'
            ],
            [
                'id_intervensi' => 6,
                'id_parent' => 19,
                'value' => 'Balut alat kompres dingin dengan kain pelindung, jika perlu'
            ],
            [
                'id_intervensi' => 6,
                'id_parent' => 19,
                'value' => 'Lakukan kompres dingin pada daerah yang cedera'
            ],
            [
                'id_intervensi' => 6,
                'id_parent' => 19,
                'value' => 'Hindari penggunaan kompres pada jaringan yang terpapar terapi radiasi'
            ],
            
            // Edukasi
            [
                'id_intervensi' => 6,
                'id_parent' => 20,
                'value' => 'Jelaskan prosedur penggunaan kompres dingin'
            ],
            [
                'id_intervensi' => 6,
                'id_parent' => 20,
                'value' => 'Anjurkan tidak menyesuaikan pengaturan suhu secara mandiri tanpa pemberitahuan sebelumnya'
            ],
            [
                'id_intervensi' => 6,
                'id_parent' => 20,
                'value' => 'Anjurkan cara menghindari kerusakan jaringan akibat dingin'
            ],

            // Id parent 21-23
            // Id intervensi 7 Intervensi Terapi Pemijatan

            // Observasi
            [
                'id_intervensi' => 7,
                'id_parent' => 21,
                'value' => 'Identifikasi kontraindikasi terapi pemijatan (mis. penurunan trombosit, gangguan integritas kulit, deep vein thrombosis, area lesi. kemerahan atau radang, tumor, dan hipersensitivitas terhadap sentuhan.'
            ],
            [
                'id_intervensi' => 7,
                'id_parent' => 21,
                'value' => 'Identifikasi kesediaan dan penerimaan dilakukan pemijatan'
            ],
            [
                'id_intervensi' => 7,
                'id_parent' => 21,
                'value' => 'Monitor respons terhadap pemijatan '
            ],

            // Terapeutik
            [
                'id_intervensi' => 7,
                'id_parent' => 22,
                'value' => 'Tetapkan jangka waktu untuk pemijatan'
            ],
            [
                'id_intervensi' => 7,
                'id_parent' => 22,
                'value' => 'Pilih area tubun yang akan dipijat'
            ],
            [
                'id_intervensi' => 7,
                'id_parent' => 22,
                'value' => 'Cucl tangan dengan air hangatSiapkan lingkungan yang hangat, nyaman, dan privasi'
            ],
            [
                'id_intervensi' => 7,
                'id_parent' => 22,
                'value' => 'Buka area yang akan dipijat, sesuai kebutuhan'
            ],
            [
                'id_intervensi' => 7,
                'id_parent' => 22,
                'value' => 'Tutup area vang tidak terpajan (mis. dengan selimut, seprai, handuk mandi)'
            ],
            [
                'id_intervensi' => 7,
                'id_parent' => 22,
                'value' => 'Gunakan lotion atau minyak untuk mengurangi gesekan (perhatikan kontraindikasi penggunaan Iction atau minyak tertentu pada tiap individu)'
            ],
            [
                'id_intervensi' => 7,
                'id_parent' => 22,
                'value' => 'Lakukan pemijatan secara perlahan'
            ],
            [
                'id_intervensi' => 7,
                'id_parent' => 22,
                'value' => 'Lakukan pemijatan dengan teknik yang tepat'
            ],
            
            // Edukasi
            [
                'id_intervensi' => 7,
                'id_parent' => 23,
                'value' => 'Jelaskan tujuan dan prosedur terapi'
            ],
            [
                'id_intervensi' => 7,
                'id_parent' => 23,
                'value' => 'Anjurkan rileks selama pemijatan'
            ],
            [
                'id_intervensi' => 7,
                'id_parent' => 23,
                'value' => 'Anjurkan beristirahat setelah dilakukan pemijatan'
            ],

            // Id parent 24-26
            // Id intervensi 8 Terapi Relaksasi Otot Progresif

            // Observasi
            [
                'id_intervensi' => 8,
                'id_parent' => 24,
                'value' => 'Identifikasi tempat yang tenang dan nyaman'
            ],
            [
                'id_intervensi' => 8,
                'id_parent' => 24,
                'value' => 'Monitor secara berkala untuk memastikan otot rileks'
            ],
            [
                'id_intervensi' => 8,
                'id_parent' => 24,
                'value' => 'Monitor adanya indikator tidak rileks (mis. Adanya Gerakan, pernapasan yang berat)'
            ],
            
            // Terapeutik
            [
                'id_intervensi' => 8,
                'id_parent' => 25,
                'value' => 'Atur lingkungan agar tidak ada gangguan saat terapi'
            ],
            [
                'id_intervensi' => 8,
                'id_parent' => 25,
                'value' => 'Berikan posisi bersandar pada kursi atau posisi lainnya yang nyaman'
            ],
            [
                'id_intervensi' => 8,
                'id_parent' => 25,
                'value' => 'Hentikan sesi relaksasi secara bertahap'
            ],
            [
                'id_intervensi' => 8,
                'id_parent' => 25,
                'value' => 'Beri waktu mengungkapkan perasaan tentang terapi'
            ],
            
            // Edukasi
            [
                'id_intervensi' => 8,
                'id_parent' => 26,
                'value' => 'Anjurkan memakai pakaian yang nyaman dan tidak sempit'
            ],
            [
                'id_intervensi' => 8,
                'id_parent' => 26,
                'value' => 'Anjurkan   melakukan relaksasi otot rahang'
            ],
            [
                'id_intervensi' => 8,
                'id_parent' => 26,
                'value' => 'Anjurkan menegangkan otot selama 5 sampai 10 detik, kemudian anjurkan untuk merilekskan otot 20-30 detik, masing-masing 8 sampai 16 kali'
            ],
            [
                'id_intervensi' => 8,
                'id_parent' => 26,
                'value' => 'Anjurkan menegangkan otot kaki selama tidak lebih dari 5 detik untuk menghindari kram'
            ],
            [
                'id_intervensi' => 8,
                'id_parent' => 26,
                'value' => 'Anjurkan focus pada sensasi otot yang menegang'
            ],
            [
                'id_intervensi' => 8,
                'id_parent' => 26,
                'value' => 'Anjurkan focus pada sensasi otot yang relaks'
            ],
            [
                'id_intervensi' => 8,
                'id_parent' => 26,
                'value' => 'Anjurkan bernafas dalam dan perlahan'
            ],
            [
                'id_intervensi' => 8,
                'id_parent' => 26,
                'value' => 'Anjurkan berlatih di antara sesi reguler dengan perawat'
            ],

            // Id parent 27-29
            // Id intervensi 9 Latihan Pernapasan

            // Observasi
            [
                'id_intervensi' => 9,
                'id_parent' => 27,
                'value' => 'Identifikasi indikasi dilakukan latihan pernapasan '
            ],
            [
                'id_intervensi' => 9,
                'id_parent' => 27,
                'value' => 'Monitor frekuensi, irama, dan kedalaman napas sebelum dan sesudah latihan.'
            ],
            
            // Terapeutik
            [
                'id_intervensi' => 9,
                'id_parent' => 28,
                'value' => 'Sediakan tempat yang tenang'
            ],
            [
                'id_intervensi' => 9,
                'id_parent' => 28,
                'value' => 'Posisikan pasien nyaman dan rileks'
            ],
            [
                'id_intervensi' => 9,
                'id_parent' => 28,
                'value' => 'Tempatkan satu tangan di dada dan satu tangan di perut'
            ],
            [
                'id_intervensi' => 9,
                'id_parent' => 28,
                'value' => 'Pastikan tangan di dada mundur ke belakang dan telapak tangan diperut maju ke depan saat menarik napas'
            ],
            [
                'id_intervensi' => 9,
                'id_parent' => 28,
                'value' => 'Ambil napas dalam secara perlahan melalui hidung dan tahan selama tujuh hitungan'
            ],
            [
                'id_intervensi' => 9,
                'id_parent' => 28,
                'value' => 'Hitungan ke delapan hembuskan napas melalui mulut dengan perlahan.'
            ],
            
            // Edukasi
            [
                'id_intervensi' => 9,
                'id_parent' => 29,
                'value' => 'Jelaskan tujuan dan prosdur latihan pernapasan'
            ],
            [
                'id_intervensi' => 9,
                'id_parent' => 29,
                'value' => 'Anjurkan mengulangi latihan 4 – 5 kali'
            ],

            // Id parent 30-32
            // Id intervensi 10 Kompres Panas

            // Observasi
            [
                'id_intervensi' => 10,
                'id_parent' => 30,
                'value' => 'Identifikasi kontraindikasi kompres panas (mis. Penurunan sensasi, penurunana sirkulasi)'
            ],
            [
                'id_intervensi' => 10,
                'id_parent' => 30,
                'value' => 'Identifikasi kondisi kulit yang akan dilakukan kompres panas '
            ],
            [
                'id_intervensi' => 10,
                'id_parent' => 30,
                'value' => 'Periksa suhu alat kompres'
            ],
            [
                'id_intervensi' => 10,
                'id_parent' => 30,
                'value' => 'Monitor iritasi kulit atau kerusakan jaringan selama 5 menit pertama'
            ],
            
            // Terapeutik
            [
                'id_intervensi' => 10,
                'id_parent' => 31,
                'value' => 'Pilih metode kompres yang nyaman dan mudah didapatkan (mis. Kantong plastik tahan air, botol air panas, bantalan pemanas listrik)'
            ],
            [
                'id_intervensi' => 10,
                'id_parent' => 31,
                'value' => 'Pilih lokasi kompres'
            ],
            [
                'id_intervensi' => 10,
                'id_parent' => 31,
                'value' => 'Balut alat kompres panas dengan kain pelindung, jika perlu'
            ],
            [
                'id_intervensi' => 10,
                'id_parent' => 31,
                'value' => 'Lakukan kompres panas pada daerah yang cedera'
            ],
            [
                'id_intervensi' => 10,
                'id_parent' => 31,
                'value' => 'Hindari penggunaan kompres pada jaringan yang terpapar terapi radiasi'
            ],
            
            // Edukasi
            [
                'id_intervensi' => 10,
                'id_parent' => 32,
                'value' => 'Jelaskan prosedur penggunaan kompres panas'
            ],
            [
                'id_intervensi' => 10,
                'id_parent' => 32,
                'value' => 'Anjurkan tidak menyesuaikan pengaturan suhu secara mandiri tanpa pemberitahuan sebelumnya'
            ],
            [
                'id_intervensi' => 10,
                'id_parent' => 32,
                'value' => 'Ajarkan cara menghindari kerusakan jaringan akibat panas '
            ],

            // Id parent 33-35
            // Id intervensi 11 Teknik Distraksi

            // Observasi
            [
                'id_intervensi' => 11,
                'id_parent' => 33,
                'value' => 'Identifiaksi pilihan Teknik distraksi yang diinginkan'
            ],
            
            // Terapeutik
            [
                'id_intervensi' => 11,
                'id_parent' => 34,
                'value' => 'Gunakan Teknik distraksi (mis. Membaca buku, menonton televisi, bermain, aktivitas terapi, membaca cerita, bernyanyi)'
            ],
            
            // Edukasi
            [
                'id_intervensi' => 11,
                'id_parent' => 35,
                'value' => 'Jelaskan manfaat dan jenis distraksi bagi pancaindera (mis. musik, penghitungan, televisi, baca, video/permainan genggam)'
            ],
            [
                'id_intervensi' => 11,
                'id_parent' => 35,
                'value' => 'Anjurkan menggunakan Teknik sesuai dengan tingkat energi, kemampuan, usia, tingkat perkembangan'
            ],
            [
                'id_intervensi' => 11,
                'id_parent' => 35,
                'value' => 'Anjurkan membuat daftar aktivitas yang menyenangkan'
            ],
            [
                'id_intervensi' => 11,
                'id_parent' => 35,
                'value' => 'Anjurkan berlatih Teknik distraksi'
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
