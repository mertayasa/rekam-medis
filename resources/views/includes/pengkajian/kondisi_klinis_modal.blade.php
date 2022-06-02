<div class="modal fade" id="kondisiKlinis" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="kondisiKlinisLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="kondisiKlinisLabel">Kondisi Klinis</h5>
          {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
        </div>
        <div class="modal-body">
            <template x-if="!$store.pengkajian.kondisi_klinis">
                <p>Tidak ada pilihan kondisi klinis</p>
            </template>
            <template x-for="(kondisi, index) in $store.pengkajian.kondisi_klinis">
                <div class="form-check" x-data="{id: $id('kondisi')}">
                    <input class="form-check-input" type="checkbox" :id="id" x-model="kondisi.is_checked">
                    <label class="form-check-label" :for="id" x-text="kondisi.value"></label>
                </div>
            </template>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btn-sm" data-bs-dismiss="modal">Simpan</button>
        </div>
      </div>
    </div>
  </div>