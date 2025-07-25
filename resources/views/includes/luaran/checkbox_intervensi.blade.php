@push('styles')
    <style>
        .form-check-input:disabled~.form-check-label, .form-check-input[disabled]~.form-check-label {
            opacity: 1;
        }
    </style>
@endpush
<div class="row">
    <div class="col-12 col-md-3">
        <template x-if="!$store.rmedis.intervensi">
            <p>Tidak ada pilihan intervensi</p>
        </template>
        <template x-for="(intervensi, index) in $store.rmedis.intervensi">
            <template x-if="intervensi.is_main == true">
                <div class="form-check" x-data="{id: $id('intervensi')}">
                    <input class="form-check-input" disabled x-on:change="$store.rmedis.showIntervensiOpt($event)" x-bind:value="index" type="checkbox" :id="id" x-model="intervensi.is_checked">
                    <label class="form-check-label" :for="id" x-text="intervensi.value"></label>
                    <small> <button type="button" class="btn btn-sm text-primary" x-on:click="$store.rmedis.showIntervensiOpt($event)" x-bind:value="index">Lihat Opsi</button> </small>
                </div>
            </template>
        </template>
    </div>

    <div class="col-12 col-md-9">
        <div class="row">
            <div class="col-12 col-md-6">
                @foreach ($intervensi as $key => $interven)
                    @if ($interven->is_main)
                        <div id="intervensi{{ $interven->id }}" class="d-none intervensi-div">
                            <p class="mb-1"><b>{{ $interven->value }}</b></p>
                            <p> <b>Definisi : </b> {{ $interven->keterangan }}</p>
                            @foreach ($interven->opsi_intervensi as $key_opsi => $opsi)
                                @if ($opsi->id_parent == null)
                                    <p class="mb-1"><b>{{ $key_opsi+1 }}</b> {{ $opsi->value }} </p>
                                    @foreach ($opsi->opsi_child as $child_key => $child)
                                        <div class="form-check">
                                            <input class="form-check-input opsi-child opsi-inter{{ $interven->id }}" id="opsiInter{{ $child->id }}" type="checkbox" @if ($child->is_checked == true) checked @endif x-on:change="$store.rmedis.setCheckedIntervensi($event)" data-id-child="{{ $child->id }}" data-index-intervensi="{{ $interven->id }}">
                                            <label class="form-check-label" for="opsiInter{{ $child->id }}">{{ $child->value }}</label>
                                            @if ($child->sub_intervensi_id != null)
                                                <small> <button type="button" class="btn btn-sm text-primary" x-on:click="$store.rmedis.showIntervensiOpt($event)" value="{{ $key }}" value-sub="{{ $child->sub_intervensi_id }}" data-id-child="{{ $child->id }}">Lihat Opsi</button> </small>
                                            @endif
                                        </div>
                                    @endforeach
                                    <div class="mb-2"></div>
                                @endif
                            @endforeach
                            @if ($interven->url_youtube != null)
                                <b>LINK VIDEO {{ $interven->value }} : <a href="{{ $interven->url_youtube }}" target="_blank">{{ $interven->url_youtube }}</a></b>
                                <iframe width="400" height="300" src="https://www.youtube.com/embed/{{ $interven->id_youtube }}?feature=oembed" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            @endif
                        </div>
                    @endif
                @endforeach
            </div>
        
            <div class="col-12 col-md-6">
                @foreach ($intervensi as $key => $interven)
                    @if ($interven->is_main == false)
                        <div id="intervensi{{ $interven->id }}" class="d-none intervensi-div">
                            <p class="mb-1"><b>{{ $interven->value }}</b></p>
                            <p> <b>Definisi : </b> {{ $interven->keterangan }}</p>
                            @foreach ($interven->opsi_intervensi as $key_opsi => $opsi)
                                @if ($opsi->id_parent == null)
                                    <p class="mb-1"><b>{{ $key_opsi+1 }}</b> {{ $opsi->value }} </p>
                                    @foreach ($opsi->opsi_child as $child_key => $child)
                                        <div class="form-check">
                                            <input class="form-check-input opsi-child opsi-inter-sub{{ $interven->id_parent }}" id="opsiInter{{ $child->id }}" type="checkbox" @if ($child->is_checked == true) checked @endif x-on:change="$store.rmedis.setCheckedIntervensi($event)" data-id-child="{{ $child->id }}" data-index-intervensi="{{  $interven->id_parent }}">
                                            <label class="form-check-label" for="opsiInter{{ $child->id }}">{{ $child->value }}</label>
                                        </div>
                                    @endforeach
                                    <div class="mb-2"></div>
                                @endif
                            @endforeach
                            @include('includes.youtube_video.list', ['youtube' => $interven->url_yt_intervensi])  
                            {{-- @if ($interven->url_youtube != null)
                                <b>LINK VIDEO {{ $interven->value }} : <a href="{{ $interven->url_youtube }}" target="_blank">{{ $interven->url_youtube }}</a></b>
                                <iframe width="400" height="300" src="https://www.youtube.com/embed/{{ $interven->id_youtube }}?feature=oembed" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            @endif --}}
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

</div>