@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Tambah Pasien Baru</div>
        <div class="card-body">
            @include('layouts.flash')
            @include('layouts.error_message')
            {!! Form::open(['route' => ['pasien.store'], 'method' => 'post', 'id' => 'createPasienForm']) !!}
            <div class="row">
                <div class="col-12 mt-2  pb-3 pb-md-0">
                    {!! Form::label('nama', 'Nama', ['class' => 'mb-1']) !!}
                    {!! Form::text('nama', null, ['class' => 'form-control', 'id' => 'nama']) !!}
                </div>
                <div class="col-12 mt-2  pb-3 pb-md-0">
                    {!! Form::label('no_rm', 'No. Rm', ['class' => 'mb-1']) !!}
                    {!! Form::text('no_rm', null, ['class' => 'form-control', 'id' => 'no_rm']) !!}
                </div>
                <div class="col-12 mt-2  pb-3 pb-md-0">
                    {!! Form::label('jenis_kelamin', 'Jenis Kelamin', ['class' => 'mb-1']) !!}
                    {!! Form::select('jenis_kelamin', ['Laki-Laki' => 'Laki-Laki', 'Perempuan' => 'Perempuan'], null, ['class' => 'form-control', 'id' => 'jenis_kelamin']) !!}
                </div>
                <div class="col-12 mt-2  pb-3 pb-md-0">
                    {!! Form::label('no_hp', 'No. Handphone', ['class' => 'mb-1']) !!}
                    {!! Form::text('no_hp', null, ['class' => 'form-control', 'id' => 'no_hp']) !!}
                </div>
                <div class="col-12 mt-2  pb-3 pb-md-0">
                    {!! Form::label('alamat', 'Alamat', ['class' => 'mb-1']) !!}
                    {!! Form::text('alamat', null, ['class' => 'form-control', 'id' => 'alamat']) !!}
                </div>
                <div class="col-12 mt-2  pb-3 pb-md-0">
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            {!! Form::label('tempat_lahir', 'Tempat Lahir', ['class' => 'mb-1']) !!}
                            {!! Form::text('tempat_lahir', null, ['class' => 'form-control', 'id' => 'tempat_lahir']) !!}
                        </div>
                        <div class="col-12 col-md-6">
                            {!! Form::label('tanggal_lahir', 'Tanggal Lahir', ['class' => 'mb-1']) !!}
                            {!! Form::date('tanggal_lahir', null, ['class' => 'form-control', 'id' => 'tanggal_lahir']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-2  pb-3 pb-md-0">
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            {!! Form::label('tanggal_masuk', 'Tanggal Masuk', ['class' => 'mb-1']) !!}
                            {!! Form::date('tanggal_masuk', null, ['class' => 'form-control', 'id' => 'tanggal_masuk']) !!}
                        </div>
                        <div class="col-12 col-md-6">
                            {!! Form::label('tanggal_keluar', 'Tanggal Keluar (Kosongkan apabila belum keluar)', ['class' => 'mb-1']) !!}
                            {!! Form::date('tanggal_keluar', null, ['class' => 'form-control', 'id' => 'tanggal_keluar']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-2  pb-3 pb-md-0">
                    {!! Form::label('nama_wali', 'Nama Wali', ['class' => 'mb-1']) !!}
                    {!! Form::text('nama_wali', null, ['class' => 'form-control', 'id' => 'nama_wali']) !!}
                </div>
                <div class="col-12 mt-2  pb-3 pb-md-0">
                    {!! Form::label('kontak_wali', 'Kontak Wali', ['class' => 'mb-1']) !!}
                    {!! Form::text('kontak_wali', null, ['class' => 'form-control', 'id' => 'kontak_wali']) !!}
                </div>
                <div class="col-12 mt-2  pb-3 pb-md-0">
                    {!! Form::label('hubungan_wali', 'Kontak Wali', ['class' => 'mb-1']) !!}
                    {!! Form::select( 'hubungan_wali',
                        [
                            'Ayah' => 'Ayah',
                            'Ibu' => 'Ibu',
                            'Kakek' => 'Kakek',
                            'Nenek' => 'Nenek',
                            'Kakak' => 'Kakak',
                            'Adik' => 'Adik',
                            'Lainnya' => 'Lainnya',
                        ],
                        null,
                        ['class' => 'form-control', 'id' => 'hubungan_wali'],
                    ) !!}
                </div>
            </div>
            <div class="text-end mt-3">
                <button type="button" class="btn btn-sm btn-primary" x-on:click="$store.createPasien.store($event)">
                    Simpan
                </button>
                <button type="button" class="btn btn-sm btn-warning" data-edit-rmedis="true" x-on:click="$store.createPasien.store($event)">
                    Simpan & Tambah Rekam Medis
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const form = document.getElementById('createPasienForm');

        document.addEventListener('alpine:init', () => {
            Alpine.store('createPasien', {
                store(event){
                    let formData = new FormData(form);
                    clearFlash()

                    fetch("{{ route('pasien.store') }}", {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        },
                        method: 'POST',
                        body: formData,
                    })
                    .then(function(response) {
                        const data = response.json()
                        if (response.status != 200) {
                            data.then((res) => {
                                const message = res.message
                                Alpine.store('global').showFlash(res.message, 'error')
                            })
                            throw new Error()
                        }
                        
                        return data
                    })
                    .then(data => {
                        const isEditRmedis = event.target.getAttribute('data-edit-rmedis')
                        if(isEditRmedis == 'true'){
                            console.log('asdssa');
                            return window.location.href = data.redirect_to_rmedis
                        }

                        return window.location.href = data.redirect_to
                    })
                    .catch((error) => {
                        Alpine.store('global').showFlash('Terjadi kesalahan pada sistem', 'error')
                        return showSwalAlert('error', 'Terjadi kesalahan pada sistem')
                    })
                }
            })
        })
    </script>
@endpush
