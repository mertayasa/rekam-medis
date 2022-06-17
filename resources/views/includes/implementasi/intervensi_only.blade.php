@if ($inter['id_parent'] == null)
    <tr>
        <td width="300">
            {{ $inter['value'] }} <br>
        </td>
        <td>
            @forelse ($inter['opsi_intervensi'] as $opsi)
                @if ($opsi['id_parent'] == null)
                    <b>{{ $opsi['value'] }}</b>
                    @php
                        $show_child = false;
                    @endphp
                    @foreach ($opsi['opsi_child'] as $child)
                        @if ($child['is_checked'] == true)
                            <div class="form-check">
                                <input class="form-check-input opsi-inter{{ $key }}" @if (isset($disabled) && $disabled == true) disabled @endif id="opsiInter{{ $child['id'] }}" type="checkbox" @if ($child['implementasi_is_checked'] == true && (isset($set_checked) && $set_checked == true)) checked @endif x-on:change="$store.rmedis.setCheckedIntervensi($event)" data-id-child="{{ $child['id'] }}" data-index-intervensi="{{ $key }}">
                                <label class="form-check-label"
                                    for="opsiInter{{ $child['id'] }}">{{ $child['value'] }}</label>
                            </div>
                            @php
                                $show_child = true;
                            @endphp
                        @endif
                    @endforeach
                    @if ($show_child == false)
                        <li>Tidak Ada Opsi Yang dipilih</li>
                    @endif
                @endif
            @empty
                <p>Tidak Ada Opsi Yang Dipilih</p>
            @endforelse
        </td>
        <td>
            @if (isset($inter['another_child']))
                @forelse ($inter['another_child'] as $another_inter)
                    <b> {{ $another_inter['value'] }} </b> <br>
                    @foreach ($another_inter['opsi_intervensi'] as $opsi)
                        @if ($opsi['id_parent'] == null)
                            <b>{{ $opsi['value'] }}</b>
                            @php
                                $show_child = false;
                            @endphp
                            @foreach ($opsi['opsi_child'] as $child)
                                @if ($child['is_checked'] == true)
                                    <div class="form-check">
                                        <input class="form-check-input opsi-inter{{ $key }}" @if (isset($disabled) && $disabled == true) disabled @endif id="opsiInter{{ $child['id'] }}" type="checkbox" @if ($child['implementasi_is_checked'] == true && (isset($set_checked) && $set_checked == true)) checked @endif x-on:change="$store.rmedis.setCheckedIntervensi($event)" data-id-child="{{ $child['id'] }}" data-index-intervensi="{{ $key }}">
                                        <label class="form-check-label"
                                            for="opsiInter{{ $child['id'] }}">{{ $child['value'] }}</label>
                                    </div>
                                    @php
                                        $show_child = true;
                                    @endphp
                                @endif
                            @endforeach
                            @if ($show_child == false)
                                <li>Tidak Ada Opsi Yang dipilih</li>
                            @endif
                        @endif
                    @endforeach
                    <br>
                @empty
                    <p>Tidak Ada Opsi Yang Dipilih</p>
                @endforelse
            @endif
        </td>
    </tr>
@endif
