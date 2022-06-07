<div class="table-responsive">
    <table class="table table-bordered table-striped table-secondary">
        <thead>
            <tr>
                <th>Subjek</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($intervensi as $key => $inter)
                <tr>
                    <td width="300">
                        {{ $inter->value }} <br>
                        @if ($inter->url_youtube != null)
                        <span><b>LINK VIDEO : <a href="{{ $inter->url_youtube }}" target="_blank">{{ $inter->url_youtube }}</a></b></span> <br>
                        @endif
                    </td>
                    <td>
                        @forelse ($inter->opsi_intervensi as $opsi)
                            @if ($opsi->id_parent == null)
                                {{-- @php
                                    $show_parent = false;
                                @endphp
                                @foreach ($opsi->opsi_child as $child)
                                    @if ($child->is_checked == true && $child->id_parent == $opsi->id)
                                        @php
                                            $show_parent = true
                                        @endphp
                                    @endif
                                @endforeach --}}

                                {{-- @if ($show_parent == true) --}}
                                    <b>{{ $opsi->value }}</b>
                                {{-- @endif --}}

                                {{-- <ul class="mb-0"> --}}
                                    @php
                                        $show_child = false;
                                    @endphp
                                    @foreach ($opsi->opsi_child as $child)
                                        @if ($child->is_checked == true)
                                            {{-- <li> --}}
                                                <div class="form-check">
                                                    <input class="form-check-input opsi-inter{{ $key }}" @if (isset($disabled) && $disabled == true) disabled @endif id="opsiInter{{ $child->id }}" type="checkbox" @if ($child->implementasi_is_checked == true) checked @endif x-on:change="$store.rmedis.setCheckedIntervensi($event)" data-id-child="{{ $child->id }}" data-index-intervensi="{{ $key }}">
                                                    <label class="form-check-label" for="opsiInter{{ $child->id }}">{{ $child->value }}</label>
                                                </div>
                                            {{-- </li> --}}
                                            @php
                                                $show_child = true
                                            @endphp
                                        @endif
                                    @endforeach
                                    @if ($show_child == false)
                                        <li>Tidak Ada Opsi Yang dipilih</li>
                                    @endif
                                {{-- </ul> --}}
                            @endif        
                        @empty
                            <p>Tidak Ada Opsi Yang Dipilih</p>
                        @endforelse
                    </td>
                </tr>
            @empty
                <td colspan="2">Tidak ada data intervensi</td>
            @endforelse
        </tbody>
    </table>
</div>