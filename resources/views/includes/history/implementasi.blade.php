@forelse ($value_implementasi as $implementasi)
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-secondary">
            <thead>
                <tr>
                    <th>Subjek</th>
                    <th>Keterangan</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Perawat</td>
                    <td>{{ $implementasi['perawat_pelaksana'] ?? '-' }}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Tanggal/Jam</td>
                    <td>{{ $implementasi['date'] ?? '-' }} / {{ $implementasi['time'] ?? '-' }}</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="3"> <b>Intervensi</b> </td>
                </tr>
                @forelse ($implementasi['raw_intervensi'] as $key => $inter)
                    @include('includes.implementasi.intervensi_only', ['disabled' => true, 'set_checked' => true])
                @empty
                    <tr>
                        <td colspan="3">Tidak ada data intervensi</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@empty
    <p class="text-center">Tidak Ada Data Riwayat</p>
@endforelse
