<?php

namespace Database\Seeders;

use App\Models\Intervensi;
use App\Models\OpsiIntervensi;
use App\Models\UrlYtIntervensi;
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
        UrlYtIntervensi::query()->truncate();
        Intervensi::query()->truncate();
        $intervensi = [
            // Bukan Intervensi Utama
            // Kompress dingin : 1
            [
                'value' => 'Kompres Dingin',
                'keterangan' => 'Melakukan stimulasi kulit dan jaringan dengan dingin untuk mengurangi nyeri, peradangan dan mendapatkan efek terapeutik lainnya melalui paparan dingin. Kompres dingin bisa digunakan untuk cedera akut yang terjadi dalam 24-48 jam setelah cedera. ',
                'is_main' => false,
                'id_parent' => 9,
                'url_yt' => [
                    [
                        'value' => 'https://youtu.be/RRGVdaCv31M'
                    ]
                ],
                'opsi' => [
                    [
                        'value' => 'Observasi',
                        'child' => [
                            [
                                'value' => 'Identifikasi kontraindikasi kompres dingin (misal penurunan sensasi, penurunan sirkulasi)'
                            ],
                            [
                                'value' => 'Identifikasi kondisi kulit yang akan dilakukan kompres dingin'
                            ],
                            [
                                'value' => 'Periksa suhu alat kompres'
                            ],
                            [
                                'value' => 'Monitor iritasi kulit atau kerusakan jaringan selama 5 menit pertama'
                            ],
                        ]
                    ],
                    [
                        'value' => 'Terapeutik',
                        'child' => [
                            [
                                'value' => 'Pilih metode kompres yang nyaman dan mudah didapat (missal kantong plastic tahan air, kemasan gel beku, kain atau handuk)'
                            ],
                            [
                                'value' => 'Pilih lokasi kompres'
                            ],
                            [
                                'value' => 'Balut alat kompres dingin dengan kain pelindung, jika perlu'
                            ],
                            [
                                'value' => 'Lakukan kompres dingin pada daerah yang cedera'
                            ],
                            [
                                'value' => 'Hindari penggunaan kompres pada jaringan yang terpapar terapi radiasi'
                            ],
                        ]
                    ],
                    [
                        'value' => 'Edukasi',
                        'child' => [
                            [
                                'value' => 'Jelaskan prosedur penggunaan kompres dingin'
                            ],
                            [
                                'value' => 'Anjurkan tidak menyesuaikan pengaturan suhu secara mandiri tanpa pemberitahuan sebelumnya'
                            ],
                            [
                                'value' => 'Anjurkan cara menghindari kerusakan jaringan akibat dingin'
                            ],
                        ]
                    ]
                ]
            ],

            // Kompres panas : 2
            [
                'value' => 'Kompres Panas',
                'keterangan' => 'Melakukan stimulasi kulit dan jaringan dengan panas untuk mengurangi nyeri, spasme otot, dan mendapatkan efek terapeutik lainnya melalui paparan panas selama ± 2 menit.',
                'is_main' => false,
                'id_parent' => 9,
                'opsi' => [
                    [
                        'value' => 'Observasi',
                        'child' => [
                            [
                                'value' => 'Identifikasi kontraindikasi kompres panas (mis. Penurunan sensasi, penurunana sirkulasi)'
                            ],
                            [
                                'value' => 'Identifikasi kondisi kulit yang akan dilakukan kompres panas '
                            ],
                            [
                                'value' => 'Periksa suhu alat kompres'
                            ],
                            [
                                'value' => 'Monitor iritasi kulit atau kerusakan jaringan selama 5 menit pertama'
                            ],
                        ]
                    ],
                    [
                        'value' => 'Terapeutik',
                        'child' => [
                            [
                                'value' => 'Pilih metode kompres yang nyaman dan mudah didapatkan (mis. Kantong plastik tahan air, botol air panas, bantalan pemanas listrik)'
                            ],
                            [
                                'value' => 'Pilih lokasi kompres'
                            ],
                            [
                                'value' => 'Balut alat kompres panas dengan kain pelindung (jika perlu)'
                            ],
                            [
                                'value' => 'Lakukan kompres panas pada daerah yang cedera'
                            ],
                            [
                                'value' => 'Hindari penggunaan kompres pada jaringan yang terpapar terapi radiasi'
                            ],
                        ],
                    ],
                    [
                        'value' => 'Edukasi',
                        'child' => [
                            [
                                'value' => 'Jelaskan prosedur penggunaan kompres panas'
                            ],
                            [
                                'value' => 'Anjurkan tidak menyesuaikan pengaturan suhu secara mandiri tanpa pemberitahuan sebelumnya'
                            ],
                            [
                                'value' => 'Ajarkan cara menghindari kerusakan jaringan akibat panas'
                            ],
                        ]
                    ]
                ]
            ],

            // Teknik Disrtraksi : 3
            [
                'value' => 'Teknik Distraksi',
                'keterangan' => 'Mengalihkan perhatian atau mengurangi emosi dan pikiran negatif terhadap sensasi yang tidak diinginkan',
                'is_main' => false,
                'id_parent' => 9,
                'url_yt' => [
                    [
                        'value' => 'https://youtu.be/OgbGCmbqCtU'
                    ],
                    [
                        'value' => 'https://youtu.be/GRYn9Ub2BLM'
                    ],
                    [
                        'value' => 'https://youtu.be/T6RgtIV8aQ0'
                    ],
                ],
                'opsi' => [
                    [
                        'value' => 'Observasi',
                        'child' => [
                            [
                                'value' => 'Identifiaksi pilihan Teknik distraksi yang diinginkan'
                            ],
                        ]
                    ],
                    [
                        'value' => 'Terapeutik',
                        'child' => [
                            [
                                'value' => 'Gunakan Teknik distraksi (mis. Membaca buku, menonton televisi, bermain, aktivitas terapi, membaca cerita, bernyanyi)'
                            ],
                            [
                                'value' => 'Anjurkan menggunakan Teknik sesuai dengan tingkat energi, kemampuan, usia, tingkat perkembangan'
                            ],
                            [
                                'value' => 'Anjurkan membuat daftar aktivitas yang menyenangkan'
                            ],
                            [
                                'value' => 'Anjurkan berlatih Teknik distraksi'
                            ]
                        ]
                    ]
                ]
            ],

            // Terapi Relaksasi Otot Progresif : 4
            [
                'value' => 'Terapi Relaksasi Otot Progresif',
                'keterangan' => 'Menggunakan Teknik penegangan dan peregangan otot untuk meredakan ketegangan otot, ansietas, nyeri serta meningkatkan kenyamanan, konsentrasi dan kebugaran.',
                'is_main' => false,
                'id_parent' => 9,
                'url_yt' => [
                    [
                        'value' => 'https://youtu.be/BdBFEV9dN6U'
                    ]
                ],
                'opsi' => [
                    [
                        'value' => 'Observasi',
                        'child' => [
                            [
                                'value' => 'Identifikasi tempat yang tenang dan nyaman'
                            ],
                            [
                                'value' => 'Monitor secara berkala untuk memastikan otot rileks'
                            ],
                            [
                                'value' => 'Monitor adanya indikator tidak rileks (mis. Adanya Gerakan, pernapasan yang berat)'
                            ],
                        ]
                    ],
                    [
                        'value' => 'Terapeutik',
                        'child' => [
                            [
                                'value' => 'Atur lingkungan agar tidak ada gangguan saat terapi'
                            ],
                            [
                                'value' => 'Berikan posisi bersandar pada kursi atau posisi lainnya yang nyaman'
                            ],
                            [
                                'value' => 'Hentikan sesi relaksasi secara bertahap'
                            ],
                            [
                                'value' => 'Beri waktu mengungkapkan perasaan tentang terapi'
                            ],
                        ]
                    ],
                    [
                        'value' => 'Edukasi',
                        'child' => [
                            [
                                'value' => 'Anjurkan memakai pakaian yang nyaman dan tidak sempit'
                            ],
                            [
                                'value' => 'Anjurkan   melakukan relaksasi otot rahang'
                            ],
                            [
                                'value' => 'Anjurkan menegangkan otot selama 5 sampai 10 detik, kemudian anjurkan untuk merilekskan otot 20-30 detik, masing-masing 8 sampai 16 kali'
                            ],
                            [
                                'value' => 'Anjurkan menegangkan otot kaki selama tidak lebih dari 5 detik untuk menghindari kram'
                            ],
                            [
                                'value' => 'Anjurkan focus pada sensasi otot yang menegang'
                            ],
                            [
                                'value' => 'Anjurkan focus pada sensasi otot yang relaks'
                            ],
                            [
                                'value' => 'Anjurkan bernafas dalam dan perlahan'
                            ],
                            [
                                'value' => 'Anjurkan berlatih di antara sesi reguler dengan perawat'
                            ],
                        ]
                    ]
                ]
            ],

            // Latihan Relaksasi Napas Dalam : 5
            [
                'value' => 'Latihan Relaksasi Napas Dalam',
                'keterangan' => 'Latihan menggerakan dinding dada untuk meningkatkan bersihan jalan napas, meningkatkan pengembangan paru, menguatkan otot – otot napas, dan meningkatkan relaksasi atau rasa nyaman',
                'is_main' => false,
                'id_parent' => 9,
                'url_yt' => [
                    [
                        'value' => 'https://youtu.be/Vs6rTwMsJGk'
                    ]
                ],
                'opsi' => [
                    [
                        'value' => 'Observasi',
                        'child' => [
                            [
                                'value' => 'Identifikasi indikasi dilakukan latihan pernapasan '
                            ],
                            [
                                'value' => 'Monitor frekuensi, irama, dan kedalaman napas sebelum dan sesudah latihan.'
                            ],
                        ]
                    ],
                    [
                        'value' => 'Terapeutik',
                        'child' => [
                            [
                                'value' => 'Sediakan tempat yang tenang',
                            ],
                            [
                                'value' => 'Posisikan pasien nyaman dan rileks',
                            ],
                            [
                                'value' => 'Tempatkan satu tangan di dada dan satu tangan di perut',
                            ],
                            [
                                'value' => 'Pastikan tangan di dada mundur ke belakang dan telapak tangan diperut maju ke depan saat menarik napas',
                            ],
                            [
                                'value' => 'Ambil napas dalam secara perlahan melalui hidung dan tahan selama tujuh hitungan',
                            ],
                            [
                                'value' => 'Hitungan ke delapan hembuskan napas melalui mulut dengan perlahan.',
                            ],
                        ]
                    ],
                    [
                        'value' => 'Edukasi',
                        'child' => [
                            [
                                'value' => 'Jelaskan tujuan dan prosdur latihan pernapasan'
                            ],
                            [
                                'value' => 'Anjurkan mengulangi latihan 4 – 5 kali.'
                            ]
                        ]
                    ]
                ]
            ],

            // Terapi Musik : 6
            [
                'value' => 'Terapi Musik',
                'keterangan' => 'Menggunakan musik untuk membantu mengubah perilaku, perasaan atau fisiologis tubuh',
                'is_main' => false,
                'id_parent' => 9,
                'url_yt' => [
                    [
                        'value' => 'https://youtu.be/OgbGCmbqCtU'
                    ],
                    [
                        'value' => 'https://youtu.be/GRYn9Ub2BLM'
                    ],
                    [
                        'value' => 'https://youtu.be/T6RgtIV8aQ0'
                    ],
                ],
                'opsi' => [
                    [
                        'value' => 'Observasi',
                        'child' => [
                            [
                                'value' => 'Identifikasi perubahan fisiologis yang akan dicapai (mis, relaksasi, stimulasi, konsentrasi, pengurangan rasa sakit)'
                            ],
                            [
                                'value' => 'Identifikasi minat terhadap musik'
                            ],
                            [
                                'value' => 'Identifikasi musik yang di sukai '
                            ]
                        ]
                    ],
                    [
                        'value' => 'Terapeutik',
                        'child' => [
                            [
                                'value' => 'Pilih musik yang disukai'
                            ],
                            [
                                'value' => 'Posisikan dalam posisi yang nyaman'
                            ],
                            [
                                'value' => 'Batasi ransangan eksternal selama terapi dilakukan (mis, lampu, suara, pengunjung)'
                            ],
                            [
                                'value' => 'Sediakan peralatan terapi musik'
                            ],
                            [
                                'value' => 'Berikan terapi musik sesuai indikasi'
                            ],
                            [
                                'value' => 'Hindari pemberian terapi musik dalam waktu yang lama '
                            ],
                            [
                                'value' => 'Hindari pemberian terapi musik saat cedera kepala akut'
                            ]
                        ]
                    ],
                    [
                        'value' => 'Edukasi',
                        'child' => [
                            [
                                'value' => 'Jelaskan tujuan dan prosedur terapi musik'
                            ],
                            [
                                'value' => 'Anjurkan rikes selama mendengarkan musik '
                            ]
                        ]
                    ]
                ]
            ],

            // Intervensi Utama
            [
                'value' => 'Pemberian Analgesik',
                'keterangan' => 'Menyiapkan dan memberikan agen farmakologis untuuk menhurangi atau menghilangkan rasa sakit',
                'is_main' => true,
                'opsi' => [
                        [

                            'value' => 'Observasi',
                            'child' => [
                                [
                                    'value' => 'Identifikasi karakteristik nyeri (misalnya pencetus, pereda, kualitas, lokasi, intensitas, frekuensi dan durasi)'
                                ],
                                [
                                    'value' => 'Identifikasi riwayat alergi obat'
                                ],
                                [
                                    'value' => 'Identifikasi kesesuaian jenis analgesik (misalnya narkotika, non-narkotik atau NSAIO) dengan tingkat keparahan nyeri'
                                ],
                                [
                                    'value' => 'Monitor tanda-tanda vital sebelum dan sesudah pemberian analgesik'
                                ],
                                [
                                    'value' => 'Monitor efektifitas analgesik'
                                ],
                            ]
                        ],
                        [

                            'value' => 'Terapeutik',
                            'child' => [
                                    [
                                        'value' => 'Diskusikan jenis analgesik yang disukai untuk mencapai analgesia optimal, jika perlu'
                                    ],
                                    [
                                        'value' => 'Pertimbangkan penggunaan infus kontinyu atau bolus opioid untuk mempertahankan kadar dalam serum'
                                    ],
                                    [
                                        'value' => 'Tetapkan target efektifitas analgesik untuk mengoptimalkan respons pasien'
                                    ],
                                    [
                                        'value' => 'Dokumentasikan respons terhadap efek analgesik dan efek yang tidak diinginkan '
                                    ],
                            ]
                        ],
                        [

                            'value' => 'Edukasi',
                            'child' => [
                                [
                                    'value' => 'Jelaskan efek terapi dan efek samping obat'
                                ]
                            ]
                        ],
                        [

                            'value' => 'Kolaborasi',
                            'child' => [
                                [
                                    'value' => 'Kolaborasi pemberian dosis dan jenis analgesik, jika perlu'
                                ]
                            ]
                        ]
                ]
            ],
            [
                'value' => 'Pemantauan Nyeri',
                'keterangan' => 'Mengumpulkan dan menganalisis data nyeri',
                'is_main' => true,
                'opsi' => [
                    [
                        'value' => 'Observasi',
                        'child' => [
                            [
                                'value' => 'Identifikasi faktor pencetus dan pereda nyeri'
                            ],
                            [
                                'value' => 'Monitor kualitas nyeri (mis. terasa tajam, tumpul, diremas-remas, ditimpa beban berat)'
                            ],
                            [
                                'value' => 'Monitor lokasi dan penyebaran nyeri'
                            ],
                            [
                                'value' => 'Monitor intensitas nyeri dengan menggunakan skala'
                            ],
                            [
                                'value' => 'Monitor durasi dan frekuensi nyeri'
                            ],
                        ]
                    ],
                    [
                        'value' => 'Terapeutik',
                        'child' => [
                            [
                                'value' => 'Atur interval waktu pemantauan sesuai dengan kondisi pasien'
                            ],
                            [
                                'value' => 'Dokumentasikan hasil pemantauan'
                            ],
                        ]
                    ],
                    [
                        'value' => 'Edukasi',
                        'child' => [
                            [
                                'value' => 'Jelaskan tujuan dan prosedur pemantauan'
                            ],
                            [
                                'value' => 'Informasikan hasil pemantauan, jika peru'
                            ],
                        ]
                    ],
                ]
            ],
            [
                'value' => 'Perawatan Kenyamanan',
                'keterangan' => 'Mengidentifikasi dan merawat pasien untuk meningkatkan rasa nyaman.',
                'is_main' => true,
                'opsi' => [
                    [
                        'value' => 'Observasi',
                        'child' => [
                            [
                                'value' => 'Identifikasi gejala yang tidak menyenangkan (mis. mual, nyeri, gatal, sesak)'
                            ],
                            [
                                'value' => 'Identifikasi pemahaman tentang kondisi, situasi dan perasaannya'
                            ],
                            [
                                'value' => 'Identifikasi masala emosional dan spiritual'
                            ],
                        ]
                    ],
                    [
                        'value' => 'Terapeutik',
                        'child' => [
                            [
                                'value' => 'Berikan posisi yang nyaman'
                            ],
                            [
                                'value' => 'Ciptakan lingkungan yang nyaman'
                            ],
                            [
                                'value' => 'Berikan kompres hangat',
                                'sub_intervensi_id' => 2
                            ],
                            [
                                'value' => 'Berikan kompres dingin',
                                'sub_intervensi_id' => 1
                            ],
                            [
                                'value' => 'Berikan intervensi terapi musik',
                                'sub_intervensi_id' => 6
                            ],
                            [
                                'value' => 'Dukung keluarga dan pengasuh terlibat dalam terapi/pengobatan'
                            ],
                            [
                                'value' => 'Diskusikan mengenai situasi dan pilihan terapi/pengobatan yang dinginkan'
                            ],
                        ]
                    ],
                    [
                        'value' => 'Edukasi',
                        'child' => [
                            [
                                'value' => 'Jelaskan mengenai kondisi dan pilihan terapi/pengobatan'
                            ],
                            [
                                'value' => 'Ajarkan terapi relaksasi otot progresif',
                                'sub_intervensi_id' => 4
                            ],
                            [
                                'value' => 'Ajarkan latihan relaksasi napas dalam',
                                'sub_intervensi_id' => 5
                            ],
                            [
                                'value' => 'Ajarkan teknik distraksi dan imajinasi terbimbing',
                                'sub_intervensi_id' => 3
                            ],
                        ]
                    ],
                    [
                        'value' => 'Kolaborasi',
                        'child' => [
                            [
                                'value' => 'Kolaborasi pemberian analgesik, antipruritus, antihistamin, jika pertu'
                            ]
                        ]
                    ],
                ]
            ],
            [
                'value' => 'Edukasi Manajemen Nyeri',
                'keterangan' => 'Mengajarkan pengelolaan suhu tubuh yang lebih optimal',
                'is_main' => true,
                'opsi' => [
                    [
                        'value' => 'Observasi',
                        'child' => [
                            [
                                'value' => 'Identifikasi kesiapan dan kemampuan menerima informasi'
                            ]
                        ]
                    ],
                    [
                        'value' => 'Terapeutik',
                        'child' => [
                            [
                                'value' => 'Sediakan materi dan media pendidikan kesehatan'
                            ],
                            [
                                'value' => 'Jadwalkan pendidikan kesehatan sesuai kesepakatan'
                            ],
                            [
                                'value' => 'Berikan kesempatan untuk bertanya'
                            ],
                        ]
                    ],
                    [
                        'value' => 'Edukasi',
                        'child' => [
                            [
                                'value' => 'Jelaskan penyebab, periode, dan strategi meredakan nyeri'
                            ],
                            [
                                'value' => 'Anjurkan memonitor nyeri secara mandiri'
                            ],
                            [
                                'value' => 'Anjurkan menggunakan anakgetik secara tepat'
                            ],
                            [
                                'value' => 'Ajarkan teknik nonfarmakologis untuk mengurangi rasa nyeri.'
                            ],
                        ]
                    ],
                ]
            ],
        ];

        // Intervensi::insert($intervensi);

        foreach ($intervensi as $key => $inter) {
            $new_intervensi = Intervensi::create([
                'value' => $inter['value'],
                'keterangan' => $inter['keterangan'],
                'is_main' => $inter['is_main'] ?? false,
                'id_parent' => $inter['id_parent'] ?? null
            ]);

            if(isset($inter['url_yt'])){
                foreach ($inter['url_yt'] as $key => $url) {
                    $new_intervensi->url_yt_intervensi()->create([
                        'url' => $url['value']
                    ]);
                }
            }

            foreach ($inter['opsi'] as $key => $opsi) {
                $new_opsi = OpsiIntervensi::create([
                    'id_intervensi' => $new_intervensi->id,
                    'id_parent' => null,
                    'value' => $opsi['value'],
                ]);

                if (isset($opsi['child'])) {
                    foreach ($opsi['child'] as $key => $child) {
                        OpsiIntervensi::create([
                            'id_intervensi' => $new_intervensi->id,
                            'id_parent' => $new_opsi->id,
                            'value' => $child['value'],
                            'sub_intervensi_id' => $child['sub_intervensi_id'] ?? null,
                        ]);
                    }
                }
            }
        }

    }
}
