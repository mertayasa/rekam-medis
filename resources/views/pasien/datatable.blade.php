<table class="table table-hover table-striped" width="100%" id="datatable"></table>

@push('scripts')
<script>

    let table
    let url = "{{ route('pasien.datatable') }}"

    datatable(url)
    function datatable (url){
        let columns = [ 
            {
                data: 'DT_RowIndex',
                name: 'no',
                orderable: false,
                searchable: false,
                className:"text-center align-middle",
                title: 'No'
            },
            {
                data: 'updated_at', 
                name: 'updated_at',
                visible: false,
                searchable: false
            },
            {
                data: 'nama', 
                name: 'nama',
                title: 'Nama'
            },
            {
                data: 'jenis_kelamin', 
                name: 'jenis_kelamin',
                title: 'Jenis Kelamin'
            },
            {
                data: 'umur', 
                name: 'umur',
                title: 'Umur'
            },
            {
                data: 'no_hp', 
                name: 'no_hp',
                title: 'No Telepon'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
                className:"text-center align-middle",
                // title: 'Aksi'
            }
        ]

        table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: url,
            columns: columns,
            order: [1, "DESC"],
            columnDefs: [
                // { width: 300, targets: 1 },
                {
                    targets:  '_all',
                    className: 'align-middle'
                },
                {
                    responsivePriority: 1, targets: 1
                },
            ],
            language: {
                search: "",
                searchPlaceholder: "Cari"
            },
        });
    }

</script>

@endpush