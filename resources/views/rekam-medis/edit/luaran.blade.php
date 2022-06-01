@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Luaran & Intervensi</div>
        <div class="card-body">
            @include('layouts.flash')
            @include('layouts.error_message')
            {!! Form::open(['method' => 'POST', 'route' => ['rekam.update_luaran', $pasien->id], 'id' => 'editLuaranForm']) !!}
            <div class="row">
                <div class="col-12 pb-3 pb-md-0">
                    <h5> <u> <span x-text="$store.luaran.diagnosa.diagnosa"></span> </u> berhubungan dengan <input
                            type="text" x-model="$store.luaran.data.nama_penyakit" placeholder="Masukkan nama penyakit..."
                            name="nama_penyakit" id=""> ditandai dengan : </h5>
                    <p class="mb-0"> <b>Tanda Mayor :</b> </p>
                    <ul class="mb-0 pb-0">
                        <template x-for="(tanda, index) in $store.luaran.tanda_mayor">
                            <template x-if="tanda.is_checked">
                                <li x-text="tanda.value"></li>
                            </template>
                        </template>
                    </ul>
                    <p class="mb-0"> <b>Tanda Minor :</b> </p>
                    <ul class="mb-0 pb-0">
                        <template x-for="(tanda, index) in $store.luaran.tanda_minor">
                            <template x-if="tanda.is_checked">
                                <li x-text="tanda.value"></li>
                            </template>
                        </template>
                    </ul>
                    <p class="mb-0"> <b>Kondisi Klinis :</b> </p>
                    <ul class="mb-0 pb-0">
                        <template x-for="(kondisi, index) in $store.luaran.kondisi_klinis">
                            <template x-if="kondisi.is_checked">
                                <li x-text="kondisi.value"></li>
                            </template>
                        </template>
                    </ul>
                </div>

                <div class="col-12 pb-3 mt-3 pb-md-0">
                    <h5> Setelah dilakukan asuhan keperawatan selama <input type="number" style="width: 50px"
                            x-model="$store.luaran.data.operation_start" name="operation_start" id=""> x <input type="number"
                            style="width: 50px" x-model="$store.luaran.data.operation_end" name="operation_end" id=""> jam
                        maka : </h5>
                    <div class="table-responsive">
                        @include('includes.luaran.table1')
                    </div>
                    <div class="table-responsive">
                        @include('includes.luaran.table2')
                    </div>
                </div>

                <div class="col-12 pb-3 mt-3 pb-md-0">
                    <p class="mb-0"> <b>Intervensi :</b> </p>
                    @include('includes.luaran.checkbox_intervensi')
                </div>
            </div>
            <div class="text-end mt-3">
                <button type="button" class="btn btn-sm btn-primary" x-on:click="$store.luaran.store($event)">
                    Simpan
                </button>
                <button type="button" class="btn btn-sm btn-warning" data-edit-revaluasi="true"
                    x-on:click="$store.luaran.store($event)">
                    Simpan & Edit Evaluasi
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('luaran', {
                data: JSON.parse(`{!! json_encode($luaran) !!}`),
                tanda_mayor: JSON.parse(`{!! json_encode($tanda_mayor) !!}`),
                tanda_minor: JSON.parse(`{!! json_encode($tanda_minor) !!}`),
                kondisi_klinis: JSON.parse(`{!! json_encode($kondisi_klinis) !!}`),
                diagnosa: JSON.parse(`{!! json_encode($diagnosa) !!}`),
                store(event) {
                    clearFlash()
                    fetch("{{ route('rekam.update_luaran', $pasien->id) }}", {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                'Content-Type': 'application/json',
                            },
                            method: 'PATCH',
                            body: JSON.stringify({
                                luaran: this.data,
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
