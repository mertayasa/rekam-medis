@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Pengkajian</div>
        <div class="card-body">
            @include('layouts.flash')
            @include('layouts.error_message')
            {!! Form::open(['route' => ['pasien.store'], 'method' => 'post', 'id' => 'createPasienForm']) !!}
            <div class="row">
                <div class="col-12 mt-2  pb-3 pb-md-0">
                    {!! Form::label('keluahan_utama', 'Keluhan Utama', ['class' => 'mb-1']) !!}
                    {!! Form::textarea('keluahan_utama', null, ['class' => 'form-control', 'id' => 'keluahan_utama', 'x-model' => '$store.pengkajian.data.keluhan_utama' ,'style' => 'height: 100px']) !!}
                </div>

                <h5 class="mt-3">Data Subjektif</h5>
                <div class="col-12 pb-3 pb-md-0">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="isNyeri" x-model="$store.pengkajian.data.is_mengeluh_nyeri">
                        <label class="form-check-label" for="isNyeri">
                            Pasien Mengeluh Nyeri
                        </label>
                    </div>
                </div>

                <div class="col-12 pb-3 pb-md-0">
                    {!! Form::label('provoking', 'Provoking', ['class' => 'mb-1']) !!}
                    {!! Form::text('provoking', null, ['class' => 'form-control', 'id' => 'provoking', 'x-model' => '$store.pengkajian.data.provoking']) !!}
                </div>
                <div class="col-12 mt-2  pb-3 pb-md-0">
                    {!! Form::label('quality', 'Quality', ['class' => 'mb-1']) !!}
                    {!! Form::text('quality', null, ['class' => 'form-control', 'id' => 'quality', 'x-model' => '$store.pengkajian.data.quality']) !!}
                </div>
                <div class="col-12 mt-2  pb-3 pb-md-0">
                    {!! Form::label('region', 'Region', ['class' => 'mb-1']) !!}
                    {!! Form::text('region', null, ['class' => 'form-control', 'id' => 'region', 'x-model' => '$store.pengkajian.data.region']) !!}
                </div>
                <div class="col-12 mt-2  pb-3 pb-md-0">
                    {!! Form::label('severity', 'Severity', ['class' => 'mb-1']) !!}
                    {!! Form::text('severity', null, ['class' => 'form-control', 'id' => 'severity', 'x-model' => '$store.pengkajian.data.severity']) !!}
                </div>
                <div class="col-12 mt-2  pb-3 pb-md-0">
                    {!! Form::label('time', 'Time', ['class' => 'mb-1']) !!}
                    {!! Form::text('time', null, ['class' => 'form-control', 'id' => 'time', 'x-model' => '$store.pengkajian.data.time']) !!}
                </div>

                <div class="col-12 mt-2  pb-3 pb-md-0">
                    <h5 class="mt-3">Data Objektif</h5>
                </div>
                
                <div class="col-12 pb-3">
                    <p class="mb-0"> <b> Tanda Mayor : </b></p>
                    <ul class="mb-0 pb-0">
                        {{-- <template x-if="!$store.pengkajian.data.tanda_mayor">
                            <li>Tidak ada tanda mayor</li>
                        </template> --}}
                        <template x-for="(tanda, index) in $store.pengkajian.tanda_mayor">
                            <template x-if="tanda.is_checked">
                                <li x-text="tanda.value"></li>
                            </template>
                        </template>
                    </ul>
                    <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#tandaMayor">Edit</button>
                </div>

                <div class="col-12 pb-3">
                    <p class="mb-0"> <b>Tanda Minor :</b> </p>
                    <ul class="mb-0 pb-0">
                        {{-- <template x-if="!$store.pengkajian.data.tanda_minor">
                            <li>Tidak ada tanda mayor</li>
                        </template> --}}
                        <template x-for="(tanda, index) in $store.pengkajian.tanda_minor">
                            <template x-if="tanda.is_checked">
                                <li x-text="tanda.value"></li>
                            </template>
                        </template>
                    </ul>
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#tandaMinor">Edit</button>
                </div>

                <div class="col-12 pb-3 pb-md-0">
                    <h5 class="mt-3">Kondisi Klinis</h5>
                </div>

                <div class="col-12 pb-3 pb-md-0">
                    <p class="mb-0"> <b>Kondisi :</b> </p>
                    <ul class="mb-0 pb-0">
                        {{-- <template x-if="!$store.pengkajian.data.kondisi_klinis">
                            <li>Tidak ada kondisi klinis</li>
                        </template> --}}
                        <template x-for="(kondisi, index) in $store.pengkajian.kondisi_klinis">
                            <template x-if="kondisi.is_checked">
                                <li x-text="kondisi.value"></li>
                            </template>
                        </template>
                    </ul>
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#kondisiKlinis">Edit</button>
                </div>
            </div>
            <template x-if="$store.pengkajian.is_submitable == false">
                <span class="text-danger">Tanda Mayor & Tanda Minor belum memenuhi syarat</span>
            </template>
            <div class="text-end mt-3">
                <button type="button" x-bind:disabled="$store.pengkajian.is_submitable == false" class="btn btn-sm btn-primary" x-on:click="$store.pengkajian.store($event)">
                    Simpan
                </button>
                <button type="button" x-bind:disabled="$store.pengkajian.is_submitable == false" class="btn btn-sm btn-warning" data-edit-rdiagnosa="true" x-on:click="$store.pengkajian.store($event)">
                    Simpan & Edit Kajian
                </button>
            </div>
        </div>
    </div>

    @include('includes.pengkajian.tanda_mayor_modal')
    @include('includes.pengkajian.tanda_minor_modal')
    @include('includes.pengkajian.kondisi_klinis_modal')
@endsection

@push('scripts')
    <script>
        const form = document.getElementById('createPasienForm');

        document.addEventListener('alpine:init', () => {
            Alpine.store('pengkajian', {
                is_submitable: false,
                data: JSON.parse(`{!!  json_encode($pengkajian) !!}`),
                tanda_mayor: JSON.parse(`{!!  json_encode($tanda_mayor) !!}`),
                tanda_minor: JSON.parse(`{!!  json_encode($tanda_minor) !!}`),
                kondisi_klinis: JSON.parse(`{!!  json_encode($kondisi_klinis) !!}`),
                validateCheckbox(type){
                    const checkedLengthMayor = this.tanda_mayor.filter(item => item.is_checked == true).length
                    const optionLengthMayor = this.tanda_mayor.length
                    const minimumMayor = (optionLengthMayor * 80) / 100

                    const checkedLengthMinor = this.tanda_minor.filter(item => item.is_checked == true).length
                    const optionLengthMinor = this.tanda_minor.length
                    const minimumMinor = (optionLengthMinor * 20) / 100

                    if((checkedLengthMayor >= Math.round(minimumMayor)) && (checkedLengthMinor >= Math.round(minimumMinor))){
                        this.is_submitable = true
                    }

                    if(type == 'check_only'){
                        return true
                    }

                    if(type == 'mayor'){
                        if(checkedLengthMayor < Math.round(minimumMayor)){
                            return showSwalAlert('error', `Tanda mayor dipilih minimal ${Math.round(minimumMayor)} (80% dari pilihan)`)
                        }
                    }

                    if(type == 'minor'){
                        if(checkedLengthMinor < Math.round(minimumMinor)){
                            return showSwalAlert('error', `Tanda minor dipilih minimal ${Math.round(minimumMinor)} (20% dari pilihan)`)
                        }
                    }

                    $('#tandaMayor').modal('hide')
                    $('#tandaMinor').modal('hide')
                },
                store(event) {
                    console.log(this.data);
                    clearFlash()
                    fetch("{{ route('rekam.update_pengkajian', $pasien->id) }}", {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                'Content-Type': 'application/json',
                            },
                            method: 'PATCH',
                            body: JSON.stringify({
                                data: this.data,
                                tanda_mayor: this.tanda_mayor,
                                tanda_minor: this.tanda_minor,
                                kondisi_klinis: this.kondisi_klinis,
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
                            const isEditRmedis = event.target.getAttribute('data-edit-rdiagnosa')
                            if (isEditRmedis == 'true') {
                                return window.location.href = data.redirect_to_rdiagnosa
                            }

                            return window.location.href = data.redirect_to
                        })
                        .catch((error) => {
                            Alpine.store('global').showFlash('Terjadi kesalahan pada sistem', 'error')
                            return showSwalAlert('error', 'Terjadi kesalahan pada sistem')
                        })
                }
            })
            Alpine.store('pengkajian').validateCheckbox('check_only')
        })
    </script>
@endpush
