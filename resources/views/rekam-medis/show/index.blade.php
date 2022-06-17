@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header mx-0 row justify-content-between align-items-center">
        <div class="col-6">
            <h6 class="py-1 m-0">Data Rekam Medis</h6>
        </div>
        <div class="col-6 text-end">
            <a href="{{ route('rekam.print', $pasien->id) }}" target="_blank" class="btn btn-sm btn-primary">Cetak Rekam Medis <i class="fas fa-print"></i></a>
        </div>
    </div>
    <div class="card-body">
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
            <tr>
                <td>Diagnosa Medis</td>
                <td width="50" class="text-center">:</td>
                <td>{{ $pasien->diagnosa_medis ?? '-' }}</td>
            </tr>
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

        <div class="text-end mt-3">
            <a href="{{ route('pasien.edit', $pasien->id) }}" class="btn btn-sm btn-warning"> Edit Pasien <i class="fas fa-arrow-alt-circle-right"></i></a>
        </div>

        <hr>

        <div class="col-12 pb-3 pb-md-0 mt-4">
            <h5><b>Pengkajian</b></h5>
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
                        <td>
                            {{ $rekam_medis['pengkajian']['durasi_nyeri'] ?? '-' }} <br>
                            {{ $rekam_medis['pengkajian']['time'] ?? '-' }}
                        </td>
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
                        <td width="200">Diagnosa Keperawatan</td>
                        <td>{{ $rekam_medis['diagnosa']['diagnosa'] ?? '-' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <hr>

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

        <div class="col-12 pb-3 pb-md-0 mt-4 mb-2">
            <div class="row align-items-center">
                <div class="col-6">
                    <h5><b>Intervensi</b></h5>
                </div>
                <div class="col-6 text-end">
                    @if (isset($rekam_medis['luaran']['share_link']))
                        <a href="{{ $rekam_medis['luaran']['share_link'] }}" target="_blank" class="btn btn-sm btn-primary">Public Link <i class="fas fa-share"></i></a>
                    @endif
                </div>
            </div>
        </div>

        @include('includes.implementasi.intervensi_list', ['intervensi' => $rekam_medis['intervensi'], 'disabled' => true])

        <hr>

        <div class="col-12 pb-3 pb-md-0 mt-4">
            <h5><b>Riwayat Implementasi Keperawatan</b></h5>
        </div>

        @include('includes.history.implementasi', ['value_implementasi' => $history_implementasi ?? []])

        <hr>

        <div class="col-12 pb-3 pb-md-0 mt-4">
            <h5><b>Riwayat Evaluasi</b></h5>
        </div>

        @include('includes.history.evaluasi', ['value_evaluasi' => $history_evaluasi ?? []])

        <div class="text-end mt-3">
            <a href="{{ route('pasien.index') }}" class="btn btn-sm btn-danger"><i class="fas fa-arrow-alt-circle-left"></i> Kembali </a>
            <a href="{{ route('rekam.print', $pasien->id) }}" target="_blank" class="btn btn-sm btn-primary">Cetak Rekam Medis <i class="fas fa-print"></i></a>
            <a href="{{ route('rekam.edit_pengkajian', $pasien->id) }}" class="btn btn-sm btn-warning"> Edit Rekam Medis <i class="fas fa-arrow-alt-circle-right"></i></a>
        </div>

    </div>
</div>
@endsection