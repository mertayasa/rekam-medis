@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Evaluasi</div>
        <div class="card-body">
            @include('layouts.flash')
            @include('layouts.error_message')
            {!! Form::open(['method' => 'POST', 'route' => ['rekam.update_evaluasi', $pasien->id], 'id' => 'editEvaluasiForm']) !!}
            <div class="row">
                <h5 class="mt-3">Data Subjektif</h5>
                <div class="col-12 mt-2  pb-3 pb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="rasa_nyeri" id="rasa_nyeri1"
                            value="mengekuh_nyeri" x-model="$store.rmedis.data.rasa_nyeri">
                        <label class="form-check-label" for="rasa_nyeri1">
                            Pasien mengekuh nyeri
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="rasa_nyeri" id="rasa_nyeri2"
                            value="nyeri_berkurang" x-model="$store.rmedis.data.rasa_nyeri">
                        <label class="form-check-label" for="rasa_nyeri2">
                            Pasien nyeri berkurang
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="rasa_nyeri" id="rasa_nyeri2" value="tidak_nyeri"
                            x-model="$store.rmedis.data.rasa_nyeri">
                        <label class="form-check-label" for="rasa_nyeri2">
                            Pasien tidak merasakan nyeri
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

                <h5 class="mt-3">Data Objektif</h5>
                @include('includes.input.data_objektif')
                {{-- <div class="col-12 mt-2  pb-3 pb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tanda_objektif" id="tanda_objektif1" value="tanda_mayor" x-model="$store.rmedis.data.tanda_objektif">
                            <label class="form-check-label" for="tanda_objektif1">
                                Tanda Mayor
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="tanda_objektif" id="tanda_objektif2" value="tanda_minor" x-model="$store.rmedis.data.tanda_objektif">
                            <label class="form-check-label" for="tanda_objektif2">
                                Tanda Minor
                            </label>
                          </div>
                    </div> --}}

                <h5 class="mt-3">Analisa</h5>
                <div class="col-12 mt-2  pb-3 pb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="analisa" id="analisa1" value="teratasi"
                            x-model="$store.rmedis.data.analisa">
                        <label class="form-check-label" for="analisa1">
                            Masalah Teratasi
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="analisa" id="analisa2" value="teratasi_sebagian"
                            x-model="$store.rmedis.data.analisa">
                        <label class="form-check-label" for="analisa2">
                            Masalah Teratasi Sebagian
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="analisa" id="analisa2" value="belum_teratasi"
                            x-model="$store.rmedis.data.analisa">
                        <label class="form-check-label" for="analisa2">
                            Masalah Belum Teratasi
                        </label>
                    </div>
                </div>

                <h5 class="mt-3">Planning</h5>
                <div class="col-12 mt-2  pb-3 pb-3">
                    {!! Form::textarea('planning', null, ['class' => 'form-control', 'id' => 'planning', 'x-model' => '$store.rmedis.data.planning']) !!}
                </div>
            </div>
            <div class="text-end mt-3">
                <a href="{{ $prev_btn['url'] }}" class="btn btn-sm btn-danger"><i
                        class="fas fa-arrow-alt-circle-left"></i> {{ $prev_btn['label'] }} </a>
                <button type="button" class="btn btn-sm btn-primary" x-on:click="$store.rmedis.store($event)">
                    Simpan <i class="fas fa-save"></i>
                </button>
                {{-- <button type="button" class="btn btn-sm btn-warning" data-edit-rluaran="true" x-on:click="$store.rmedis.store($event)">
                        Simpan & Edit Luaran <i class="fas fa-arrow-alt-circle-right"></i>
                    </button> --}}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('rmedis', {
                data: JSON.parse(`{!! json_encode($evaluasi) !!}`),
                tanda_mayor: JSON.parse(`{!!  json_encode($tanda_mayor) !!}`),
                tanda_minor: JSON.parse(`{!!  json_encode($tanda_minor) !!}`),
                validateCheckbox(type) {
                    $('#tandaMayor').modal('hide')
                    $('#tandaMinor').modal('hide')
                },
                store(event) {
                    clearFlash()
                    fetch("{{ route('rekam.update_evaluasi', $pasien->id) }}", {
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
                            // const isEditRmedis = event.target.getAttribute('data-edit-rluaran')
                            // if (isEditRmedis == 'true') {
                            //     return window.location.href = data.redirect_to_rluaran
                            // }

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
