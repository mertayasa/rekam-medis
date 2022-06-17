@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Evaluasi</div>
        <div class="card-body">
            @include('layouts.flash')
            @include('layouts.error_message')
            {!! Form::open(['method' => 'POST', 'id' => 'editEvaluasiForm']) !!}
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
            <div class="row">
                <h5 class="mt-3">Data Subjektif</h5>
                <div class="col-12 mt-2  pb-3 pb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="rasa_nyeri" id="rasa_nyeri1"
                            value="mengeluh_nyeri" x-model="$store.rmedis.data.rasa_nyeri">
                        <label class="form-check-label" for="rasa_nyeri1">
                            Pasien mengeluh nyeri
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
                        <input class="form-check-input" type="radio" name="durasi_nyeri" id="durasi_nyeri1" value="lebih_3"
                            x-model="$store.rmedis.data.durasi_nyeri">
                        <label class="form-check-label" for="durasi_nyeri1">
                            Nyeri > 3bulan
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="durasi_nyeri" id="durasi_nyeri2" value="kurang_3"
                            x-model="$store.rmedis.data.durasi_nyeri">
                        <label class="form-check-label" for="durasi_nyeri2">
                            Nyeri < 3bulan </label>
                    </div>
                </div>

                <h5 class="mt-3">Data Objektif</h5>
                @include('includes.input.data_objektif')
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
                <button type="button" class="btn btn-sm btn-primary" x-on:click="$store.rmedis.updateEvaluasi($event)">
                    Simpan <i class="fas fa-save"></i>
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header">Riwayat Evaluasi</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-secondary">
                    <thead>
                        <tr>
                            <th>Subjek</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Perawat</td>
                            <td>Perawat</td>
                        </tr>
                        <tr>
                            <td>Tanggal/Jam</td>
                            <td>Perawat</td>
                        </tr>
                        <tr>
                            <td>Data Objektif</td>
                            <td>Pasien mengeluh nyeri</td>
                        </tr>
                        <tr>
                            <td>Provoking</td>
                            <td>Provoking</td>
                        </tr>
                        <tr>
                            <td>Quality</td>
                            <td>Quality</td>
                        </tr>
                        <tr>
                            <td>Region</td>
                            <td>Region</td>
                        </tr>
                        <tr>
                            <td>Severity</td>
                            <td>Severity</td>
                        </tr>
                        <tr>
                            <td>Time</td>
                            <td>Time</td>
                        </tr>
                        <tr>
                            <td>Analisa</td>
                            <td>Analisa</td>
                        </tr>
                        <tr>
                            <td>Durasi Nyeri</td>
                            <td>Planning</td>
                        </tr>
                        <tr>
                            <td>Analisa</td>
                            <td>Planning</td>
                        </tr>
                        <tr>
                            <td>Planning</td>
                            <td>Planning</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('rmedis', {
                data: JSON.parse(`{!! json_encode($evaluasi) !!}`),
                tanda_mayor: JSON.parse(`{!! json_encode($tanda_mayor) !!}`),
                tanda_minor: JSON.parse(`{!! json_encode($tanda_minor) !!}`),
                validateCheckbox(type) {
                    $('#tandaMayor').modal('hide')
                    $('#tandaMinor').modal('hide')
                },
                updateEvaluasi(event) {
                    clearFlash()
                    fetch("{{ url('rekam-medis/update/evaluasi') }}", {
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
