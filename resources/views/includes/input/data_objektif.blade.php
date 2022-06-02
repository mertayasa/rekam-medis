<div class="col-12 pb-3">
    <p class="mb-0"> <b> Tanda Mayor : </b></p>
    <ul class="mb-0 pb-0">
        <template x-for="(tanda, index) in $store.rmedis.tanda_mayor">
            <template x-if="tanda.is_checked">
                <li x-text="tanda.value"></li>
            </template>
        </template>
    </ul>
    <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#tandaMayor">Edit</button>
</div>

<div class="col-12 pb-3">
    <p class="mb-0"> <b>Tanda Minor :</b> </p>
    <ul class="mb-0 pb-0">
        <template x-for="(tanda, index) in $store.rmedis.tanda_minor">
            <template x-if="tanda.is_checked">
                <li x-text="tanda.value"></li>
            </template>
        </template>
    </ul>
    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#tandaMinor">Edit</button>
</div>

<div class="col-12 pb-3 pb-md-0">
    <p class="mb-0"> <b>Etiologi / Penyebab :</b> </p>
    <ul class="mb-0 pb-0">
        <template x-for="(etiologi, index) in $store.rmedis.etiologi">
            <template x-if="etiologi.is_checked">
                <li x-text="etiologi.value"></li>
            </template>
        </template>
    </ul>
    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#etiologi">Edit</button>
</div>

@include('includes.modal.tanda_mayor_modal')
@include('includes.modal.tanda_minor_modal')
@include('includes.modal.etiologi_modal')