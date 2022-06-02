<div class="modal fade" id="pasienDetail" tabindex="-1" role="dialog" aria-labelledby="pasienDetailLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pasienDetailLabel">Detail Pasien</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table>
                    <tr>
                        <td>Nama</td>
                        <td width="50" class="text-center">:</td>
                        <td x-text="$store.pasienModal.pasien.nama"></td>
                    </tr>
                    <tr>
                        <td>No. RM</td>
                        <td width="50" class="text-center">:</td>
                        <td x-text="$store.pasienModal.pasien.no_rm"></td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td width="50" class="text-center">:</td>
                        <td x-text="$store.pasienModal.pasien.jenis_kelamin"></td>
                    </tr>
                    <tr>
                        <td>Tempat/Tanggal Lahir</td>
                        <td width="50" class="text-center">:</td>
                        <td x-text="$store.pasienModal.pasien.tempat_lahir"></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td width="50" class="text-center">:</td>
                        <td x-text="$store.pasienModal.pasien.alamat"></td>
                    </tr>
                    <tr>
                        <td>No Handphone</td>
                        <td width="50" class="text-center">:</td>
                        <td x-text="$store.pasienModal.pasien.no_hp"></td>
                    </tr>
                    <tr>
                        <td>Tanggal Masuk RS</td>
                        <td width="50" class="text-center">:</td>
                        <td x-text="$store.pasienModal.pasien.tanggal_masuk"></td>
                    </tr>
                    <tr>
                        <td>Tanggal Keluar RS</td>
                        <td width="50" class="text-center">:</td>
                        <td x-text="$store.pasienModal.pasien.tanggal_keluar"></td>
                    </tr>
                    <tr>
                        <td>Diagnosa Medis</td>
                        <td width="50" class="text-center">:</td>
                        <td x-text="$store.pasienModal.pasien.diagnosa_medis ?? '-'"></td>
                    </tr>
                    <tr>
                        <td>Keluhan Utama</td>
                        <td width="50" class="text-center">:</td>
                        <td x-text="$store.pasienModal.pasien.keluhan_utama ?? '-'"></td>
                    </tr>
                    <tr>
                        <td>Nama Wali</td>
                        <td width="50" class="text-center">:</td>
                        <td x-text="$store.pasienModal.pasien.nama_wali"></td>
                    </tr>
                    <tr>
                        <td>Hubungan Dengan Pasien</td>
                        <td width="50" class="text-center">:</td>
                        <td x-text="$store.pasienModal.pasien.hubungan_wali"></td>
                    </tr>
                    <tr>
                        <td>Kontak Wali</td>
                        <td width="50" class="text-center">:</td>
                        <td x-text="$store.pasienModal.pasien.kontak_wali"></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('pasienModal', {
                pasien: {},
                asd: 'asds',
                getPasien(event) {
                    const data = event.target
                    fetch("{{ url('pasien/find') }}" + "/" + data.getAttribute('data-id'), {
                            method: 'GET'
                        })
                        .then(function(response) {
                            if (!response.ok) {
                                throw Error(response.statusText)
                            }
                            return response;
                        })
                        .then(response => response.json())
                        .then(data => {
                            this.pasien = data
                            $('#pasienDetail').modal('show')
                        })
                        .catch((error) => {
                            console.log(error);
                            return showSwalAlert('error',
                                'Terjadi kesalahan pada sistem, mohon muat coba lagi atau muat ulang halaman'
                            )
                        })
                }
            })
        })
    </script>
@endpush
