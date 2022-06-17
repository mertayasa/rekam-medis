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

                <div class="col-12 mt-2  pb-3 pb-3">
                    <p class="mb-0"> <b> Keluhan Tambahan : </b></p>
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
                    @include('includes.luaran.checkbox_intervensi')
                </div>
            </div>
            
            <template x-if="$store.rmedis.is_submitable == false">
                <span class="text-danger">Tanda Mayor & Tanda Minor belum memenuhi syarat</span>
            </template>

            <div class="text-end mt-3">
                <a href="{{ $prev_btn['url'] }}" class="btn btn-sm btn-danger"><i
                        class="fas fa-arrow-alt-circle-left"></i> {{ $prev_btn['label'] }} </a>
                <button type="button" x-bind:disabled="$store.rmedis.is_submitable == false" class="btn btn-sm btn-primary" x-on:click="$store.rmedis.store($event)">
                    Simpan <i class="fas fa-save"></i>
                </button>
                <button type="button" x-bind:disabled="$store.rmedis.is_submitable == false" class="btn btn-sm btn-warning" data-edit-rimplementasi="true"
                    x-on:click="$store.rmedis.store($event)">
                    Simpan & Edit Implementasi Keperawatan <i class="fas fa-arrow-alt-circle-right"></i>
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
                selectedIdChild: null,
                is_submitable: true,
                showIntervensiOpt($event) {
                    const target = $event.target
                    if (target.checked == true || target.nodeName == 'BUTTON') {
                        const interIndex = target.getAttribute('value')
                        const intervensi = this.intervensi[interIndex]

                        const selectedIdChild = target.getAttribute('data-id-child')
                        this.selectedIdChild = selectedIdChild

                        const intervensiDiv = document.getElementsByClassName('intervensi-div')
                        for (let indexDiv = 0; indexDiv < intervensiDiv.length; indexDiv++) {
                            const element = intervensiDiv[indexDiv];
                            element.classList.add('d-none')
                        }

                        const interSubIndex = target.getAttribute('value-sub')
                        if(interSubIndex){
                            const intervensiSub = this.intervensi[interSubIndex-1]
                            const selectedSubInterDiv = document.getElementById('intervensi' + intervensiSub.id)
                            selectedSubInterDiv.classList.remove('d-none')
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

                    let selectedIntervensi = this.intervensi.find(intervensi => intervensi.id == indexIntervensi)

                    if (target.checked == true) {
                        selectedIntervensi.is_checked = true
                    }

                    const opsiSubIntervensi = document.getElementsByClassName('opsi-inter-sub' + indexIntervensi)

                    let checkedCountSub = 0
                    for (let indexOpsi = 0; indexOpsi < opsiSubIntervensi.length; indexOpsi++) {
                        const element = opsiSubIntervensi[indexOpsi];
                        if(element.checked == true){
                            checkedCountSub++
                        }
                    }

                    const opsiIntervensiMain = document.getElementById('opsiInter' + this.selectedIdChild)
                    if(checkedCountSub > 0){
                        opsiIntervensiMain.checked = true
                    }else{
                        if(opsiIntervensiMain){
                            opsiIntervensiMain.checked = false
                        }
                    }

                    const opsiIntervensi = document.getElementsByClassName('opsi-inter' + selectedIntervensi.id)
                    let checkedCount = 0
                    for (let indexOpsi = 0; indexOpsi < opsiIntervensi.length; indexOpsi++) {
                        const element = opsiIntervensi[indexOpsi];
                        if(element.checked == true){
                            checkedCount++
                        }
                    }

                    if(checkedCount < 1){
                        selectedIntervensi.is_checked = false
                    }

                    const allCheckboxChild = document.getElementsByClassName('opsi-child')

                    this.data.intervensi_child = []
                    for (let checkbox = 0; checkbox < allCheckboxChild.length; checkbox++) {
                        const element = allCheckboxChild[checkbox];
                        if(element.checked == true){
                            this.data.intervensi_child.push(parseInt(element.getAttribute('data-id-child'))) 
                        }
                    }

                    // if (target.checked == true) {
                    //     this.data.intervensi_child.push(parseInt(idChild))
                    //     selectedIntervensi.is_checked = true
                    // } else {
                    //     let indexChild = this.data.intervensi_child.indexOf(parseInt(idChild));
                    //     if (indexChild !== -1) {
                    //         this.data.intervensi_child.splice(indexChild, 1);
                    //     }
                    // }
                },
                validateCheckbox(type) {
                    // const checkedLengthMayor = this.tanda_mayor.filter(item => item.is_checked == true)
                    //     .length
                    // const optionLengthMayor = this.tanda_mayor.length
                    // const minimumMayor = (optionLengthMayor * 80) / 100

                    // const checkedLengthMinor = this.tanda_minor.filter(item => item.is_checked == true)
                    //     .length
                    // const optionLengthMinor = this.tanda_minor.length
                    // const minimumMinor = (optionLengthMinor * 20) / 100

                    // if ((checkedLengthMayor >= Math.round(minimumMayor)) && (checkedLengthMinor >= Math
                    //         .round(minimumMinor))) {
                    //     this.is_submitable = true
                    // }

                    // if (type == 'check_only') {
                    //     return true
                    // }

                    // if (type == 'mayor') {
                    //     if (checkedLengthMayor < Math.round(minimumMayor)) {
                    //         return showSwalAlert('error',
                    //             `Tanda mayor dipilih minimal ${Math.round(minimumMayor)} (80% dari pilihan)`
                    //         )
                    //     }
                    // }

                    // if (type == 'minor') {
                    //     if (checkedLengthMinor < Math.round(minimumMinor)) {
                    //         return showSwalAlert('error',
                    //             `Tanda minor dipilih minimal ${Math.round(minimumMinor)} (20% dari pilihan)`
                    //         )
                    //     }
                    // }

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
                                intervensi: this.intervensi
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
                            const isEditRmedis = event.target.getAttribute('data-edit-rimplementasi')
                            if (isEditRmedis == 'true') {
                                return window.location.href = data.redirect_to_rimplementasi
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
