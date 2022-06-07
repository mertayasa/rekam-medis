@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('plugin/select2/dist/css/select2.css') }}">
@endpush

@section('content')
    <div class="card">
        <div class="card-header">Implementasi Keperawatan</div>
        <div class="card-body">
            @include('layouts.flash')
            @include('layouts.error_message')
            {!! Form::open(['method' => 'POST', 'id' => 'editDiagnosaForm']) !!}
                <div class="row">
                    @if ($pasien->id != null)
                        <div class="col-12 mt-2  pb-3 pb-md-0">
                            {!! Form::label('diagnosa', 'No RM / Nama Pasien', ['class' => 'mb-1']) !!}
                            {!! Form::select('diagnosa', [$pasien->id => $pasien->nama_and_rm], $pasien->id, ['class' => 'form-control', 'disabled' => true, 'id' => 'selectPasien', 'onchange' => 'onChangePasien(this.value)']) !!}
                        </div>
                    @else
                        <div class="col-12 mt-2  pb-3 pb-md-0">
                            {!! Form::label('diagnosa', 'Cari No RM / Nama Pasien', ['class' => 'mb-1']) !!}
                            {!! Form::select('diagnosa', $pasien_all->toArray(), $pasien->id, ['class' => 'form-control', 'id' => 'selectPasien', 'onchange' => 'onChangePasien(this.value)']) !!}
                        </div>
                    @endif
                </div>
                <div class="col-12 mt-3">
                    <p class="mb-0"> <b> Diagnosa Medis : <span x-text="$store.rmedis.pasien.diagnosa_medis ?? '-'"></span> </b></p>
                </div>
                <div class="col-12 pb-3">
                    <p class="mb-0"> <b> Diagnosa Keperawatan : <span x-text="$store.rmedis.pasien.diagnosa_keperawatan ?? '-'"></span> </b></p>
                </div>
                <div class="col-12 pb-3">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            {!! Form::label('date', 'Tanggal', ['class' => 'mb-1']) !!}
                            {!! Form::date('date', null, ['class' => 'form-control', 'id' => 'date', 'x-model' => '$store.rmedis.data.date']) !!}
                        </div>
                        <div class="col-12 col-md-6">
                            {!! Form::label('time', 'Jam', ['class' => 'mb-1']) !!}
                            {!! Form::time('time', null, ['class' => 'form-control', 'id' => 'time', 'x-model' => '$store.rmedis.data.time']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-12 pb-3">
                    <div class="row">
                        <div class="col-12 mt-2  pb-3 pb-md-0">
                            {!! Form::label('perawatPelaksana', 'Perawat Pelaksana', ['class' => 'mb-1']) !!}
                            {!! Form::text('perawat_pelaksana', null, ['class' => 'form-control', 'id' => 'perawatPelaksana', 'x-model' => '$store.rmedis.data.perawat_pelaksana']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-12 pb-md-0">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <p class="mb-2"><b>Intervensi & Tindakan Keperawatan</b></p>
                        </div>
                        <div class="col-6 text-end">
                            {{-- @if (isset($rekam_medis['luaran']['share_link']))
                                <a href="{{ $rekam_medis['luaran']['share_link'] }}" target="_blank" class="btn btn-sm btn-primary">Public Link <i class="fas fa-share"></i></a>
                            @endif --}}
                        </div>
                    </div>
                </div>
            
                <div id="intervensiCheckbox"></div>

                <div class="text-end mt-3">
                    <a href="{{ $prev_btn['url'] }}" class="btn btn-sm btn-danger"><i class="fas fa-arrow-alt-circle-left"></i> {{ $prev_btn['label'] }} </a>
                    <button type="button" class="btn btn-sm btn-primary" x-on:click="$store.rmedis.store($event)">
                        Simpan <i class="fas fa-save"></i>
                    </button>
                    @if ($pasien->id != null)
                        <button type="button" class="btn btn-sm btn-warning" data-edit-revaluasi="true" x-on:click="$store.rmedis.store($event)">
                            Simpan & Edit Evaluasi <i class="fas fa-arrow-alt-circle-right"></i>
                        </button>
                    @endif
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('plugin/select2/dist/js/select2.js') }}"></script>
    <script>
        $('select').select2();

        function onChangePasien(value){
            Alpine.store('rmedis').getImplementasi(value)
        }

        document.addEventListener('alpine:init', () => {
            const selectPasien = document.getElementById('selectPasien')
            Alpine.store('rmedis', {
                data: {},
                intervensi: [],
                pasien: {},
                init(){
                    this.getImplementasi(selectPasien.value)
                },
                getImplementasi(value){
                    if(value != ''){
                        fetch("{{ url('rekam-medis/edit/get-implementasi') }}" + "/" + selectPasien.value, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            },
                            method: 'GET',
                        }).then(function(response){
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
                            console.log(data);
                            this.data = data.implementasi
                            this.intervensi = data.intervensi
                            this.pasien = data.pasien

                            const intervensiCheckbox = document.getElementById('intervensiCheckbox')
                            intervensiCheckbox.innerHTML = ''
                            intervensiCheckbox.insertAdjacentHTML('beforeend', data.checkbox_intervensi)
                        })
                        .catch((error) => {
                            console.log(error);
                            Alpine.store('global').showFlash('Terjadi kesalahan pada sistem', 'error')
                            return showSwalAlert('error', 'Terjadi kesalahan pada sistem')
                        })
                    }
                },
                setCheckedIntervensi(event) {
                    const target = event.target
                    const indexIntervensi = target.getAttribute('data-index-intervensi')
                    const idChild = target.getAttribute('data-id-child')
                    if (target.checked == true) {
                        this.data.checked_intervensi_child.push(parseInt(idChild))
                        this.intervensi[indexIntervensi].is_checked = true
                    } else {
                        let indexChild = this.data.checked_intervensi_child.indexOf(parseInt(idChild));
                        if (indexChild !== -1) {
                            this.data.checked_intervensi_child.splice(indexChild, 1);
                        }
                    }

                    console.log(this.data.checked_intervensi_child);
                },
                store(event) {
                    clearFlash()
                    fetch("{{ url('rekam-medis/update/implementasi') }}" + '/' + this.pasien.id, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                'Content-Type': 'application/json',
                            },
                            method: 'PATCH',
                            body: JSON.stringify({
                                data: this.data,

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
                            console.log(data);
                            const isEditRmedis = event.target.getAttribute('data-edit-revaluasi')
                            if (isEditRmedis == 'true') {
                                return window.location.href = data.redirect_to_revaluasi
                            }

                            return window.location.reload()
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
