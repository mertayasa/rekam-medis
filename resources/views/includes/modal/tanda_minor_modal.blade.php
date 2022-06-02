<div class="modal fade" id="tandaMinor" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="tandaMinorLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tandaMinorLabel">Tanda Minor</h5>
          {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
        </div>
        <div class="modal-body">
            <template x-if="!$store.rmedis.tanda_minor">
                <p>Tidak ada pilihan tanda minor</p>
            </template>
            <template x-for="(tanda, index) in $store.rmedis.tanda_minor">
                <div class="form-check" x-data="{id: $id('minor')}">
                    <input class="form-check-input" type="checkbox" :id="id" x-model="tanda.is_checked">
                    <label class="form-check-label" :for="id" x-text="tanda.value"></label>
                </div>
            </template>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btn-sm" x-on:click="$store.rmedis.validateCheckbox('minor')" >Simpan</button>
        </div>
      </div>
    </div>
  </div>