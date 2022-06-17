@forelse ($value_evaluasi as $evaluasi)
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
                    <td>{{ $evaluasi['perawat_pelaksana'] ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Tanggal/Jam</td>
                    <td>{{ $evaluasi['date'] ?? '-' }} / {{ $evaluasi['time_periksa'] ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Tanda Mayor</td>
                    <td>
                        <ul>
                            @forelse ($evaluasi['tanda_mayor'] as $tanda)
                                <li>{{ $tanda }}</li>
                            @empty
                                <li>{{ '-' }}</li>
                            @endforelse
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td>Tanda Minor</td>
                    <td>
                        <ul>
                            @forelse ($evaluasi['tanda_minor'] as $tanda)
                                <li>{{ $tanda }}</li>
                            @empty
                                <li>{{ '-' }}</li>
                            @endforelse
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td>Provoking</td>
                    <td>{{ $evaluasi['provoking'] ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Quality</td>
                    <td>{{ $evaluasi['quality'] ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Region</td>
                    <td>{{ $evaluasi['region'] ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Severity</td>
                    <td>{{ $evaluasi['severity'] ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Time</td>
                    <td>{{ $evaluasi['durasi_nyeri'] ?? '-' }} <br> {{ $evaluasi['time'] ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Analisa</td>
                    <td>{{ $evaluasi['analisa'] ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Planning</td>
                    <td>{{ $evaluasi['planning'] ?? '-' }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@empty
    <p class="text-center">Tidak Ada Data Riwayat</p>
@endforelse
