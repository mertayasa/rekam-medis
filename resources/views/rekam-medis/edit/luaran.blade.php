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
                    <h5> <u> <span x-text="$store.rmedis.diagnosa.diagnosa"></span> </u> berhubungan dengan <input
                            type="text" x-model="$store.rmedis.data.nama_penyakit" placeholder="Masukkan nama penyakit..."
                            name="nama_penyakit" id=""> ditandai dengan : </h5>
                </div>

                @include('includes.input.data_objektif')

                <div class="col-12 pb-3 mt-3 pb-md-0">
                    <h5> Setelah dilakukan asuhan keperawatan selama <input type="number" style="width: 50px"
                            x-model="$store.rmedis.data.operation_start" name="operation_start" id=""> x <input
                            type="number" style="width: 50px" x-model="$store.rmedis.data.operation_end"
                            name="operation_end" id=""> jam
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
                <a href="{{ $prev_btn['url'] }}" class="btn btn-sm btn-danger"><i
                        class="fas fa-arrow-alt-circle-left"></i> {{ $prev_btn['label'] }} </a>
                <button type="button" class="btn btn-sm btn-primary" x-on:click="$store.rmedis.store($event)">
                    Simpan <i class="fas fa-save"></i>
                </button>
                <button type="button" class="btn btn-sm btn-warning" data-edit-revaluasi="true"
                    x-on:click="$store.rmedis.store($event)">
                    Simpan & Edit Evaluasi <i class="fas fa-arrow-alt-circle-right"></i>
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('rmedis', {
                data: JSON.parse(`{!! json_encode($luaran) !!}`),
                tanda_mayor: JSON.parse(`{!! json_encode($tanda_mayor) !!}`),
                tanda_minor: JSON.parse(`{!! json_encode($tanda_minor) !!}`),
                diagnosa: JSON.parse(`{!! json_encode($diagnosa) !!}`),
                etiologi: JSON.parse(`{!! json_encode($etiologi) !!}`),
                intervensi: JSON.parse(`{!! json_encode($intervensi) !!}`),
                selectedIntervensi: {},
                showIntervensiOpt($event) {
                    const target = $event.target
                    if (target.checked == true || target.nodeName == 'BUTTON') {
                        const interIndex = target.getAttribute('value')
                        const intervensi = this.intervensi[interIndex]
                        const intervensiDiv = document.getElementsByClassName('intervensi-div')
                        for (let indexDiv = 0; indexDiv < intervensiDiv.length; indexDiv++) {
                            const element = intervensiDiv[indexDiv];
                            element.classList.add('d-none')
                        }

                        const selectedInterDiv = document.getElementById('intervensi' + intervensi.id)
                        selectedInterDiv.classList.remove('d-none')
                    } else {
                        const intervensiDiv = document.getElementsByClassName('intervensi-div')
                        for (let indexDiv = 0; indexDiv < intervensiDiv.length; indexDiv++) {
                            const element = intervensiDiv[indexDiv];
                            element.classList.add('d-none')
                        }
                    }
                },
                setCheckedIntervensi(event) {
                    const target = event.target
                    const indexIntervensi = target.getAttribute('data-index-intervensi')
                    const idChild = target.getAttribute('data-id-child')
                    if (target.checked == true) {
                        this.data.intervensi_child.push(parseInt(idChild))
                        this.intervensi[indexIntervensi].is_checked = true
                    } else {
                        let indexChild = this.data.intervensi_child.indexOf(parseInt(idChild));
                        if (indexChild !== -1) {
                            this.data.intervensi_child.splice(indexChild, 1);
                        }
                    }

                    const opsiIntervensi = document.getElementsByClassName('opsi-inter' + indexIntervensi)
                    let checkedCount = 0
                    for (let indexOpsi = 0; indexOpsi < opsiIntervensi.length; indexOpsi++) {
                        const element = opsiIntervensi[indexOpsi];
                        if(element.checked == true){
                            checkedCount++
                        }
                    }

                    if(checkedCount < 1){
                        this.intervensi[indexIntervensi].is_checked = false
                    }
                },
                validateCheckbox(type) {
                    const checkedLengthMayor = this.tanda_mayor.filter(item => item.is_checked == true)
                        .length
                    const optionLengthMayor = this.tanda_mayor.length
                    const minimumMayor = (optionLengthMayor * 80) / 100

                    const checkedLengthMinor = this.tanda_minor.filter(item => item.is_checked == true)
                        .length
                    const optionLengthMinor = this.tanda_minor.length
                    const minimumMinor = (optionLengthMinor * 20) / 100

                    if ((checkedLengthMayor >= Math.round(minimumMayor)) && (checkedLengthMinor >= Math
                            .round(minimumMinor))) {
                        this.is_submitable = true
                    }

                    if (type == 'check_only') {
                        return true
                    }

                    if (type == 'mayor') {
                        if (checkedLengthMayor < Math.round(minimumMayor)) {
                            return showSwalAlert('error',
                                `Tanda mayor dipilih minimal ${Math.round(minimumMayor)} (80% dari pilihan)`
                            )
                        }
                    }

                    if (type == 'minor') {
                        if (checkedLengthMinor < Math.round(minimumMinor)) {
                            return showSwalAlert('error',
                                `Tanda minor dipilih minimal ${Math.round(minimumMinor)} (20% dari pilihan)`
                            )
                        }
                    }

                    $('#tandaMayor').modal('hide')
                    $('#tandaMinor').modal('hide')
                },
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
