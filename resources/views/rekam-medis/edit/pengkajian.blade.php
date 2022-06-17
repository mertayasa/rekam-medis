@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">Pengkajian</div>
        <i class="fas fa-arrow-alt-right"></i>
        <div class="card-body">
            @include('layouts.flash')
            @include('layouts.error_message')
            {!! Form::open(['route' => ['pasien.store'], 'method' => 'post', 'id' => 'editKajianForm']) !!}
            <div class="row">
                <div class="col-12 mt-2  pb-3 pb-md-0">
                    {!! Form::label('keluahan_utama', 'Keluhan Utama', ['class' => 'mb-1']) !!}
                    {!! Form::textarea('keluahan_utama', null, ['class' => 'form-control', 'id' => 'keluahan_utama', 'x-model' => '$store.rmedis.data.keluhan_utama' ,'style' => 'height: 100px']) !!}
                </div>

                <h5 class="mt-3">Data Subjektif</h5>
                <div class="col-12 pb-3 pb-md-0">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="isNyeri" x-model="$store.rmedis.data.is_mengeluh_nyeri">
                        <label class="form-check-label" for="isNyeri">
                            Pasien Mengeluh Nyeri
                        </label>
                    </div>
                </div>

                <div class="col-12 pb-3 pb-md-0">
                    {!! Form::label('provoking', 'Provoking', ['class' => 'mb-1']) !!}
                    {!! Form::text('provoking', null, ['class' => 'form-control', 'id' => 'provoking', 'x-model' => '$store.rmedis.data.provoking']) !!}
                </div>
                <div class="col-12 mt-2  pb-3 pb-md-0">
                    {!! Form::label('quality', 'Quality', ['class' => 'mb-1']) !!}
                    {!! Form::text('quality', null, ['class' => 'form-control', 'id' => 'quality', 'x-model' => '$store.rmedis.data.quality']) !!}
                </div>
                <div class="col-12 mt-2  pb-3 pb-md-0">
                    {!! Form::label('region', 'Region', ['class' => 'mb-1']) !!}
                    {!! Form::text('region', null, ['class' => 'form-control', 'id' => 'region', 'x-model' => '$store.rmedis.data.region']) !!}
                </div>
                <div class="col-12 mt-2  pb-3 pb-md-0">
                    {!! Form::label('severity', 'Severity', ['class' => 'mb-1']) !!}
                    {!! Form::text('severity', null, ['class' => 'form-control', 'id' => 'severity', 'x-model' => '$store.rmedis.data.severity']) !!}
                </div>
                <div class="col-12 mt-2  pb-3 pb-md-0">
                    {!! Form::label('time', 'Time', ['class' => 'mb-1']) !!}
                    {!! Form::text('time', null, ['class' => 'form-control', 'id' => 'time', 'x-model' => '$store.rmedis.data.time']) !!}
                </div>

                <div class="col-12 mt-2  pb-3 pb-3">
                    {{-- <p class="mb-0"> <b> Keluhan Tambahan : </b></p> --}}
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="durasi_nyeri" id="durasi_nyeri1" value="lebih_3" x-model="$store.rmedis.data.durasi_nyeri">
                        <label class="form-check-label" for="durasi_nyeri1">
                            Nyeri > 3bulan
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="durasi_nyeri" id="durasi_nyeri2" value="kurang_3" x-model="$store.rmedis.data.durasi_nyeri">
                        <label class="form-check-label" for="durasi_nyeri2">
                            Nyeri < 3bulan
                        </label>
                      </div>
                </div>                

                <div class="col-12 mt-2  pb-3 pb-md-0">
                    <h5 class="mt-3">Data Objektif</h5>
                </div>
                                
                @include('includes.input.data_objektif')
            </div>
            <template x-if="$store.rmedis.is_submitable == false">
                <span class="text-danger">Tanda Mayor & Tanda Minor belum memenuhi syarat</span>
            </template>
            
            <div class="text-end mt-3">
                <a href="{{ $prev_btn['url'] }}" class="btn btn-sm btn-danger"><i class="fas fa-arrow-alt-circle-left"></i> {{ $prev_btn['label'] }} </a>
                <button type="button" x-bind:disabled="$store.rmedis.is_submitable == false" class="btn btn-sm btn-primary" x-on:click="$store.rmedis.store($event)">
                    Simpan <i class="fas fa-save"></i>
                </button>
                <button type="button" x-bind:disabled="$store.rmedis.is_submitable == false" class="btn btn-sm btn-warning" data-edit-rdiagnosa="true" x-on:click="$store.rmedis.store($event)">
                    Simpan & Edit Diagnosa <i class="fas fa-arrow-alt-circle-right"></i>
                </button>
                <a href="{{ route('rekam.edit_diagnosa', $pasien->id) }}" class="btn btn-sm btn-info">
                    Lewati <i class="fas fa-arrow-alt-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const form = document.getElementById('editKajianForm');

        document.addEventListener('alpine:init', () => {
            Alpine.store('rmedis', {
                is_submitable: true,
                data: JSON.parse(`{!!  json_encode($pengkajian) !!}`),
                tanda_mayor: JSON.parse(`{!!  json_encode($tanda_mayor) !!}`),
                tanda_minor: JSON.parse(`{!!  json_encode($tanda_minor) !!}`),
                etiologi: JSON.parse(`{!!  json_encode($etiologi) !!}`),
                validateCheckbox(type){
                    // const checkedLengthMayor = this.tanda_mayor.filter(item => item.is_checked == true).length
                    // const optionLengthMayor = this.tanda_mayor.length
                    // const minimumMayor = (optionLengthMayor * 80) / 100

                    // const checkedLengthMinor = this.tanda_minor.filter(item => item.is_checked == true).length
                    // const optionLengthMinor = this.tanda_minor.length
                    // const minimumMinor = (optionLengthMinor * 20) / 100

                    // if((checkedLengthMayor >= Math.round(minimumMayor)) && (checkedLengthMinor >= Math.round(minimumMinor))){
                    //     this.is_submitable = true
                    // }

                    // if(type == 'check_only'){
                    //     return true
                    // }

                    // if(type == 'mayor'){
                    //     if(checkedLengthMayor < Math.round(minimumMayor)){
                    //         return showSwalAlert('error', `Tanda mayor dipilih minimal ${Math.round(minimumMayor)} (80% dari pilihan)`)
                    //     }
                    // }

                    // if(type == 'minor'){
                    //     if(checkedLengthMinor < Math.round(minimumMinor)){
                    //         return showSwalAlert('error', `Tanda minor dipilih minimal ${Math.round(minimumMinor)} (20% dari pilihan)`)
                    //     }
                    // }

                    $('#tandaMayor').modal('hide')
                    $('#tandaMinor').modal('hide')
                },
                store(event) {
                    // const formData = new FormData(form);
                    // console.log(Object.fromEntries(formData));
                    // console.log(this.data);
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
                                etiologi: this.etiologi,
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
            // Alpine.store('rmedis').validateCheckbox('check_only')
        })
    </script>
@endpush
