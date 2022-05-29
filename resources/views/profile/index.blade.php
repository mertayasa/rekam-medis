@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @include('profile.sidebar')
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Biodata</div>
                    <div class="card-body">
                        @include('layouts.flash')
                        @include('layouts.error_message')
                        <table>
                            <tr>
                                <td>Nama</td>
                                <td width="50" class="text-center">:</td>
                                <td>{{ $profile->nama ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>NIK</td>
                                <td width="50" class="text-center">:</td>
                                <td>{{ $profile->nik ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>NIP</td>
                                <td width="50" class="text-center">:</td>
                                <td>{{ $profile->nip ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>Tempat/Tanggal Lahir</td>
                                <td width="50" class="text-center">:</td>
                                <td>{{ $profile->tempat_lahir ?? '-' }}/{{ $profile->tanggal_lahir ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td width="50" class="text-center">:</td>
                                <td>{{ $profile->alamat ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>No. Handphone</td>
                                <td width="50" class="text-center">:</td>
                                <td>{{ $profile->no_hp ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td width="50" class="text-center">:</td>
                                <td>{{ $profile->email ?? '-' }}</td>
                            </tr>
                        </table>
                        {{-- <div class="text-end">
                        <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-warning">Edit Profil</a>
                    </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
