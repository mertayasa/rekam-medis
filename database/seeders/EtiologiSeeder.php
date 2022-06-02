<?php

namespace Database\Seeders;

use App\Models\Etiologi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class EtiologiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $etiologi = [
            [
                'value' => 'Agen pencedera fisiologis (misalnya inflamasi, iskemia, neoplasma)'
            ],
            [
                'value' => 'Agen pencedera kimiawi (misalnya terbakar, bahan kimia iritan)'
            ],
            [
                'value' => 'Agen pencedera fisik (misalnya abses, amputasi, terbakar, terpotong, mengangkat berat, prosedur operasi, trauma, latihan fisik berlebihan '
            ],
            [
                'value' => 'Kondisi muskuloskeletal'
            ],
            [
                'value' => 'Kerusakan sistem saraf'
            ],
            [
                'value' => 'Penekanan saraf'
            ],
            [
                'value' => 'Infiltrasi tumor'
            ],
            [
                'value' => 'Ketidakseimbangan neurotransmiter, neuromodulator, dan reseptor '
            ],
            [
                'value' => 'Gangguan imunitas (misalnya neuropati terkait HIV, virus varicella-zoster) '
            ],
            [
                'value' => 'Gangguan fungsi metabolik'
            ],
            [
                'value' => 'Riwayat posisi kerja statis '
            ],
            [
                'value' => 'Peningkatan indeks massa tubuh '
            ],
            [
                'value' => 'Kondisi pasca trauma '
            ],
            [
                'value' => 'Tekanan emosional '
            ],
            [
                'value' => 'Riwayat penganiayaan (misalnya fisik, psikologis, seksual)'
            ],
            [
                'value' => 'Riwayat penyalahgunaan obat/zat'
            ],
        ];

        Schema::disableForeignKeyConstraints();
        Etiologi::query()->truncate();

        Etiologi::insert($etiologi);
    }
}
