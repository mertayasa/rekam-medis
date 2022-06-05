<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Rekam Medis</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <section class="content">
        <div class="col-12 pb-3 pb-md-0">
            <h5><b>Biodata Pasien</b></h5>
        </div>
        <table>
            <tr>
                <td>Nama</td>
                <td width="50" class="text-center">:</td>
                <td>{{ $pasien->nama ?? '-' }}</td>
            </tr>
            <tr>
                <td>No. RM</td>
                <td width="50" class="text-center">:</td>
                <td>{{ $pasien->no_rm ?? '-' }}</td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td width="50" class="text-center">:</td>
                <td>{{ $pasien->jenis_kelamin ?? '-' }}</td>
            </tr>
            <tr>
                <td>Tempat/Tanggal Lahir</td>
                <td width="50" class="text-center">:</td>
                <td>{{ $pasien->tanggal_lahir ?? '-' }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td width="50" class="text-center">:</td>
                <td>{{ $pasien->alamat ?? '-' }}</td>
            </tr>
            <tr>
                <td>No Handphone</td>
                <td width="50" class="text-center">:</td>
                <td>{{ $pasien->no_hp ?? '-' }}</td>
            </tr>
            <tr>
                <td>Tanggal Masuk RS</td>
                <td width="50" class="text-center">:</td>
                <td>{{ $pasien->tanggal_masuk ?? '-' }}</td>
            </tr>
            <tr>
                <td>Tanggal Keluar RS</td>
                <td width="50" class="text-center">:</td>
                <td>{{ $pasien->tanggal_keluar ?? '-' }}</td>
            </tr>
            {{-- <tr>
                <td>Diagnosa Medis</td>
                <td width="50" class="text-center">:</td>
                <td>{{ $pasien->diagnosa_medis ?? '-' }}</td>
            </tr>
            <tr>
                <td>Keluhan Utama</td>
                <td width="50" class="text-center">:</td>
                <td>{{ $pasien->keluhan_utama ?? '-' }}</td>
            </tr> --}}
            <tr>
                <td>Nama Wali</td>
                <td width="50" class="text-center">:</td>
                <td>{{ $pasien->nama_wali ?? '-' }}</td>
            </tr>
            <tr>
                <td>Hubungan Dengan Pasien</td>
                <td width="50" class="text-center">:</td>
                <td>{{ $pasien->hubungan_wali ?? '-' }}</td>
            </tr>
            <tr>
                <td>Kontak Wali</td>
                <td width="50" class="text-center">:</td>
                <td>{{ $pasien->kontak_wali ?? '-' }}</td>
            </tr>
        </table>

        <hr>

        <div class="col-12 pb-3 pb-md-0 mt-4">
            <h5><b>Kajian</b></h5>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-secondary">
                <thead>
                    <tr>
                        <th>Subjek</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Keluhan Utama</td>
                        <td>{{ $rekam_medis['pengkajian']['keluhan_utama'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Pasien Mengeluh Nyeri</td>
                        <td>{{ isset($rekam_medis['pengkajian']['is_mengeluh_nyeri']) && $rekam_medis['pengkajian']['is_mengeluh_nyeri'] == true ? 'Ya' : 'Tidak' }}</td>
                    </tr>
                    <tr>
                        <td>Keluhan Tambahan</td>
                        <td>{{ $rekam_medis['pengkajian']['durasi_nyeri'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Tanda Mayor</td>
                        <td>
                            <ul class="mb-0">
                                @forelse ($rekam_medis['pengkajian']['tanda_mayor'] as $tanda_mayor)
                                        @if ($tanda_mayor->is_checked == true)
                                            <li> {{ $tanda_mayor->value }} </li>
                                        @endif
                                @empty
                                    <li>Tidak Ada Tanda Mayor</li>
                                @endforelse
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td>Tanda Minor</td>
                        <td>
                            <ul class="mb-0">
                                @forelse ($rekam_medis['pengkajian']['tanda_minor'] as $tanda_minor)
                                        @if ($tanda_minor->is_checked == true)
                                            <li> {{ $tanda_minor->value }} </li>
                                        @endif
                                @empty
                                    <li>Tidak Ada Tanda Minor</li>
                                @endforelse
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td width="200">Etiologi</td>
                        <td>
                            <ul class="mb-0">
                                @forelse ($rekam_medis['pengkajian']['etiologi'] as $etiologi)
                                        @if ($etiologi->is_checked == true)
                                            <li> {{ $etiologi->value }} </li>
                                        @endif
                                @empty
                                    <li>Tidak Ada Etiologi</li>
                                @endforelse
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td>Provoking</td>
                        <td>{{ $rekam_medis['pengkajian']['provoking'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Quality</td>
                        <td>{{ $rekam_medis['pengkajian']['quality'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Region</td>
                        <td>{{ $rekam_medis['pengkajian']['region'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Severity</td>
                        <td>{{ $rekam_medis['pengkajian']['severity'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Time</td>
                        <td>{{ $rekam_medis['pengkajian']['time'] ?? '-' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <hr>

        <div class="col-12 pb-3 pb-md-0 mt-4">
            <h5><b>Diagnosa</b></h5>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-secondary">
                <thead>
                    <tr>
                        <th>Subjek</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td width="200">Diagnosa Medis</td>
                        <td>{{ $rekam_medis['diagnosa']['diagnosa'] ?? '-' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="col-12 pb-3 pb-md-0 mt-4">
            <h5><b>Luaran</b></h5>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-secondary">
                <thead>
                    <tr>
                        <th>Subjek</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td width="200">Penyakit</td>
                        <td>{{ $rekam_medis['luaran']['nama_penyakit'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td width="200">Penyakit</td>
                        <td>{{ $rekam_medis['luaran']['nama_penyakit'] ?? '-' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="col-12 pb-3 pb-md-0 mt-4">
            <p>Setelah dilakukan asuhan keperawatan selama {{ $rekam_medis['luaran']['operation_start'] ?? '-' }} x {{ $rekam_medis['luaran']['operation_end'] ?? '-' }} jam maka :</p>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-secondary">
                <thead>
                    <tr>
                        <th>Kemampuan menurunkan aktivitas</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td width="300">Keluhan Nyeri</td>
                        <td>{{ getRangeValue($rekam_medis['luaran']['keluhan_nyeri'] ?? '-') }}</td>
                    </tr>
                    <tr>
                        <td width="300">Meringis</td>
                        <td>{{ getRangeValue($rekam_medis['luaran']['meringis'] ?? '-') }}</td>
                    </tr>
                    <tr>
                        <td width="300">Sikap Protektif</td>
                        <td>{{ getRangeValue($rekam_medis['luaran']['sikap_protektif'] ?? '-') }}</td>
                    </tr>
                    <tr>
                        <td width="300">Gelisah</td>
                        <td>{{ getRangeValue($rekam_medis['luaran']['gelisah'] ?? '-') }}</td>
                    </tr>
                    <tr>
                        <td width="300">Kesulitan Tidur</td>
                        <td>{{ getRangeValue($rekam_medis['luaran']['kesulitan_tidur'] ?? '-') }}</td>
                    </tr>
                    <tr>
                        <td width="300">Diaphores</td>
                        <td>{{ getRangeValue($rekam_medis['luaran']['diaphores'] ?? '-') }}</td>
                    </tr>
                    <tr>
                        <td width="300">Muntah</td>
                        <td>{{ getRangeValue($rekam_medis['luaran']['muntah'] ?? '-') }}</td>
                    </tr>
                    <tr>
                        <td width="300">Mual</td>
                        <td>{{ getRangeValue($rekam_medis['luaran']['mual'] ?? '-') }}</td>
                    </tr>
                    <tr>
                        <td width="300">Frekuensi Nadi</td>
                        <td>{{ getRangeValue($rekam_medis['luaran']['frekuensi_nadi'] ?? '-') }}</td>
                    </tr>
                    <tr>
                        <td width="300">Pola Nafas</td>
                        <td>{{ getRangeValue($rekam_medis['luaran']['pola_nafas'] ?? '-') }}</td>
                    </tr>
                    <tr>
                        <td width="300">Tekanan Darah</td>
                        <td>{{ getRangeValue($rekam_medis['luaran']['tekanan_darah'] ?? '-') }}</td>
                    </tr>
                    <tr>
                        <td width="300">Nafsu Makan</td>
                        <td>{{ getRangeValue($rekam_medis['luaran']['nafsu_makan'] ?? '-') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-secondary">
                <thead>
                    <tr>
                        <th>Indikator</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td width="300">Melaporkan nyeri terkontrol</td>
                        <td>{{ getRangeValue($rekam_medis['luaran']['nyeri_terkontrol'] ?? '-') }}</td>
                    </tr>
                    <tr>
                        <td width="300">Kemampuan mengenali onset nyeri</td>
                        <td>{{ getRangeValue($rekam_medis['luaran']['onset_nyeri'] ?? '-') }}</td>
                    </tr>
                    <tr>
                        <td width="300">Kemampuan mengenali penyebab nyeri</td>
                        <td>{{ getRangeValue($rekam_medis['luaran']['penyebab_nyeri'] ?? '-') }}</td>
                    </tr>
                    <tr>
                        <td width="300">Kemampuan menggunakan teknik non-farmakologis</td>
                        <td>{{ getRangeValue($rekam_medis['luaran']['non_farmakologis'] ?? '-') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="col-12 pb-3 pb-md-0 mt-4">
            <h5><b>Intervensi</b></h5>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-secondary">
                <thead>
                    <tr>
                        <th>Subjek</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($rekam_medis['intervensi'] as $inter)
                        <tr>
                            <td width="300">{{ $inter->value }}</td>
                            <td>
                                @forelse ($inter->opsi_intervensi as $opsi)
                                    @if ($opsi->id_parent == null)
                                        <b>{{ $opsi->value }}</b>
                                        <ul class="mb-0">
                                            @forelse ($opsi->opsi_child as $child)
                                                @if ($child->is_checked == true)
                                                    <li> {{ $child->value }} </li>
                                                @endif
                                            @empty
                                                <li>Tidak Ada Opsi Yang dipilih</li>
                                            @endforelse
                                        </ul>
                                    @endif        
                                @empty
                                    <p>Tidak Ada Opsi Yang Dipilih</p>
                                @endforelse
                            </td>
                        </tr>
                    @empty
                        <td colspan="2">Tidak ada data intervensi</td>
                    @endforelse
                </tbody>
            </table>
        </div>


        <div class="col-12 pb-3 pb-md-0 mt-4">
            <h5><b>Evaluasi</b></h5>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-secondary">
                <thead>
                    <tr>
                        <th>Subjek</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Rasa Nyeri</td>
                        <td>{{ getRasaNyeri($rekam_medis['evaluasi']['rasa_nyeri'] ?? '-') }}</td>
                    </tr>
                    <tr>
                        <td>Keluhan Tambahan</td>
                        <td>{{ $rekam_medis['evaluasi']['durasi_nyeri'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Tanda Mayor</td>
                        <td>
                            <ul class="mb-0">
                                @forelse ($rekam_medis['evaluasi']['tanda_mayor'] as $tanda_mayor)
                                        @if ($tanda_mayor->is_checked == true)
                                            <li> {{ $tanda_mayor->value }} </li>
                                        @endif
                                @empty
                                    <li>Tidak Ada Tanda Mayor</li>
                                @endforelse
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td>Tanda Minor</td>
                        <td>
                            <ul class="mb-0">
                                @forelse ($rekam_medis['evaluasi']['tanda_minor'] as $tanda_minor)
                                        @if ($tanda_minor->is_checked == true)
                                            <li> {{ $tanda_minor->value }} </li>
                                        @endif
                                @empty
                                    <li>Tidak Ada Tanda Minor</li>
                                @endforelse
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td>Provoking</td>
                        <td>{{ $rekam_medis['evaluasi']['provoking'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Quality</td>
                        <td>{{ $rekam_medis['evaluasi']['quality'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Region</td>
                        <td>{{ $rekam_medis['evaluasi']['region'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Severity</td>
                        <td>{{ $rekam_medis['evaluasi']['severity'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Time</td>
                        <td>{{ $rekam_medis['evaluasi']['time'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Analisa</td>
                        <td>{{ getAnalisa($rekam_medis['evaluasi']['analisa'] ?? '-') }}</td>
                    </tr>
                    <tr>
                        <td>Planning</td>
                        <td>{{ $rekam_medis['evaluasi']['planning'] ?? '-' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</body>
<script>
    window.print()

        // Calling function with () will execute the function immediately. 
    // Its fine in firefox but not in chrome. so we call function as variable in chrome
    if(navigator.userAgent.indexOf("Firefox") != -1 ){
        window.onafterprint = back()
    }else{
        window.onafterprint = back
    }


    function back() {
        // Window history back simply just close the window and redirect to previous page immediately on firefox, 
        // but if we specify the url, it will wait until we print or cancel.
        window.close();
        // if(navigator.userAgent.indexOf("Firefox") != -1 ){
        //     document.location.href = ''
        // }else{
        //     window.history.back()
        // }
    }
</script>
</html>