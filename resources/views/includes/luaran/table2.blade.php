<table class="table table-striped table-secondary">
    <thead>
        <tr class="text-center align-middle">
            <th width="30%">Indikator</th>
            <th>Menurun <br> 1</th>
            <th>Cukup Menurun <br> 2</th>
            <th>Sedang <br> 3</th>
            <th>Cukup Meningkat <br> 4</th>
            <th>Meningkat <br> 5</th>
        </tr>
    </thead>
    <tbody>
        <tr class="align-middle">
            <td>Melaporkan nyeri terkontrol</td>
            <template x-for="(rate, index) in [1,2,3,4,5]">
                <td class="text-center">
                    <input class="form-check-input" type="radio" :value="rate" x-model="$store.luaran.data.nyeri_terkontrol">
                </td>
            </template>
        </tr>
        <tr class="align-middle">
            <td>Kemampuan mengenali onset nyeri</td>
            <template x-for="(rate, index) in [1,2,3,4,5]">
                <td class="text-center">
                    <input class="form-check-input" type="radio" :value="rate" x-model="$store.luaran.data.onset_nyeri">
                </td>
            </template>
        </tr>
        <tr class="align-middle">
            <td>Kemampuan mengenali penyebab nyeri</td>
            <template x-for="(rate, index) in [1,2,3,4,5]">
                <td class="text-center">
                    <input class="form-check-input" type="radio" :value="rate" x-model="$store.luaran.data.penyebab_nyeri">
                </td>
            </template>
        </tr>
        <tr class="align-middle">
            <td>Kemampuan menggunakan teknik non-farmakologis</td>
            <template x-for="(rate, index) in [1,2,3,4,5]">
                <td class="text-center">
                    <input class="form-check-input" type="radio" :value="rate" x-model="$store.luaran.data.non_farmakologis">
                </td>
            </template>
        </tr>
    </tbody>
</table>