@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Tambah Pasien Baru</div>
        <div class="card-body">
            @include('layouts.flash')
            @include('layouts.error_message')
            {!! Form::open(['route' => ['pasien.store'], 'method' => 'post', 'id' => 'createPasienForm']) !!}
            @include('pasien.form')
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
