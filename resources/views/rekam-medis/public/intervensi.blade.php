@extends('layouts.public')

@section('content')
<div class="card">
    <div class="card-header mx-0 row justify-content-between align-items-center">
        <div class="col-6">
            <h6 class="py-1 m-0">Data Rekam Medis</h6>
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

        <div class="col-12 pb-3 pb-md-0 mt-4">
            <h5><b>Video Bantuan Terapi</b></h5>
        </div>
        <div class="col-12 h-75">
            @foreach ($intervensi as $interven)
                @if ($interven->url_youtube != null)
                    <span><b>LINK VIDEO {{ $interven->value }} : <a href="{{ $interven->url_youtube }}" target="_blank">{{ $interven->url_youtube }}</a></b></span> <br>
                    <div class="d-none d-md-block">
                        <iframe width="100%" height="500" src="https://www.youtube.com/embed/{{ $interven->id_youtube }}?feature=oembed" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <div class="d-block d-md-none">
                        <iframe width="100%" height="300" src="https://www.youtube.com/embed/{{ $interven->id_youtube }}?feature=oembed" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    
</div>
@endsection