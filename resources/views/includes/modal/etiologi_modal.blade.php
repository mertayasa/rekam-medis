<div class="modal fade" id="etiologi" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="etiologiLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="etiologiLabel">Etiologi / Penyebab</h5>
          {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
        </div>
        <div class="modal-body">
            <template x-if="!$store.rmedis.etiologi">
                <p>Tidak ada pilihan etiologi klinis</p>
            </template>
            <template x-for="(etiologi, index) in $store.rmedis.etiologi">
                <div class="form-check" x-data="{id: $id('etiologi')}">
                    <input class="form-check-input" type="checkbox" :id="id" x-model="etiologi.is_checked">
                    <label class="form-check-label" :for="id" x-text="etiologi.value"></label>
                </div>
            </template>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btn-sm" data-bs-dismiss="modal">Simpan</button>
        </div>
      </div>
    </div>
  </div>