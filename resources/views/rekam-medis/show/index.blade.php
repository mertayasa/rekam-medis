@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Data Rekam Medis</div>
    <div class="card-body">
        <div class="col-12 pb-3 pb-md-0">
            <h5>Biodata Pasien</h5>
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
            <h5>Kajian</h5>
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
            <h5>Diagnosa</h5>
        </div>

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

        <div class="col-12 pb-3 pb-md-0 mt-4">
            <h5>Luaran & Intervensi</h5>
        </div>

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
</div>
@endsection