@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Diagnosa</div>
        <div class="card-body">
            @include('layouts.flash')
            @include('layouts.error_message')
            {!! Form::open(['method' => 'POST', 'route' => ['rekam.update_diagnosa', $pasien->id], 'id' => 'editDiagnosaForm']) !!}
                <div class="row">
                    <div class="col-12 mt-2  pb-3 pb-md-0">
                        {!! Form::label('diagnosa', 'Diagnosa', ['class' => 'mb-1']) !!}
                        {!! Form::select('diagnosa',  ['Nyeri Akut' => 'Nyeri Akut', 'Nyeri Kronis' => 'Nyeri Kronis'], null, ['class' => 'form-control', 'id' => 'diagnosa', 'x-model' => '$store.rmedis.data.diagnosa']) !!}
                    </div>
                </div>
                <div class="text-end mt-3">
                    <a href="{{ $prev_btn['url'] }}" class="btn btn-sm btn-danger"><i class="fas fa-arrow-alt-circle-left"></i> {{ $prev_btn['label'] }} </a>
                    <button type="button" class="btn btn-sm btn-primary" x-on:click="$store.rmedis.store($event)">
                        Simpan <i class="fas fa-save"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-warning" data-edit-rluaran="true" x-on:click="$store.rmedis.store($event)">
                        Simpan & Edit Luaran <i class="fas fa-arrow-alt-circle-right"></i>
                    </button>
                    <a href="{{ route('rekam.edit_luaran', $pasien->id) }}" class="btn btn-sm btn-info">
                        Lewati <i class="fas fa-arrow-alt-circle-right"></i>
                    </a>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('rmedis', {
                data: JSON.parse(`{!!  json_encode($diagnosa) !!}`),
                store(event) {
                    clearFlash()
                    fetch("{{ route('rekam.update_diagnosa', $pasien->id) }}", {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                'Content-Type': 'application/json',
                            },
                            method: 'PATCH',
                            body: JSON.stringify({
                                diagnosa: this.data.diagnosa,
                            }),
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
                            // console.log(data);
                            const isEditRmedis = event.target.getAttribute('data-edit-rluaran')
                            if (isEditRmedis == 'true') {
                                return window.location.href = data.redirect_to_rluaran
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
