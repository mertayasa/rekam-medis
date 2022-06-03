@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Edit Pasien</div>
        <div class="card-body">
            @include('layouts.flash')
            @include('layouts.error_message')
            {!! Form::model($pasien, ['route' => ['pasien.update', $pasien->id], 'id' => 'editPasienForm']) !!}
            @include('pasien.form')
            <div class="text-end mt-3">
                <a href="{{ $prev_btn['url'] }}" class="btn btn-sm btn-danger"><i class="fas fa-arrow-alt-circle-left"></i> {{ $prev_btn['label'] }} </a>
                <button type="button" class="btn btn-sm btn-primary" x-on:click="$store.editPasien.update($event)">
                    Simpan <i class="fas fa-save"></i>
                </button>
                <button type="button" class="btn btn-sm btn-warning" data-edit-rmedis="true" x-on:click="$store.editPasien.update($event)">
                    Simpan & Edit Rekam Medis <i class="fas fa-arrow-alt-circle-right"></i>
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const form = document.getElementById('editPasienForm');

        document.addEventListener('alpine:init', () => {
            Alpine.store('editPasien', {
                update(event){
                    let formData = new FormData(form);
                    clearFlash()

                    fetch("{{ route('pasien.update', $pasien->id) }}", {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            'Content-Type': 'application/json',
                        },
                        method: 'PATCH',
                        body: JSON.stringify(Object.fromEntries(formData)),
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
