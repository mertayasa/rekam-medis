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
            @forelse ($intervensi as $key => $inter)
                @if ($inter['id_parent'] == null)
                    <tr>
                        <td width="300">
                            {{ $inter['value'] }} <br>
                        </td>
                        <td>
                            @forelse ($inter['opsi_intervensi'] as $opsi)
                                <ul>
                                    @if ($opsi['id_parent'] == null)
                                            <b>{{ $opsi['value'] }}</b>
                                            @php
                                                $show_child = false;
                                            @endphp
                                            @foreach ($opsi['opsi_child'] as $child)
                                                @if ($child['is_checked'] == true)
                                                <li>
                                                    <label class="form-check-label" for="opsiInter{{ $child['id'] }}">{{ $child['value'] }}</label>
                                                </li>
                                                    @php
                                                        $show_child = true
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @if ($show_child == false)
                                                <li>Tidak Ada Opsi Yang dipilih</li>
                                            @endif
                                    @endif        
                                </ul>
                            @empty
                                <p>Tidak Ada Opsi Yang Dipilih</p>
                            @endforelse
                        </td>
                        <td>
                            @if (isset($inter['another_child']))
                                @forelse ($inter['another_child'] as $another_inter)
                                    <b> {{ $another_inter['value'] }} </b> <br>
                                    @foreach ($another_inter['opsi_intervensi'] as $opsi)
                                    <ul>
                                        @if ($opsi['id_parent'] == null)
                                                <b>{{ $opsi['value'] }}</b>
                                                @php
                                                    $show_child = false;
                                                @endphp
                                                @foreach ($opsi['opsi_child'] as $child)
                                                    @if ($child['is_checked'] == true)
                                                        <li>
                                                            <label class="form-check-label" for="opsiInter{{ $child['id'] }}">{{ $child['value'] }}</label>
                                                        </li>
                                                        @php
                                                            $show_child = true
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                @if ($show_child == false)
                                                    <li>Tidak Ada Opsi Yang dipilih</li>
                                                @endif
                                        @endif        
                                    </ul>
                                    @endforeach
                                    @if (!isset($hide_yt))
                                        @include('includes.youtube_video.list', ['youtube' => $another_inter['url_yt_intervensi']])  
                                    @endif
                                    <br>
                                @empty
                                    <p>Tidak Ada Opsi Yang Dipilih</p>
                                @endforelse
                            @endif
                        </td>
                    </tr>
                @endif
            @empty
                <td colspan="3">Tidak ada data intervensi</td>
            @endforelse
        </tbody>
    </table>
</div>