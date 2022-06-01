<table class="table table-striped table-secondary">
    <thead>
        <tr class="text-center align-middle">
            <th width="30%">Kemampuan menurunkan <br> aktivitas</th>
            <th>Menurun <br> 1</th>
            <th>Cukup Menurun <br> 2</th>
            <th>Sedang <br> 3</th>
            <th>Cukup Meningkat <br> 4</th>
            <th>Meningkat <br> 5</th>
        </tr>
    </thead>
    <tbody>
        <tr class="align-middle">
            <td>Keluhan Nyeri</td>
            <template x-for="(rate, index) in [1,2,3,4,5]">
                <td class="text-center">
                    <input class="form-check-input" type="radio" :value="rate" x-model="$store.luaran.data.keluhan_nyeri">
                </td>
            </template>
        </tr>
        <tr class="align-middle">
            <td>Meringis</td>
            <template x-for="(rate, index) in [1,2,3,4,5]">
                <td class="text-center">
                    <input class="form-check-input" type="radio" :value="rate" x-model="$store.luaran.data.meringis">
                </td>
            </template>
        </tr>
        <tr class="align-middle">
            <td>Sikap Protektif</td>
            <template x-for="(rate, index) in [1,2,3,4,5]">
                <td class="text-center">
                    <input class="form-check-input" type="radio" :value="rate" x-model="$store.luaran.data.sikap_protektif">
                </td>
            </template>
        </tr>
        <tr class="align-middle">
            <td>Gelisah</td>
            <template x-for="(rate, index) in [1,2,3,4,5]">
                <td class="text-center">
                    <input class="form-check-input" type="radio" :value="rate" x-model="$store.luaran.data.gelisah">
                </td>
            </template>
        </tr>
        <tr class="align-middle">
            <td>Kesulitan Tidur</td>
            <template x-for="(rate, index) in [1,2,3,4,5]">
                <td class="text-center">
                    <input class="form-check-input" type="radio" :value="rate" x-model="$store.luaran.data.kesulitan_tidur">
                </td>
            </template>
        </tr>
        <tr class="align-middle">
            <td>Diaphores</td>
            <template x-for="(rate, index) in [1,2,3,4,5]">
                <td class="text-center">
                    <input class="form-check-input" type="radio" :value="rate" x-model="$store.luaran.data.diaphores">
                </td>
            </template>
        </tr>
        <tr class="align-middle">
            <td>Muntah</td>
            <template x-for="(rate, index) in [1,2,3,4,5]">
                <td class="text-center">
                    <input class="form-check-input" type="radio" :value="rate" x-model="$store.luaran.data.muntah">
                </td>
            </template>
        </tr>
        <tr class="align-middle">
            <td>Mual</td>
            <template x-for="(rate, index) in [1,2,3,4,5]">
                <td class="text-center">
                    <input class="form-check-input" type="radio" :value="rate" x-model="$store.luaran.data.mual">
                </td>
            </template>
        </tr>
        <tr class="align-middle">
            <td>Frekuensi Nadi</td>
            <template x-for="(rate, index) in [1,2,3,4,5]">
                <td class="text-center">
                    <input class="form-check-input" type="radio" :value="rate" x-model="$store.luaran.data.frekuensi_nadi">
                </td>
            </template>
        </tr>
        <tr class="align-middle">
            <td>Pola Nafas</td>
            <template x-for="(rate, index) in [1,2,3,4,5]">
                <td class="text-center">
                    <input class="form-check-input" type="radio" :value="rate" x-model="$store.luaran.data.pola_nafas">
                </td>
            </template>
        </tr>
        <tr class="align-middle">
            <td>Tekanan Darah</td>
            <template x-for="(rate, index) in [1,2,3,4,5]">
                <td class="text-center">
                    <input class="form-check-input" type="radio" :value="rate" x-model="$store.luaran.data.tekanan_darah">
                </td>
            </template>
        </tr>
        <tr class="align-middle">
            <td>Nafsu Makan</td>
            <template x-for="(rate, index) in [1,2,3,4,5]">
                <td class="text-center">
                    <input class="form-check-input" type="radio" :value="rate" x-model="$store.luaran.data.nafsu_makan">
                </td>
            </template>
        </tr>
    </tbody>
</table>